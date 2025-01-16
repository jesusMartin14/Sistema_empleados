<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2';
import DataTable from 'datatables.net-vue3';
import DataTablesCore from 'datatables.net-dt';


//DATATABLE

const options = {
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.2.1/i18n/es-ES.json',
    },
};

DataTable.use(DataTablesCore);


//ELIMINAR REGISTRO Y ALERTA

function alertaEliminar(id, nombre, apellido) {
    return Swal.fire({
        title: "¿Desea eliminar el registro?",
        position: 'top',
        text: nombre + ' ' + apellido,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then((result) => {
        if (result.isConfirmed) {
            const data = { idempleado: id };
            axios.post(route('deleteEmpleado'), data).then(function(response){
                Swal.fire({
                width: 250,
                icon: "success",
                text: 'Registro eliminado',
                showConfirmButton: false,
                timer: 1500
            }).then(function(){
                window.location.reload();
            });
            });
        }
    });
}

//FORMATO MONEDA

function toCurrency(value) {
    if (typeof value !== "number") {
        return value;
    }
    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD'
    });
    return formatter.format(value);
};

//PROPS

defineProps({
    empleados: Array
});


</script>

<template>

    <Head title="Empleados"></Head>
    <h1
        class="pt-5 text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white">
        Empleados</h1>

    <Link
        class="ml-5 focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800"
        :href="route('addEditEmpleado', { id: 0 })">Nuevo</Link>



    <!-- TABLA EMPLEADOS -->

    <div class="p-5">
        <DataTable id="tabla" class="display" :options="options">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido paterno</th>
                    <th>Apellido materno</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Salario</th>
                    <th>Fecha Cont.</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(empleado, index) in empleados">
                    <td>{{ empleado.nombre }}</td>
                    <td>{{ empleado.primer_apellido }}</td>
                    <td>{{ empleado.segundo_apellido }}</td>
                    <td>{{ empleado.email }}</td>
                    <td>{{ empleado.cargo_empleado.nombre_cargo }}</td>
                    <td>{{ toCurrency(empleado.salario_empleado.salario) }}</td>
                    <td>{{ empleado.fecha_contratacion }}</td>
                    <td>
                        <Link
                            class="focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900"
                            :href="route('addEditEmpleado', { id: empleado.idempleado })">Editar</Link>
                        <button @click="alertaEliminar(empleado.idempleado, empleado.nombre, empleado.primer_apellido)"
                            type="button"
                            class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </DataTable>
    </div>
</template>

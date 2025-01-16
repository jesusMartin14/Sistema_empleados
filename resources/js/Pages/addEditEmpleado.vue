<script setup>

import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2';


//PROPS

const props = defineProps({
    empleado: Object,
    cargos: Array,
    niveles: Array
});

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

//FORM POST BACKEND

const form = useForm({
    idempleado: props.empleado ? props.empleado.idempleado : 0,
    nombre: props.empleado ? props.empleado.nombre : '',
    primer_apellido: props.empleado ? props.empleado.primer_apellido : '',
    segundo_apellido: props.empleado ? props.empleado.segundo_apellido : '',
    email: props.empleado ? props.empleado.email : '',
    idcargo: props.empleado ? props.empleado.idcargo : 0,
    idnivel: props.empleado ? props.empleado.idnivel : 0,
    fecha_contratacion: props.empleado ? props.empleado.fecha_contratacion : ''
});

const submit = () => {
    form.post(route('saveEmpleado'), {
        onError: (er) => {
            if (er.email.includes('The email has already been taken.')) {
                Swal.fire({
                    width: 500,
                    icon: "error",
                    text: 'El email ya se encuentra registrado, favor de capturar uno diferente.',
                    showConfirmButton: false,
                    timer: 5000
                });
            }
        },
        onSuccess: (res) => {
            form.reset('nombre');
            form.reset('primer_apellido');
            form.reset('segundo_apellido');
            form.reset('email');
            form.reset('idcargo');
            form.reset('idnivel');
            form.reset('fecha_contratacion');
            Swal.fire({
                width: 250,
                icon: "success",
                text: 'Datos guardados.',
                showConfirmButton: false,
                timer: 2000
            });
        },
    });
};

</script>

<template>

    <Head :title="empleado ? 'Editar empleado' : 'Nuevo empleado'"></Head>
    <h1
        class="pt-5 text-center mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-4xl dark:text-white">
        {{ empleado ? 'Editar empleado' : 'Nuevo empleado' }}</h1>

    <form @submit.prevent="submit" class="p-20">
        <div class="grid gap-6 mb-6 md:grid-cols-3">
            <div>
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input v-model="form.nombre" type="text" id="nombre"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
            </div>
            <div>
                <label for="primer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Primer
                    apellido</label>
                <input v-model="form.primer_apellido" type="text" id="primer_apellido"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
            </div>
            <div>
                <label for="sedundo_apellido"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Segundo apellido</label>
                <input v-model="form.segundo_apellido" type="text" id="sedundo_apellido"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-4">
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                <input v-model="form.email" type="email" id="email"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
            </div>
            <div>
                <label for="idcargo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cargo</label>
                <select v-model="form.idcargo" id="idcargo"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled selected>Seleccionar cargo</option>
                    <option v-for="(cargo, index) in cargos" :value="cargo.idcargo">{{ cargo.nombre_cargo }}</option>
                </select>
            </div>
            <div>
                <label for="idnivel" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sueldo</label>
                <select v-model="form.idnivel" id="idnivel"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="" disabled selected>Seleccionar nivel</option>
                    <option v-for="(nivel, index) in niveles" :value="nivel.idnivel">Nivel: {{ nivel.idnivel }} |
                        Salario:
                        {{ toCurrency(nivel.salario) }}</option>
                </select>
            </div>
            <div>
                <label for="fecha_contratacion"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de contratación</label>
                <input v-model="form.fecha_contratacion" type="date" id="fecha_contratacion"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required />
            </div>
        </div>
        <div class="float-right">
            <Link :href="route('empleados')"
                class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
            Cancelar</Link>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Guardar</button>
        </div>
    </form>
</template>
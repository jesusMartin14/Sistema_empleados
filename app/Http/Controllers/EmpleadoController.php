<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\Nivel;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados = Empleado::with('salarioEmpleado', 'cargoEmpleado')->get();

        return Inertia::render('Empleados', ['empleados' => $empleados]);
    }

    public function getEmpleado(Request $request)
    {
        $id = $request->input('id') && is_numeric($request->input('id')) ? $request->input('id') : 0;
        $cargos = Cargo::all();
        $niveles = Nivel::all();
        if ($id != 0) {
            $empleado = Empleado::find($id);
            if ($empleado) {
                return Inertia::render('addEditEmpleado', [
                    'empleado' => $empleado,
                    'cargos' => $cargos,
                    'niveles' => $niveles
                ]);
            } else {
                abort(404);
            }
        } else {
            return Inertia::render('addEditEmpleado', [
                'cargos' => $cargos,
                'niveles' => $niveles
            ]);
        }
    }

    public function saveEmpleado(Request $request)
    {
        $post = $request->post();
        $id = isset($post['idempleado']) && is_numeric($post['idempleado']) ? $post['idempleado'] : 0;

        $request->validate([
            'nombre' => 'required|string|max:255',
            'primer_apellido' => 'required|string|max:255',
            'segundo_apellido' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:empleados,email,' . $id . ',idempleado',
            'idcargo' => 'required|integer',
            'idnivel' => 'required|integer',
            'fecha_contratacion' => 'required|string|max:255'
        ]);

        if ($id == 0) {
            $model = new Empleado();
        } else {
            $model = Empleado::find($id);
            $model->idempleado = $post['idempleado'];
        }

        $model->nombre = $post['nombre'];
        $model->primer_apellido = $post['primer_apellido'];
        $model->segundo_apellido = isset($post['segundo_apellido']) ? $post['segundo_apellido'] : '';
        $model->email = isset($post['email']) ? $post['email'] : '';
        $model->idcargo = isset($post['idcargo']) ? $post['idcargo'] : 0;
        $model->idnivel = isset($post['idnivel']) ? $post['idnivel'] : 0;
        $model->fecha_contratacion = isset($post['fecha_contratacion']) ? $post['fecha_contratacion'] : '';

        $model->save();

        return redirect('/');
    }

    public function deleteEmpleado(Request $request)
    {
        $post = $request->post();
        $id = isset($post['idempleado']) && is_numeric($post['idempleado']) ? $post['idempleado'] : 0;
        $emp = Empleado::find($id);
        $emp->delete();

        return redirect('/');

    }
}

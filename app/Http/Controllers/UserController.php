<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function gestionUsuarios()
    {
        // Obtenemos los usuarios que son clientes (id_rol = 2) junto con sus datos de cliente
        $clientes = User::where('users.id_rol', 2)
            ->with('cliente')  // Carga la relación cliente
            ->get();

        return view('usuario.listar', compact('clientes'));
    }

    public function promoverAAdministrador(Request $request)
    {
        // Obtener el usuario por su ID
        $user = User::findOrFail($request->user_id);

        // Actualizar solo el rol en la tabla users
        $user->id_rol = 1; // 1 para administrador
        $user->save();

        // Buscar el cliente relacionado usando la llave foránea 'id' en la tabla 'cliente'
        $cliente = DB::table('cliente')->where('id', $user->id)->first();

        if (! $cliente) {
            return redirect()->back()->with('error', 'Cliente no encontrado. Verifica que el usuario esté relacionado con un cliente.');
        }

        // Cambiar el estado del cliente a 'promovido'
        $updated = DB::table('cliente')->where('id_cliente', $cliente->id_cliente)->update(['estado' => 'promovido']);

        if (! $updated) {
            return redirect()->back()->with('error', 'No se pudo actualizar el estado del cliente. Verifica los datos en la base de datos.');
        }

        // Insertar al usuario en la tabla administradores
        DB::table('administrador')->insert([
            'id' => $user->id,
            'nombre' => $cliente->nombre, // Nombre del cliente
            'apellido' => $cliente->apellido, // Apellido del cliente
            'horario' => 'Horario FT', // Proporciona un valor predeterminado
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Usuario promovido a administrador exitosamente.');
    }

    public function desactivarCliente(Request $request)
    {
        // Validar que el ID de usuario se haya proporcionado
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        // Obtener el usuario
        $user = User::findOrFail($request->user_id);

        // Buscar el cliente relacionado
        $cliente = DB::table('cliente')->where('id', $user->id)->first();

        if (! $cliente) {
            return redirect()->back()->with('error', 'Cliente no encontrado.');
        }

        // Cambiar el estado del cliente a "inactivo"
        DB::table('cliente')->where('id_cliente', $cliente->id_cliente)->update(['estado' => 'inactivo']);

        // Opcional: Desactivar al usuario directamente si es necesario
        $user->update(['id_rol' => null]); // Esto elimina su rol activo (ajusta según tus necesidades)

        return redirect()->back()->with('success', 'El cliente ha sido desactivado exitosamente.');
    }
}

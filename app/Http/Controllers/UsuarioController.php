<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\modelUsuarios;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    // 📄 Vista base
    public function base()
    {
        return view("home");
    }

    // 🔐 Vista login
    public function Login()
    {
        return view("auth.login");
    }

    // ✅ Validación de inicio de sesión
    public function loginConfi(Request $request)
    {
        try {
            $correo = $request->input('correo');
            $contra = $request->input('contra');

            // 🔎 Buscar usuario por correo
            $usuario = modelUsuarios::where('correo', $correo)->first();

            if (!$usuario) {
                return response()->json([
                    'ok' => false,
                    'mensaje' => 'El correo no está registrado.',
                ], 401);
            }

            // 🔐 Verificar contraseña encriptada
            if (!Hash::check($contra, $usuario->contra)) {
                return response()->json([
                    'ok' => false,
                    'mensaje' => 'Contraseña incorrecta.',
                ], 401);
            }

            // 🚫 Verificar si el usuario está activo
            if (!$usuario->activo) {
                return response()->json([
                    'ok' => false,
                    'mensaje' => 'Tu cuenta está desactivada. Contacta al administrador.',
                ], 401);
            }

            // ✅ Login exitoso
            return response()->json([
                'ok' => true,
                'mensaje' => '✅ Inicio de sesión exitoso. Bienvenido ' . $usuario->nombre,
                'redirect' => url('/login')
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'Error interno en el servidor.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // 👤 Perfil
    public function profile()
    {
        return "profile";
    }

    // 🚪 Cerrar sesión
    public function logout()
    {
        return "logout";
    }

    // 📋 Listado de usuarios
    public function usuarios()
    {
        $modelUsuarios = modelUsuarios::all();
        return view('admin.usuarios.usuarios', compact('modelUsuarios'));
    }

    // 🧾 Formulario de usuario
    public function usuariosForm()
    {
        return view('admin.usuarios.usuarios-form');
    }

    // ➕ Insertar usuario
    public function insertarUsuario(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|min:3|max:100',
                'correo' => 'required|email|unique:usuarios,correo|max:150',
                'contra' => 'required|string|min:8',
                'activo' => 'required|boolean',
            ]);

            $usuario = modelUsuarios::create([
                'nombre' => $validated['nombre'],
                'correo' => $validated['correo'],
                'contra' => bcrypt($validated['contra']),
                'activo' => $validated['activo'],
            ]);

            return response()->json([
                'ok' => true,
                'mensaje' => '✅ Usuario insertado correctamente.',
                'usuario' => $usuario
            ], 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'Error de validación.',
                'errores' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'Error al insertar el usuario.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // 🗑️ Eliminar usuario
    public function destroy($idUsuario)
    {
        $usuario = modelUsuarios::findOrFail($idUsuario);
        $usuario->delete();

        return redirect()->back()->with('success', '✅ Usuario eliminado correctamente.');
    }

    // ✏️ Editar usuario
    public function editUsuario($idUsuario)
    {
        $usuario = modelUsuarios::findOrFail($idUsuario);
        return view('admin.usuarios.usuarios-editar', compact('usuario'));
    }

    
    public function updateUsuario(Request $request)
{
    $usuario = modelUsuarios::findOrFail($request->input('idUsuario'));

    $datos = $request->only(['nombre', 'correo', 'activo']);

    // Solo agrega la contraseña si llega
    if (!empty($request->input('contra'))) {
        $datos['contra'] = bcrypt($request->input('contra'));
    }

    $usuario->update($datos);

    return response()->json([
        'mensaje' => 'Usuario modificado exitosamente',
        'ok' => true
    ]);
}

}

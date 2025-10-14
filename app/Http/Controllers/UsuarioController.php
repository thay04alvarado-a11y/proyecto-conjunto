<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\modelUsuarios;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
      public function base()
    {
        return view("base");
    }


    public function Login()
    {
        return view("auth.login");
    }



    public function loginConfi(Request $request)
{
    try {
        $correo = $request->input('correo');
        $contra = $request->input('contra');

   

        
        $usuario = modelUsuarios::where('correo', $correo)->first();

       
        if (!$usuario) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'El correo no está registrado.',
            ], 401);
        }

        if ($contra !== $usuario->contra) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'Contraseña incorrecta.',
            ], 401);
        }


        if (!$usuario->activo) {
            return response()->json([
                'ok' => false,
                'mensaje' => 'Tu cuenta está desactivada. Contacta al administrador.',
            ], 401);
        }


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

  
    public function profile()
    {
        return "profile";
    }
    public function logout()
    {
        return "logout";
    }
    public function usuarios()
    {
        return view('admin.usuarios.usuarios');
    }
    public function usuariosForm()
    {
        return view('admin.usuarios.usuarios-form');
    }
    
}

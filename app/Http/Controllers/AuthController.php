<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // importar el modelo de usuario
use Illuminate\Support\Facades\Hash; //importa Hash para encriptar las contraseñas
use Illuminate\Validation\ValidationException; //importa la excepción de validación para errores

class AuthController extends Controller
{
    //aquí creamos los métodos 
    //para el registrar un usuario
    public function Register(Request $request){
        //validamos los parametros que entran, todos requieren tener datos
        $validated = $request -> validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users', //email unico
            'password' => 'required|string|min:8|confirmed', // password comfirmed
        ]);

        //todos los datos deben ser validados al crearse, la contraseña se encripta en co Hash
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        //el token de crea sanctum es único para cada usuario, la ultima parte obtiene un string 
        // del token para enviarlo al cliente
        $token = $user->createToken('auth_token')->plainTextToken;

        //si el usuario el correcto: la respuesta muestra el usuario creado, el token del usuario 
        // y bearer para confirmar la autentificación.
        return response() -> json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);

    }

    //para el login
    public function login(Request $request){
        //se validan los dato que ingresan
        $request -> validate([
        'email' => 'required|email',
        'password' => 'required',
        ]);

        //busca el email por usuario en la tabla User, deben coincidir con el usuario registrado 
        // y se obtiene el primer resultado o nulo si no existe
        $user = User::where('email', $request->email)->first();

        //si el usuario o la contraseña no coinciden lanza un error (HTTP 422)
        if (!$user || !Hash::check($request->password, $user->password)) {
                throw ValidationException::withMessages([
                'email' => ['Las credenciales son incorrectas.'],
            ]);
        }
        
        //se crea un token igual al del usuario encontrado
         $token = $user->createToken('auth_token')->plainTextToken;

         //se retorna el usuario encontrado
            return response()->json([
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    //para cerrar sesión
        public function logout(Request $request){
            $request->user()->currentAccessToken()->delete();

            return response()->json([
            'message' => 'Sesión cerrada exitosamente'
            ]);
        }

}

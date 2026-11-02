<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; // importar el modelo de usuario
use Illuminate\Support\Facades\Hash; //importa Hash para encriptar las contraseñas
use Illuminate\Validation\ValidationException; //importa la excepción de validación para errores
use App\Http\Requests\Api\V1\RegisterRequest;
use App\Http\Requests\Api\V1\LoginRequest;
use App\Http\Resources\UserResource;

class AuthController extends Controller
{
    //aquí creamos los métodos 
    //para el registrar un usuario
    public function register(RegisterRequest $request){
        //validamos los parametros que entran, todos requieren tener datos
        $validated = $request -> validated();

        //todos los datos deben ser validados al crearse, la contraseña se encripta en co Hash
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        //el token de crea sanctum es único para cada usuario, la ultima parte obtiene un string 
        // del token para enviarlo al cliente
        $token = $user->createToken('auth_token')->plainTextToken;

        //si el usuario el correcto: la respuesta muestra el usuario creado, el token del usuario 
        // y bearer para confirmar la autentificación.
        return response() -> json([
            'user' => new UserResource($user),
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);

    }

    //para el login
    public function login(LoginRequest $request){
        //se validan los dato que ingresan
        $validated = $request->validated();

        //busca el email por usuario en la tabla User, deben coincidir con el usuario registrado 
        // y se obtiene el primer resultado o nulo si no existe
        $user = User::where('email', $validated['email'])->first();

        //si el usuario o la contraseña no coinciden lanza un error (HTTP 422)
        if (!$user || !Hash::check($validated['password'], $user->password)) {
                throw ValidationException::withMessages([
                'email' => ['Las credenciales son incorrectas.'],
            ]);
        }
        
        //se crea un token igual al del usuario encontrado
         $token = $user->createToken('auth_token')->plainTextToken;

         //se retorna el usuario encontrado
            return response()->json([
            'user' => new UserResource($user),
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

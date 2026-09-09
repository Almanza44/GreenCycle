<?php

namespace App\Http\Controllers;

use App\Models\Tree; //s importa el modelo del arbol
use Illuminate\Http\Request; //importa la clase request para manejar los mensajes de HTTP

class TreeController extends Controller
{
    // Constructor con autorización (Registra automáticamente la autorización
    //  para los métodos del controlador)
    /*public function __construct()
    {
                                // Tree::class :modelo a autorizar
                                            //'tree': nombre del parametro en las rutas
        $this->authorizeResource(Tree::class, 'tree');
    }*/

    // GET /api/trees - para listar los árboles del usuario
    public function index(Request $request)
    {
        //se obtiene el usuario autenticado desde el token, 
        $trees = $request->user()
            ->trees() //accede a la relación trees() del usuario
            ->with('seedType') //carga la relación seedType para evitar N+1 queries 
            ->get(); //hace la consulta

        //devuelve la respuesta  con los arboles del usuario
        return response()->json([
            'data' => $trees,
            'message' => 'Árboles obtenidos exitosamente'
        ]);
    }

    // GET /api/trees/{tree} - para ver los detalles de un árbol propio
    //aqui el show recibe el parámetro {tree} de la ruta y lo convierte automáticamente en un objeto Tree
    public function show(Request $request, Tree $tree)
    {
        //esto carga la relación seedType después de obtener el árbol
        $tree->load('seedType');

        return response()->json([
            'data' => $tree,
            'message' => 'Detalle del árbol obtenido exitosamente'
        ]);
    }

    // POST /api/trees - para lantar un nuevo árbol

    public function store(Request $request)
    {
        //validamos los datos del cleinte
        $validated = $request->validate([
            'seed_type_id' => 'required|exists:seed_types,id',
            'name' => 'required|string|max:255',
        ]);

        // El servidor establece los valores internos por defecto (level=0, health=100, progress=0, status=ACTIVE)
        // se crea un nuevo árbol
        $tree = new Tree();
        // recibe los datos del usuario
        $tree->user_id = $request->user()->id;
        // recibe los datos del tipo de la semilla
        $tree->seed_type_id = $validated['seed_type_id'];
        // recibe el nombre del árbol
        $tree->name = $validated['name'];
        // guarda el árbol en la base de datos
        $tree->save();

        // carga la relación
        $tree->load('seedType');

        // retorna un mensaje de que se creó el árbol
        return response()->json([
            'data' => $tree,
            'message' => 'Árbol plantado exitosamente'
        ], 201);
    }

    
}
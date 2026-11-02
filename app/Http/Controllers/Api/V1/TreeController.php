<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Tree; //s importa el modelo del arbol
use Illuminate\Http\Request; //importa la clase request para manejar los mensajes de HTTP
use App\Http\Resources\TreeResource; //importa las repuestas del resource
use App\Http\Requests\Api\V1\StoreTreeRequest;
use App\Http\Requests\Api\V1\UpdateTreeRequest;

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
        'data' => TreeResource::collection($trees),
        'message' => 'Árboles obtenidos exitosamente'
    ]);
    }

    // GET /api/trees/{tree} - para ver los detalles de un árbol propio
    //aqui el show recibe el parámetro {tree} de la ruta y lo convierte automáticamente en un objeto Tree
    public function show(Request $request, Tree $tree)
    {
        //esto carga la relación seedType después de obtener el árbol
        $this->authorize('view', $tree);
        $tree->load('seedType');

        return response()->json([
            'data' => new TreeResource($tree),
            'message' => 'Detalle del árbol obtenido exitosamente'
        ]);
    }

    // POST /api/trees - para lantar un nuevo árbol

    public function store(StoreTreeRequest $request)
    {
        //validamos los datos del cleinte
        $validated = $request->validated();

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
            'data' => new TreeResource($tree),
            'message' => 'Árbol plantado exitosamente'
        ], 201);
    }

    public function update(UpdateTreeRequest $request, Tree $tree)
    {
        $this->authorize('update', $tree);

        $validated = $request->validated();

        $tree->update($validated);

        $tree->load('seedType');

        return response()->json([
            'data' => new TreeResource($tree),
            'message' => 'Árbol actualizado exitosamente'
        ]);
    }

    public function care(Tree $tree)
    {
        $this->authorize('care', $tree);
        if($tree->status === 'MATURE' || $tree->status === 'DEAD'){
            return response()->json([
                'error' => 'Este árbol no puede recibir más cuidados'
            ], 409);
        }

        if ($tree->next_care_at && now()->lt($tree->next_care_at)) {
            return response()->json([
                'error' => 'El árbol se encuentra en período de enfriamiento.',
                'next_care_at' => $tree->next_care_at?->toISOString()
            ], 409);

        }
        //aumentar progreso del árbol
        $tree->progress += 1;
        //aumentar salud del árbol sin sobrepasar el límite de 100
        $tree->health = min(100, $tree->health + 20);
        //obtener cuidados necesarios para subir de nivel
        $tree->load('seedType');
        $careNeeded = $tree->seedType->care_needed_per_level ?? 5;
        //lógica de subir de nivel
        if ($tree->progress >= 5) {
            $tree->level += 1;
            $tree->progress = 0;
            if($tree->level >= 10){
                $tree->status = 'MATURE';
            }
        }
        //agregar cooldown
        $tree->next_care_at = now()->addMinutes(60);
        //actualizar ultimo cuidado
        $tree->last_care_at = now();

        $tree->save();

        return response()->json([
            'message' => 'Cuidado aplicado con éxito',
            'tree' => new TreeResource($tree),
        ], 200);
    }
}
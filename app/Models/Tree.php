<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    //
    protected $fillable = [
        'user_id',
        'seed_type_id',
        'name'
        ];
    //arbol que pertenece a un usuario
     public function user()
    {
        return $this->belongsTo(User::class);
    }
    //arbol que pertenece a una semilla
    public function seedType()
    {
        return $this->belongsTo(SeedType::class);
    }
}

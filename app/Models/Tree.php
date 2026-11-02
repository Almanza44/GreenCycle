<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tree extends Model
{
    use HasFactory;
    //
    protected $fillable = [
        'user_id',
        'seed_type_id',
        'name'
        ];

    protected $casts = [
        'level'=>'integer',
        'health'=>'integer',
        'progress'=>'integer',
        'next_care_at'=> 'datetime',
        'last_deterioration_at'=> 'datetime',
        'last_care_at'=> 'datetime',
        'harvested_at'=> 'datetime',
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

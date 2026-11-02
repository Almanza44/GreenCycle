<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SeedType extends Model
{
    use HasFactory;
    //
    
    protected $fillable = [
        'name',
        'care_needed_per_level',
        'reward_coins',
    ];
    
    public function trees()
    {
        return $this->hasMany(Tree::class);
    }
}

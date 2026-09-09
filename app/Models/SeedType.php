<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeedType extends Model
{
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

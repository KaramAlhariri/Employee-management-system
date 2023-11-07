<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    
    public function employees(){
        return $this->hasMany(Employee::class);
    }

    protected $fillable = [
        'name',
        'city_id'
    ];
}

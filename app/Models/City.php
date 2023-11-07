<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function department(){
        return $this->hasMany(Department::class);
    }
    protected $fillable=[
        'name',
        'country_id'
    ];
        
}

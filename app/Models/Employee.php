<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
  public function user()
  {
    return $this->belongsTo(User::class);
  }
  
  public function department(){
    return $this->belongsTo(Department::class);
  }
  
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'department_id',
        'country_id',
        'city_id',
        'user_id',
        'salary',
        'birthdate',
        'datehired'
    ];

}

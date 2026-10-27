<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = ['name', 'number_of_employees', 'industry', 'phone_number', 'email'];
}

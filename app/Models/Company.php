<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Laravel\Sanctum\HasApiTokens;

class Company extends Model
{
    use HasFactory, HasApiTokens;
    protected $fillable = ['name', 'number_of_employees', 'industry', 'phone_number', 'email', 'password'];
    protected $appends = ['account_type'];

    public function getAccountTypeAttribute() {
        return 'company';
    }
}

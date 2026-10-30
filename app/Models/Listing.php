<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['company_id', 'title', 'location', 'years_of_experience', 'requirements', 'description', 'minimum_qualification', 'work_from', 'salary', 'salary', 'hourly', 'views'];
    protected $casts = ['views' => 'integer', 'salary', 'salary' => 'decimal:2',];

    public function company() {
        return $this->belongsTo(Company::class);
    }


}

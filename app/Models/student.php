<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    use HasFactory;

    protected $tabel='students';

    protected $fillable = [
        'id', 
        'name', 
        'phone_number', 
        'email', 
        'country', 
        'country_code', 
        'created_at', 
        'created_by', 
        'updated_at', 
        'updated_by'
    ];
}

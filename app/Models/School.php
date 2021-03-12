<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $table = 'schools';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email',
        'website',
        'logo'
    ];
}

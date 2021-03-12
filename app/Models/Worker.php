<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;

    protected $table = 'school_workers';
    public $timestamps = true;

    protected $fillable = [
        'firstname',
        'lastname',
        'school',
        'email',
        'phone'
    ];

    public function schools(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(School::class, 'school');
    }
}

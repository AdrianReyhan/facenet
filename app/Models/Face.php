<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Face extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'face_descriptor'];
    protected $casts = ['face_descriptor' => 'array']; // JSON format
}

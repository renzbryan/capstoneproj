<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'filename',       // Store the generated filename
        'original_name',  // Store the original name of the uploaded file
    ];
}

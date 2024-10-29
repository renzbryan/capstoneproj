<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileShare extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'files';
    protected $primaryKey = 'id';
    protected $fillable = ['filename',	'original_name'];
    protected $guarded = ['created_at',	'updated_at'];
}

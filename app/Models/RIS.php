<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RIS extends Model
{
    use HasFactory;

    protected $table = 'ris';

    // Specify the primary key associated with the table
    protected $primaryKey = 'id';


    protected $fillable = [
        'entity_name',
        'fundcluster',
        'division',
        'office',
        'rcc'
    ];
}
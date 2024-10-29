<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class BfarOffice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'bfar_office';

    protected $fillable = [
        'office',
        'rcc',
    ];
    public function getOptions()
    {
        return $this->pluck('office', 'id');
    }
}

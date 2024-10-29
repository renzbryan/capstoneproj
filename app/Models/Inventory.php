<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_inventory';
    protected $primaryKey = 'inventory_id';
    protected $fillable = ['inventory_name',	'inventory_category',	'inventory_quantity',	'inventory_status', ];
    protected $guarded = ['deleted_at',	'created_at',	'updated_at'];

}

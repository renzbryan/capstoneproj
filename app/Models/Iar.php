<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Item;
class Iar extends Model
{


    use HasFactory, SoftDeletes;

    protected $table = 'iar_tbl';
    protected $primaryKey = 'iar_id';
    protected $fillable = ['iar_entityname',	'iar_fundcluster',	'iar_supplier',	'iar_Podate',	'iar_rod',	'iar_rcc',	'iar_number',	'iar_date',	'iar_invoice',	'iar_invoice_d'];
    protected $guarded = ['deleted_at',	'created_at',	'updated_at'];

    
public function items()
{
    return $this->hasMany(Item::class, 'iar_id', 'iar_id');
}
public function comments()
{
    return $this->morphMany(Comment::class, 'commentable');
}


public function stockItems()
{
    return $this->hasMany(StockItem::class, 'iar_id');
}

public function scitems()
{
    return $this->hasMany(Scitem::class, 'iar_id');
}
}

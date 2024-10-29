<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WMRItem extends Model
{
    use HasFactory;

    // Specify the table associated with the model
    protected $table = 'wmrs';

    // Specify the primary key associated with the table
    protected $primaryKey = 'id';

    // Define the attributes that are mass assignable
    protected $fillable = [
        'item_id',
        'quantity',
        'name',
        'description',
        'unit'
    ];

    // Define the attributes that are guarded from mass assignment
    protected $guarded = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Define date attributes for mutators and accessors
    protected $dates = [
        'deleted_at'
    ];

    // Define the relationship with the Item model
    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'item_id');
    }
}

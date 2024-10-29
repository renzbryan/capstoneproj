<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pcitem extends Model
{
    use HasFactory;

    // Define the table if it's not following the Laravel convention
    protected $table = 'pcitems';

    // Specify which fields are mass assignable
    protected $fillable = [
        'stocks_id',
        'iar_id',          // Add this line to include iar_id
        'reference',
        'receipt_qty',
        'issue_qty',
        'issue_office',
        'balance_qty',
        'amount',
        'remarks',
        'date',
        'property_id'
    ];

    // Define relationships if needed
    public function property()
    {
        return $this->belongsTo(PropertyItem::class, 'id');
    }

    public function iar()
    {
        return $this->belongsTo(IAR::class, 'iar_id');
    }

}

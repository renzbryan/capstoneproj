<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scitem extends Model
{
    use HasFactory;

    // Define the table if it's not following the Laravel convention (singular form of 'scitems')
    protected $table = 'scitems';

    // Specify which fields are mass assignable
    protected $fillable = [
        'stocks_id',
        'iar_id',          // Add this line to include iar_id
        'reorder_point',
        'reference',
        'receipt_qty',
        'issue_qty',
        'issue_office',
        'balance_qty',
        'consume',
        'date'
    ];

    // Define relationships if needed, e.g., Scitem belongs to Stock
    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stocks_id');
    }

    public function iar()
    {
        return $this->belongsTo(IAR::class, 'iar_id');
    }

}

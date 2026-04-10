<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $fillable = [
        'item_id', 
        'qty', 
        'person_name', 
        'description', 
        'date', 
        'is_returned'
    ];

    // Relasi: Satu data peminjaman memiliki satu barang
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
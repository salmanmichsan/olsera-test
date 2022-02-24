<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPajak extends Model
{
    use HasFactory;

    public function pajak(){
        return $this->belongsTo(Pajak::class);
    }
    public function item(){
        return $this->belongsTo(Item::class);
    }
}

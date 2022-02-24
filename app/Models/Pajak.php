<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;

    public function itempajak()
    {
        return $this->hasOne(ItemPajak::class,'pajak_id');
    }

    public function item()
    {
        return $this->belongsToMany(Item::class,'item_pajaks');
    }
}

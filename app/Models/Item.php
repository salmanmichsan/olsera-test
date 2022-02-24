<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Item extends Model
{
    use HasFactory;

    public function pajak()
    {
        return $this->hasMany(ItemPajak::class,'item_id')->select('item_id','pajak_id as id','nama',DB::raw("concat(rate,'%') as rate"))->join('pajaks','pajaks.id','pajak_id');
    }
}

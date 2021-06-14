<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'comment'];

    public function padepokan(){
        return $this->belongsTo(Padepokan::class);
    }
}

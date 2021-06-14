<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Padepokan extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'gambar', 'deskripsi'];

    public function ulasan(){
        return $this->hasMany(Ulasan::class);
    }
}

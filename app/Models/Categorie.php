<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $table = "categories";
    public $timestamps = false;
    protected $fillable = ["name"];

    public function solutions()
    {
        return $this->belongsToMany(Solution::class);
    }
}

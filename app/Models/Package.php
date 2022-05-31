<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;
    protected $fillable =[
        'nombre',
        'descripcion',
        'status',
        'precio'
    ];

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}

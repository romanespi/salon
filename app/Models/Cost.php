<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    use HasFactory;
    protected $fillable=['descripcion','costo','event_id'];

    public function event(){
    return $this->belongsTo(Event::class);
}
}

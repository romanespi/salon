<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable=['url', 'usuario','event_id'];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}

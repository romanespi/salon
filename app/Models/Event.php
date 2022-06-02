<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $guarded=['created_at','updated_at','id'];
    
    public function photos(){
        return $this->hasMany(Photo::class);
    }

    public function package(){
        return $this->belongsTo(Package::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function costs(){
        return $this->hasMany(Cost::class);
    }

    public function payments(){
        return $this->hasMany(Payment::class);
    }
}

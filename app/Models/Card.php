<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;
    public function collection()
    {
        return $this->belongsToMany(Collection::class,'card_collections');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sale()
    {
        return $this->hasMany(Sale::class)->orderBy('price', 'asc');
    }
    public function sales()
    {
        return $this->belongsTo(Sale::class);
    }

    
}

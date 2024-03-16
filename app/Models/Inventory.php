<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $table = 'inventory';
    protected $fillable = [
        'character_id', // Add this line if it's not already present
        'item_id',
    ];

    public function charcter()
    {
        return $this->belongsTo(Character::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}

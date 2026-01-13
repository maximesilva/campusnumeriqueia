<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'make',
        'model',
        'year',
        'color',
        'price',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

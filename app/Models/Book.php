<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'author', 'description', 'isbn', 'quantity'];

    public static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $query) {
            $query->orderBy('title');
        });
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}

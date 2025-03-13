<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    protected $fillable = ['borrower', 'book_id', 'borrow_date', 'return_date', 'status'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($borrow) {
            $book = $borrow->book;
            $book->is_available = true;
            $book->save();
        });
    }
    public function book() {
        return $this->belongsTo(Book::class);
    }
}
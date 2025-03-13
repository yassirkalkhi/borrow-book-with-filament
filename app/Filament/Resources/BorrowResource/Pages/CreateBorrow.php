<?php

namespace App\Filament\Resources\BorrowResource\Pages;

use App\Filament\Resources\BorrowResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Book;

class CreateBorrow extends CreateRecord
{
    protected static string $resource = BorrowResource::class;

    // Add the afterCreate() hook here
    protected function afterCreate(): void
    {
        $book = Book::find($this->record->book_id);
        $book->is_available = false;
        $book->save();
    }
}
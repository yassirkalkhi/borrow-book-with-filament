<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn; 
use Filament\Forms\Components\TextInput; 
use Filament\Tables\Columns\IconColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\DatePicker;

class BookResource extends Resource
{
    protected static ?string $model = Book::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
   // app/Filament/Resources/BookResource.php
   public static function form(Form $form): Form
   {
       return $form
           ->schema([
               TextInput::make('author')
                   ->label('المؤلف')
                   ->required(),
               
               TextInput::make('title')
                   ->label('عنوان المرجع')
                   ->required(),
               
               TextInput::make('material_type')
                   ->label('نوعية المادة')
                   ->required(),
                              

               TextInput::make('publishing_place')
                   ->label('مكان النشر')
                   ->nullable(),
               
               TextInput::make('publisher')
                   ->label('الناشر')
                   ->nullable(),
               
               DatePicker::make('publish_date')
                   ->label('تاريخ النشر')
                   ->nullable(),
               
               TextInput::make('parts')
                   ->label('الأجزاء')
                   ->numeric()
                   ->nullable(),
               
               TextInput::make('ratio_count')
                   ->label('عدد النسخ')
                   ->numeric()
                   ->nullable(),

               
               Toggle::make('is_available')
                   ->label('متاح')
                   ->default(true),
           ]);
   }

    public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('author')->label('المؤلف')->searchable(),
            TextColumn::make('title')->label('عنوان المرجع')->searchable(),
            TextColumn::make('material_type')->label('نوعية المادة')->searchable(),
            TextColumn::make('publishing_place')->label('مكان النشر')->searchable(),
            TextColumn::make('publisher')->label('الناشر')->searchable(),
            TextColumn::make('publish_date')->label('تاريخ النشر')->date()->searchable(),
            TextColumn::make('parts')->label('الأجزاء')->searchable(),
            TextColumn::make('ratio_count')->label('عدد النسخ')->searchable(),
            IconColumn::make('is_available')
                ->label('متاح')
                ->boolean()
                ->trueIcon('heroicon-o-check')
                ->falseIcon('heroicon-o-x-circle'),
        ])
        ->actions([
            Tables\Actions\EditAction::make(),
            Tables\Actions\DeleteAction::make(),
            
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}
    public static function getNavigationLabel(): string
{
              return 'المراجع'; 
}
    public static function getPluralModelLabel(): string
{
    return 'المراجع'; 
}
public static function getNavigationGroup(): ?string
{
    return 'المراجع العربية بخزانة المحكمة الابتدائية '; 
}
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route('/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
        ];
    }
}

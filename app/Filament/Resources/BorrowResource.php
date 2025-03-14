<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BorrowResource\Pages;
use App\Filament\Resources\BorrowResource\RelationManagers;
use App\Models\Borrow;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Book;
use Filament\Actions\AfterCreate;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput; 
use Filament\Forms\Components\Toggle; 




class BorrowResource extends Resource
{
    protected static ?string $model = Borrow::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('borrower')
                    ->label('المستلم')      
                    ->required(),

                Select::make('book_id')
                    ->label('المرجع')
                    ->relationship('book', 'title')
                    ->searchable()
                    ->required(),

                DatePicker::make('borrow_date')
                    ->label('تاريخ التسليم')
                    ->default(now())
                    ->required()
                    ,

                DatePicker::make('return_date')
                    ->label('تاريخ الإرجاع')
                    ->nullable()
                    ->after('borrow_date')
                    ->validationMessages([
                        'required' => 'حقل تاريخ التسليم مطلوب.',
                        'date' => 'يجب أن يكون تاريخ التسليم تاريخًا صالحًا.',
                        'after' => 'يجب أن يكون تاريخ الإرجاع  بعد تاريخ التسليم.',
                    ])
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('borrower')
                    ->label('سلمت ل')->searchable(),
                TextColumn::make('book.title')
                    ->label('المرجع')->searchable(),
                TextColumn::make('borrow_date')
                    ->label('تاريخ التسليم')->searchable(),
                TextColumn::make('return_date')
                    ->label('تاريخ الإرجاع')->searchable(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->requiresConfirmation()
                ->action(function ($record) {
                    $record->delete(); 
                }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    public static function getNavigationLabel(): string
    {
                  return ' جميع التسليمات'; 
    }
    public static function getPluralModelLabel(): string
{
                 return 'التسليمات'; 
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
            'index' => Pages\ListBorrows::route('/'),
            'create' => Pages\CreateBorrow::route('/create'), // Use custom page
            'edit' => Pages\EditBorrow::route('/{record}/edit'),
        ];
    }
}

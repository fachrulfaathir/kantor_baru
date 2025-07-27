<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingTransactionResource\Pages;
use App\Filament\Resources\BookingTransactionResource\RelationManagers;
use App\Models\BookingTransaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingTransactionResource extends Resource
{
    protected static ?string $model = BookingTransaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('booking_trx_id')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('total_amount')
                ->required()
                ->numeric()
                ->prefix('IDR'),

                Forms\Components\TextInput::make('duration')
                ->required()
                ->numeric()
                ->prefix('Days'),

                Forms\Components\DateTimePicker::make('started_at')
                ->required(),

                Forms\Components\DateTimePicker::make('ended_at')
                ->required(),

                Forms\Components\Select::make('is_paid')
                ->options([
                    true => 'Paid',
                    false => 'Not Paid',
                ])
                ->required(),

                Forms\Components\Select::make('office_space_id')
                ->relationship(name: 'officeSpace', titleAttribute: 'name')
                ->searchable()
                ->preload()
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),

                Tables\Columns\TextColumn::make('booking_trx_id')
                ->searchable(),
                Tables\Columns\TextColumn::make('phone_number')
                ->searchable(),
                Tables\Columns\TextColumn::make('total_amount')
                ->searchable(),
                Tables\Columns\TextColumn::make('duration')
                ->searchable(),
                Tables\Columns\TextColumn::make('started_at')
                ->searchable(),
                Tables\Columns\TextColumn::make('ended_at')
                ->searchable(),
                Tables\Columns\TextColumn::make('officeSpace.name')
                ->searchable(),
                Tables\Columns\IconColumn::make('is_paid')
                ->boolean()
                ->falseColor('danger')
                ->trueColor('success') 
                ->falseIcon('heroicon-o-x-circle')              
                ->trueIcon('heroicon-o-check-circle')    
                ->label('Available')   
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
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
            'index' => Pages\ListBookingTransactions::route('/'),
            'create' => Pages\CreateBookingTransaction::route('/create'),
            'edit' => Pages\EditBookingTransaction::route('/{record}/edit'),
        ];
    }
}

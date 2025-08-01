<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OfficeSpaceResource\Pages;
use App\Filament\Resources\OfficeSpaceResource\RelationManagers;
use App\Models\OfficeSpace;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\SelectFilter;


class OfficeSpaceResource extends Resource
{
    protected static ?string $model = OfficeSpace::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),

                Forms\Components\TextInput::make('address')
                ->required()
                ->maxLength(255),

                Forms\Components\FileUpload::make('thumbnail')
                ->image()
                ->required(),

                Forms\Components\Textarea::make('about')
                ->required()
                ->rows(10)
                ->cols(10),

                Forms\Components\Repeater::make('photos')
                ->relationship('photos')
                ->schema([
                    Forms\Components\FileUpload::make('photo')
                    ->required()
                ]),

                Forms\Components\Repeater::make('benefits')
                ->relationship('benefits')
                ->schema([
                    Forms\Components\TextInput::make('name')
                    ->required()
                ]),

                Forms\Components\Select::make('city_id')
                ->relationship(name: 'city', titleAttribute: 'name')
                ->searchable()
                ->preload()
                ->required(),

                Forms\Components\TextInput::make('price')
                ->numeric()
                ->prefix('IDR')
                ->required(),

                Forms\Components\TextInput::make('duration')
                ->numeric()
                ->prefix('Days')
                ->required(),

                Forms\Components\Select::make('is_open')
                ->options([
                    true => 'Open',
                    false => 'Not Open',
                ])
                ->required(),


                Forms\Components\Select::make('is_full_book')
                ->options([
                    true => 'Not Available',
                    false => 'Available',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                ->searchable(),
                Tables\Columns\TextColumn::make('city.name')
                ->searchable(),
                Tables\Columns\IconColumn::make('is_full_book')
                ->boolean()
                ->trueColor('danger')
                ->falseColor('success') 
                ->trueIcon('heroicon-o-x-circle')              
                ->falseIcon('heroicon-o-check-circle')    
                ->label('Available')          
            ])
            ->filters([
                SelectFilter::make('city_id')
                    ->label('City')
                    ->relationship('city', 'name')
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
            'index' => Pages\ListOfficeSpaces::route('/'),
            'create' => Pages\CreateOfficeSpace::route('/create'),
            'edit' => Pages\EditOfficeSpace::route('/{record}/edit'),
        ];
    }
}

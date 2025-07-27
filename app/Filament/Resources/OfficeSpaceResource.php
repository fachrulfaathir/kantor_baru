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

class OfficeSpaceResource extends Resource
{
    protected static ?string $model = OfficeSpace::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                ->helperText('fill the name')
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
                    Forms\Components\FileUpload::make('photos')
                    ->required()
                ]),

                Forms\Components\Repeater::make('benefits')
                ->relationship('benefits')
                ->schema([
                    Forms\Components\TextInput::make('benefits')
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
                ->numeric()
                ->option([
                    true => 'Open',
                    false => 'New Open',
                ])
                ->required(),


                Forms\Components\Select::make('is_open')
                ->numeric()
                ->option([
                    true => 'Open',
                    false => 'New Open',
                ])
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListOfficeSpaces::route('/'),
            'create' => Pages\CreateOfficeSpace::route('/create'),
            'edit' => Pages\EditOfficeSpace::route('/{record}/edit'),
        ];
    }
}

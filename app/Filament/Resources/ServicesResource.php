<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicesResource\Pages;
use App\Filament\Resources\ServicesResource\RelationManagers;
use App\Models\Services;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServicesResource extends Resource
{
    protected static ?string $model = Services::class;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';
    protected static ?string $modelLabel = 'Serviços';

    public static function form(Form $form): Form
    {
        return $form->columns(4)
            ->schema([
                Forms\Components\TextInput::make('Description')
                    ->required(),
                Forms\Components\TextInput::make('value')
                    ->required()
                    ->label('Valor')
                    ->numeric()
                    ->placeholder('00,00'),
                Forms\Components\TextInput::make('Time')
                    ->required()
                    ->numeric()
                    ->placeholder('00'),
                Forms\Components\Select::make('Category')->required()
                    ->options([
                        'Cut'=> 'Corte',
                        'Barber'=> 'Barba',
                        'Brow'=> 'Sobrancelha',
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('Description')
                ->searchable(),
                Tables\Columns\TextColumn::make('Value')
                ->formatStateUsing(fn ($state) => number_format($state, 2, ',', '.'))
                ->translateLabel(),
                Tables\Columns\TextColumn::make('Time')
                ->translateLabel(),
                Tables\Columns\TextColumn::make('Category')
                ->translateLabel(),
                Tables\Columns\TextColumn::make('created_at')
                ->translateLabel()
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->translateLabel()
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateServices::route('/create'),
            'edit' => Pages\EditServices::route('/{record}/edit'),
        ];
    }
}

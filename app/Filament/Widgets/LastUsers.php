<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LastUsers extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                fn() => \App\Models\User::latest()
            )
            ->columns([
                Tables\Columns\TextColumn::make("id"),
                Tables\Columns\TextColumn::make("name"),
            ]);
    }
}

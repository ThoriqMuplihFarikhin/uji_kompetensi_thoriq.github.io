<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SppplanResource\Pages;
use App\Filament\Resources\SppplanResource\RelationManagers;
use App\Models\Sppplan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SppplanResource extends Resource
{
    protected static ?string $model = Sppplan::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';
    protected static ?string $navigationLabel = 'SPP Plan';
    protected static ?string $pluralModelLabel = 'SPP Plans';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('amount')
                ->label('Nominal SPP')
                ->numeric()
                ->required()
                ->prefix('Rp'),

            Forms\Components\TextInput::make('period')
                ->label('Periode')
                ->placeholder('2024-01')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('amount')
                ->label('Nominal')
                ->money('IDR')
                ->sortable(),

            Tables\Columns\TextColumn::make('period')
                ->label('Periode')
                ->sortable()
                ->searchable(),

            Tables\Columns\TextColumn::make('created_at')
                ->label('Dibuat')
                ->dateTime()
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListSppplans::route('/'),
            'create' => Pages\CreateSppplan::route('/create'),
            'view' => Pages\ViewSppplan::route('/{record}'),
            'edit' => Pages\EditSppplan::route('/{record}/edit'),
        ];
    }
}

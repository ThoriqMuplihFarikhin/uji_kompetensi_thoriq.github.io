<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FinancialReportResource\Pages;
use App\Models\FinancialReport;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FinancialReportResource extends Resource
{
    protected static ?string $model = FinancialReport::class;
    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationGroup = 'Laporan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('date')
                    ->required(),

                Forms\Components\TextInput::make('income')
                    ->label('Pemasukan')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('expenses')
                    ->label('Pengeluaran')
                    ->numeric()
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->label('Saldo / Total')
                    ->numeric()
                    ->required(),

                Forms\Components\Textarea::make('description')
                    ->label('Keterangan')
                    ->rows(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('income')
                    ->money('idr', true)
                    ->label('Pemasukan')
                    ->sortable(),

                Tables\Columns\TextColumn::make('expenses')
                    ->money('idr', true)
                    ->label('Pengeluaran')
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->money('idr', true)
                    ->label('Saldo / Total')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(50)
                    ->label('Keterangan'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFinancialReports::route('/'),
            'create' => Pages\CreateFinancialReport::route('/create'),
            'view' => Pages\ViewFinancialReport::route('/{record}'),
            'edit' => Pages\EditFinancialReport::route('/{record}/edit'),
        ];
    }
}

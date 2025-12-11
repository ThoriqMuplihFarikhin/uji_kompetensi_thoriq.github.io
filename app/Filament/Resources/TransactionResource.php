<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TransactionResource\Pages;
use App\Filament\Resources\TransactionResource\RelationManagers;
use App\Models\Transaction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Forms\Components\Select::make('payment_id')
                ->label('Payment')
                ->relationship('payment', 'id')
                ->searchable()
                ->required()
                ->reactive()
                ->afterStateUpdated(function ($state, callable $set) {
                    $payment = \App\Models\Payment::find($state);

                    if ($payment) {
                        // Contoh: jika payment punya relasi student & amount
                        $set('amount', $payment->amount ?? null);
                    }
                }),

            Forms\Components\DatePicker::make('date')
                ->label('Transaction Date')
                ->required(),

            Forms\Components\TextInput::make('amount')
                ->label('Amount')
                ->numeric()
                ->required(),

            Forms\Components\Select::make('type')
                ->label('Type')
                ->options([
                    'income' => 'Income',
                    'expense' => 'Expense',
                ])
                ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                ->sortable()
                ->label('ID'),

            Tables\Columns\TextColumn::make('payment.id')
                ->label('Payment ID')
                ->sortable(),

            Tables\Columns\TextColumn::make('amount')
                ->label('Amount')
                ->money('IDR', true)
                ->sortable(),

            Tables\Columns\TextColumn::make('date')
                ->label('Date')
                ->date('d M Y')
                ->sortable(),

            Tables\Columns\BadgeColumn::make('type')
                ->colors([
                    'success' => 'income',
                    'danger'  => 'expense',
                ])
                ->label('Type')
                ->sortable(),
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
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'view' => Pages\ViewTransaction::route('/{record}'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }
}

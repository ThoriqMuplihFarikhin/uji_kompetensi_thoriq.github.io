<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PaymentResource\Pages;
use App\Filament\Resources\PaymentResource\RelationManagers;
use App\Models\Payment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PaymentResource extends Resource
{
    protected static ?string $model = Payment::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('invoice_id')
                    ->label('Invoice')
                    ->relationship('invoice', 'id')
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $invoice = \App\Models\Invoice::find($state);

                        if ($invoice) {
                            $set('student_id', $invoice->student_id);
                            $set('amount', $invoice->amount);
                        }
                    }),
                
                Forms\Components\Hidden::make('student_id'),
                Forms\Components\Select::make('student_id')
                    ->label('Student')
                    ->relationship('student', 'name')
                    ->required()
                    ->disabled(),

                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->readOnly(),

                Forms\Components\DatePicker::make('payment_date')
                    ->label('Payment Date')
                    ->required(),

                Forms\Components\Select::make('method')
                    ->label('Payment Method')
                    ->options([
                        'cash' => 'Cash',
                        'transfer' => 'Transfer',
                        'qris' => 'QRIS',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('invoice.id')
                    ->label('Invoice ID')
                    ->sortable(),

                Tables\Columns\TextColumn::make('student.name')
                    ->label('Student')
                    ->searchable(),

                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR', true)
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Payment Date')
                    ->date('d M Y'),

                Tables\Columns\BadgeColumn::make('method')
                    ->colors([
                        'primary' => ['cash'],
                        'warning' => ['transfer'],
                        'success' => ['qris'],
                    ])
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
            'index' => Pages\ListPayments::route('/'),
            'create' => Pages\CreatePayment::route('/create'),
            'view' => Pages\ViewPayment::route('/{record}'),
            'edit' => Pages\EditPayment::route('/{record}/edit'),
        ];
    }
}

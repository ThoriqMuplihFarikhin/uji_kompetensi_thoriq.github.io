<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InvoiceResource\Pages;
use App\Filament\Resources\InvoiceResource\RelationManagers;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Invoices';
    protected static ?string $pluralLabel = 'Invoices';
    protected static ?string $navigationGroup = 'SPP Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('student_id')
                    ->label('Student')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->required(),

                Forms\Components\Select::make('spp_plan_id')
                    ->label('SPP Plan')
                    ->relationship('sppplan', 'period')
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $spp = \App\Models\Sppplan::find($state);
                        if ($spp) {
                            $set('amount', $spp->amount);
                        }
                    }),

                Forms\Components\TextInput::make('period')
                    ->label('Period')
                    ->placeholder('2025-01')
                    ->required(),

                Forms\Components\TextInput::make('amount')
                    ->numeric()
                    ->required()
                    ->readOnly(),

                Forms\Components\Select::make('status')
                    ->options([
                        'paid' => 'Paid',
                        'unpaid' => 'Unpaid',
                    ])
                    ->default('unpaid')
                    ->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('student.name')
                    ->label('Student')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('spp.period')
                    ->label('SPP Period')
                    ->sortable(),

                Tables\Columns\TextColumn::make('period')
                    ->label('Invoice Period'),

                Tables\Columns\TextColumn::make('amount')
                    ->money('IDR', true)
                    ->sortable(),

                Tables\Columns\BadgeColumn::make('status')
                    ->colors([
                        'success' => 'paid',
                        'danger' => 'unpaid',
                    ])
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->date('d M Y'),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'view' => Pages\ViewInvoice::route('/{record}'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}

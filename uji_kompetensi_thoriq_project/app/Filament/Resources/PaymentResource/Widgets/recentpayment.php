<?php

namespace App\Filament\Resources\PaymentResource\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use App\Models\Payment;

class RecentPayments extends BaseWidget
{
    // protected static string $view = 'filament.widgets.recent-payments';
    protected int|string|array $columnSpan = 'full';
    protected static ?int $chartHeight = 400;
    protected static ?int $sort = 1;
    public function table(Table $table): Table
    {
        return $table
            ->query(Payment::query()->latest()->limit(10))
            ->columns([
                Tables\Columns\TextColumn::make('id')->label('Payment ID'),
                Tables\Columns\TextColumn::make('student.name')->label('Student'),
                Tables\Columns\TextColumn::make('amount')->money('IDR', true),
                Tables\Columns\TextColumn::make('payment_date')->date('d M Y'),
                Tables\Columns\BadgeColumn::make('method')
                    ->colors([
                        'primary' => ['cash'],
                        'warning' => ['transfer'],
                        'success' => ['qris'],
                    ]),
            ]);
    }
}

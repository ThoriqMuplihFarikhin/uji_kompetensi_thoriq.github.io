<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\ChartWidget;

class IncomeChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Income (Last 6 months)';
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected function getType(): string
    {
        return 'line';
    }

    protected function getData(): array
    {
        // same logic as before, using `date`, `type`, `amount`
        $months = collect();
        for ($i = 5; $i >= 0; $i--) {
            $months->push(Carbon::now()->subMonths($i)->format('Y-m'));
        }

        $start = Carbon::now()->subMonths(5)->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $rows = Transaction::select(
                DB::raw("DATE_FORMAT(`date`, '%Y-%m') as month"),
                DB::raw("SUM(amount) as total")
            )
            ->where('type', 'income')
            ->whereBetween('date', [$start, $end])
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        $data = $months->map(fn($m) => (float) ($rows->get($m)->total ?? 0))->toArray();

        return [
            'labels' => $months->map(fn($m) => Carbon::createFromFormat('Y-m', $m)->format('M Y'))->toArray(),
            'datasets' => [
                [
                    'label' => 'Pemasukan',
                    'data' => $data,
                    'fill' => false,
                    'tension' => 0.4,
                ],
            ],
        ];
    }
}

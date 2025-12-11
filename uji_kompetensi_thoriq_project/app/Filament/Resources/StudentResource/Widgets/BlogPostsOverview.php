<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use App\Models\Student;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StudentStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Students', Student::count())
                ->description('Semua siswa terdaftar')
                ->color('primary'),

            Stat::make('Laki-laki', Student::where('gender', 'L')->count())
                ->description('Jumlah siswa laki-laki')
                ->color('success'),

            Stat::make('Perempuan', Student::where('gender', 'P')->count())
                ->description('Jumlah siswa perempuan')
                ->color('pink'),

            Stat::make('Active Students', Student::where('status', 'active')->count())
                ->description('Siswa yang masih aktif')
                ->color('info'),
        ];
    }
}

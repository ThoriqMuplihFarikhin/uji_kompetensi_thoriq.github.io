<?php

namespace App\Filament\Resources\SppResource\Pages;

use App\Filament\Resources\SppResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSpp extends ViewRecord
{
    protected static string $resource = SppResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

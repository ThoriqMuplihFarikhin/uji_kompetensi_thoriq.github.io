<?php

namespace App\Filament\Resources\SppplanResource\Pages;

use App\Filament\Resources\SppplanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewSppplan extends ViewRecord
{
    protected static string $resource = SppplanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}

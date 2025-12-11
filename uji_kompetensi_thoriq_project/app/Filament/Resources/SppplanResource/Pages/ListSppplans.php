<?php

namespace App\Filament\Resources\SppplanResource\Pages;

use App\Filament\Resources\SppplanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSppplans extends ListRecords
{
    protected static string $resource = SppplanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

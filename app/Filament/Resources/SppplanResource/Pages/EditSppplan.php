<?php

namespace App\Filament\Resources\SppplanResource\Pages;

use App\Filament\Resources\SppplanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSppplan extends EditRecord
{
    protected static string $resource = SppplanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}

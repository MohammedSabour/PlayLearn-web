<?php

namespace App\Filament\Resources\SimulationActivityResource\Pages;

use App\Filament\Resources\SimulationActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSimulationActivity extends EditRecord
{
    protected static string $resource = SimulationActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

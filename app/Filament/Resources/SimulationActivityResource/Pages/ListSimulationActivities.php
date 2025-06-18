<?php

namespace App\Filament\Resources\SimulationActivityResource\Pages;

use App\Filament\Resources\SimulationActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSimulationActivities extends ListRecords
{
    protected static string $resource = SimulationActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

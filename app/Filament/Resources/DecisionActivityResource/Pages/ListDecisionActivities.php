<?php

namespace App\Filament\Resources\DecisionActivityResource\Pages;

use App\Filament\Resources\DecisionActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDecisionActivities extends ListRecords
{
    protected static string $resource = DecisionActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

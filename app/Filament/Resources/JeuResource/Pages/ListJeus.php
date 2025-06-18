<?php

namespace App\Filament\Resources\JeuResource\Pages;

use App\Filament\Resources\JeuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJeus extends ListRecords
{
    protected static string $resource = JeuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\JeuResource\Pages;

use App\Filament\Resources\JeuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJeu extends EditRecord
{
    protected static string $resource = JeuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

<?php

namespace App\Filament\Resources\DecisionActivityResource\Pages;

use App\Filament\Resources\DecisionActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDecisionActivity extends EditRecord
{
    protected static string $resource = DecisionActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

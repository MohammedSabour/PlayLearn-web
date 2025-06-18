<?php

namespace App\Filament\Resources\QuizActivityResource\Pages;

use App\Filament\Resources\QuizActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizActivities extends ListRecords
{
    protected static string $resource = QuizActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

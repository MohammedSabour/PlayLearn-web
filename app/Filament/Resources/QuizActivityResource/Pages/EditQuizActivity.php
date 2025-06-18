<?php

namespace App\Filament\Resources\QuizActivityResource\Pages;

use App\Filament\Resources\QuizActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuizActivity extends EditRecord
{
    protected static string $resource = QuizActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

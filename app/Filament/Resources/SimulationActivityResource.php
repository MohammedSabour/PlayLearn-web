<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SimulationActivityResource\Pages;
use App\Filament\Resources\SimulationActivityResource\RelationManagers;
use App\Models\Simulation;
use App\Models\SimulationActivity;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SimulationActivityResource extends Resource
{
    protected static ?string $model = Simulation::class;

    public static function getNavigationLabel(): string
    {
        return __("Simulation Activity");
    }

    protected static ?string $navigationGroup="Creation Jeu";

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Wizard::make([
                Forms\Components\Wizard\Step::make('MCQ Activity')
                    ->schema([
                        Forms\Components\Select::make('id_jeu')
                            ->label('Jeu associé')
                            ->relationship('jeu', 'titre')
                            ->required(),
                        
                        Forms\Components\TextInput::make('titre')
                            ->label('Titre')
                            ->required(),

                        Forms\Components\Textarea::make('description')
                            ->label('Description'),
                    ]),
            ])->columnSpan('full')
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titre')->label('Titre'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSimulationActivities::route('/'),
            'create' => Pages\CreateSimulationActivity::route('/create'),
            'edit' => Pages\EditSimulationActivity::route('/{record}/edit'),
        ];
    }
}

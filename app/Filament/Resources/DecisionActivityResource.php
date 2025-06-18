<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DecisionActivityResource\Pages;
use App\Filament\Resources\DecisionActivityResource\RelationManagers;
use App\Models\Decision;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DecisionActivityResource extends Resource
{
    protected static ?string $model = Decision::class;

    public static function getNavigationLabel(): string
    {
        return __("Decision Activity");
    }

    protected static ?string $navigationGroup="Creation Jeu";

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Decision Activity')
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
                            
                            Forms\Components\Select::make('duration')
                                ->label('Temps limite')
                                ->options([
                                    5 => '5 Minutes',
                                    10 => '10 Minutes',
                                    15 => '20 Minutes',
                                ])
                                ->default(5)
                                ->required(),
                            Forms\Components\Repeater::make('choixDecisions')
                                ->relationship()
                                ->minItems(2)
                                ->schema([
                                    Forms\Components\TextInput::make('choice_text')
                                        ->placeholder('Enter decision option...')
                                        ->label('Choice decision')
                                        ->required(),
                                    Forms\Components\TextInput::make('cout')
                                        ->numeric()
                                        ->default(0)
                                        ->required(),
                                    Forms\Components\Repeater::make('impacts')
                                        ->relationship()
                                        ->minItems(1)
                                        ->schema([
                                            Forms\Components\Select::make('id_parametre')
                                                ->label('Paramètre Affecté')
                                                ->relationship('parametre', 'nom')
                                                ->required(),
                                            Forms\Components\TextInput::make('valeur_impact')
                                                ->numeric()
                                                ->default(0)
                                                ->required(),
                                        ]),
                                ]),
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
            'index' => Pages\ListDecisionActivities::route('/'),
            'create' => Pages\CreateDecisionActivity::route('/create'),
            'edit' => Pages\EditDecisionActivity::route('/{record}/edit'),
        ];
    }
}

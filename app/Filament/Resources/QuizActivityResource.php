<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizActivityResource\Pages;
use App\Filament\Resources\QuizActivityResource\RelationManagers;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizActivityResource extends Resource
{
    protected static ?string $model = Quiz::class;

    public static function getNavigationLabel(): string
    {
        return __("Quiz Activity");
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

                            Forms\Components\Select::make('id_parametre')
                                ->label('Paramètre Affecté')
                                ->relationship('parametre', 'nom')
                                ->required(),
                            
                            Forms\Components\Repeater::make('questions')
                                ->relationship()
                                ->minItems(1)
                                ->schema([
                                    Forms\Components\TextInput::make('question_text')
                                        ->placeholder('Type the question here...')
                                        ->required(),
            
                                    Forms\Components\Select::make('time')
                                        ->label('Temps limite')
                                        ->options([
                                            5 => '5 Seconds',
                                            10 => '10 Seconds',
                                            20 => '20 Seconds',
                                            30 => '30 Seconds',
                                            60 => '1 Minute',
                                            120 => '2 Minutes',
                                        ])
                                        ->default(10)
                                        ->required(),

                                    Forms\Components\Select::make('type')
                                        ->options([
                                            'qcm' => 'QCM',
                                            'qcu' => 'QCU',
                                        ])
                                        ->reactive()
                                        ->required(),

                                    Forms\Components\Repeater::make('qcm_choices')
                                        ->relationship('choices')
                                        ->schema([
                                            Forms\Components\TextInput::make('choice_text')
                                                ->placeholder('Enter answer option...')
                                                ->label('Choice')
                                                ->required(),
            
                                            Forms\Components\Checkbox::make('is_correct')
                                                ->label('Is Correct?'),
                                            
                                            Forms\Components\TextInput::make('variation')
                                                ->label('Impact sur paramètre')
                                                ->numeric()
                                                ->default(0)
                                                ->required(),
                                        ])
                                        ->minItems(2)
                                        ->label('Choices')
                                        ->createItemButtonLabel('Add Choice')
                                        ->hidden(fn (callable $get) => $get('type') !== 'qcm'),
            
                                    // Repeater pour QCU
                                    Forms\Components\Repeater::make('qcu_choices')
                                        ->relationship('choices')
                                        ->schema([
                                            Forms\Components\TextInput::make('choice_text')
                                                ->placeholder('Enter answer option...')
                                                ->label('Choice')
                                                ->required(),
            
                                            Forms\Components\Checkbox::make('is_correct')
                                                ->label('Is Correct?'),

                                            Forms\Components\TextInput::make('variation')
                                                ->label('Impact sur paramètre')
                                                ->numeric()
                                                ->default(0)
                                                ->required(),
                                        ])
                                        ->minItems(2)
                                        ->label('Choices')
                                        ->createItemButtonLabel('Add Choice')
                                        ->hidden(fn (callable $get) => $get('type') !== 'qcu'),
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
            'index' => Pages\ListQuizActivities::route('/'),
            'create' => Pages\CreateQuizActivity::route('/create'),
            'edit' => Pages\EditQuizActivity::route('/{record}/edit'),
        ];
    }
}

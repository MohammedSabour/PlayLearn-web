<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use App\Models\GameSession;
use Illuminate\Support\Str;

class QuizResource extends Resource
{
    protected static ?string $model = Quiz::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Questions')
                        ->schema([
                            Forms\Components\Repeater::make('questions')
                                ->relationship()
                                ->minItems(1)
                                ->schema([
                                    Forms\Components\Select::make('points')
                                        ->required()
                                        ->label(false)
                                        ->options([
                                            1 => '1 Point',
                                            2 => '2 Points',
                                            3 => '3 Points',
                                            4 => '4 Points',
                                            5 => '5 Points',
                                            6 => '6 Point',
                                            7 => '7 Points',
                                            8 => '8 Points',
                                            9 => '9 Points',
                                            10 => '10 Points',
                                        ])
                                        ->default(1),
                                    Forms\Components\Select::make('time')
                                        ->required()
                                        ->label(false)
                                        ->options([
                                            5 => '5 Seconds ',
                                            10 => '10 Seconds',
                                            20 => '20 Seconds',
                                            30 => '30 Seconds',
                                            60 => '1 Minute',
                                            120 => '2 Minutes',
                                        ])
                                        ->default(10),
                                    Forms\Components\TextInput::make('question_text')
                                        ->placeholder('type the question here ...')
                                        ->label(false),
                                    // options
                                    Forms\Components\Repeater::make('choices')
                                        ->relationship()
                                        ->minItems(2)
                                        ->schema([
                                            Forms\Components\TextInput::make('choice_text')
                                                ->placeholder('type answer option here ...')
                                                ->label(false),
                                            Forms\Components\Checkbox::make('is_correct')
                                                ->label('Is Correct?'),
                                        ])
                                        ->label('Choices')
                                        ->createItemButtonLabel('Add Choice')
                                        ->grid(1),
                                ])
                                ->label('Questions')
                                ->createItemButtonLabel('Add Question')
                                ->grid(1),
                        ]),

                    // Étape 2: Informations sur le Quiz
                    Forms\Components\Wizard\Step::make('Quiz Information')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->required()
                                ->label('Quiz Title'),
                            Forms\Components\Textarea::make('description')
                                ->label('Description'),

                            Forms\Components\Hidden::make('id_user')
                                ->default(Auth::id())
                                ->required(),
                        ]),
                ])
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Title'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Action::make('startSession')
                    ->label('Commencer')
                    ->color('success')
                    ->icon('heroicon-o-play')
                    ->action(function (Quiz $record) {

                        function secureRandomNumber($length = 6) {
                            $number = '';
                            for ($i = 0; $i < $length; $i++) {
                                $number .= random_int(0, 9);
                            }
                            return $number;
                        }
                        $code = secureRandomNumber(6);

                        $session = GameSession::create([

                            'id_quiz' => $record->id,
                            'id_user' => Auth::id(),
                            'code_adhesion' => $code,
                            'status' => 'waiting',
                        ]);

                        return redirect()->route('session.waiting', ['sessionId' => $session->id]);
                    }),
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
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'view' => Pages\ViewQuiz::route('/{record}'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('id_user', Auth::id());
    }
}

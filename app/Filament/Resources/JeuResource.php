<?php

namespace App\Filament\Resources;

use App\Filament\Resources\JeuResource\Pages;
use App\Filament\Resources\JeuResource\RelationManagers;
use App\Models\Jeu;
use App\Models\GameSession;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JeuResource extends Resource
{
    protected static ?string $model = Jeu::class;

    public static function getNavigationLabel(): string
    {
        return __("Jeu");
    }

    protected static ?string $navigationGroup="Creation Jeu";

    protected static ?string $navigationLabel = 'Jeux';
    protected static ?string $pluralLabel = 'Jeux';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Wizard::make([
                    Forms\Components\Wizard\Step::make('Info jeu')
                        ->schema([
                            Forms\Components\TextInput::make('titre')
                                ->label('Titre')
                                ->required(),
                            
                            Forms\Components\Textarea::make('description')
                                ->label('Description'),
                            
                            Forms\Components\Hidden::make('id_master')
                                ->default(Auth::id())
                                ->required(),
                        ]),
                    Forms\Components\Wizard\Step::make('paramétre jeu')
                        ->schema([
                            Forms\Components\Repeater::make('parametres')
                                ->relationship()
                                ->minItems(1)
                                ->columns(2)
                                ->schema([
                                    Forms\Components\TextInput::make('nom')
                                        ->label('Nom')
                                        ->required(),
                                    Forms\Components\Select::make('nature')
                                        ->options([
                                            'Money' => 'Money',
                                            'Points' => 'Points',
                                            'Level' => 'Level',
                                        ]),
                                    Forms\Components\TextInput::make('valeur_init')
                                        ->label('Initial Value')
                                        ->numeric()
                                        ->required(),

                                    Forms\Components\TextInput::make('MinValue')
                                        ->label('Min Value')
                                        ->numeric()
                                        ->required(),
                                    Forms\Components\TextInput::make('MaxValue')
                                        ->label('Max Value')
                                        ->numeric()
                                        ->required() 
                                ]),   
                        ]),
                ])->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('titre')->label('titre'),
                Tables\Columns\TextColumn::make('created_at')->label('Created At')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('startSession')
                    ->label('Commencer')
                    ->color('success')
                    ->icon('heroicon-o-play')
                    ->action(function (Jeu $record) {

                        function secureRandomNumber($length = 6) {
                            $number = '';
                            for ($i = 0; $i < $length; $i++) {
                                $number .= random_int(0, 9);
                            }
                            return $number;
                        }
                        $code = secureRandomNumber(6);
                        $session = GameSession::create([
                            'id_jeu' => $record->id,
                            'id_master' => Auth::id(),
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
            'index' => Pages\ListJeus::route('/'),
            'create' => Pages\CreateJeu::route('/create'),
            'edit' => Pages\EditJeu::route('/{record}/edit'),
        ];
    }
}

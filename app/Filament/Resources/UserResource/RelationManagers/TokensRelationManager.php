<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use App\Models\User;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TokensRelationManager extends RelationManager
{
    protected static string $relationship = 'tokens';

    protected static ?string $modelLabel = 'token';
    protected static ?string $pluralModelLabel = 'tokens';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nome de Identificação')
                    ->placeholder('Ex: Token de Acesso - API')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TagsInput::make('abilities')
                    ->label('Habilidades')
                    ->placeholder('Ex: server:update'),
                Forms\Components\DatePicker::make('expires_at')
                    ->label('Data de Expiração')
                    ->minDate(now()->addDay())
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make('Gerar Token')
                    ->form([
                        Forms\Components\TextInput::make('name')
                            ->label('Nome de Identificação')
                            ->placeholder('Ex: Token de Acesso - API')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TagsInput::make('abilities')
                            ->label('Habilidades')
                            ->placeholder('Ex: server:update'),
                        Forms\Components\DatePicker::make('expires_at')
                            ->label('Data de Expiração')
                            ->minDate(now()->addDay())
                    ])->action(function (array $data, RelationManager $livewire) {
                        $user = $livewire->getOwnerRecord();
                        $token = $user->createToken($data['name'], $data['abilities'], isset($data['expires_at']) ? Carbon::parse($data['expires_at']) : null);

                        Notification::make()
                            ->title('Token gerado!')
                            ->body("Token: {$token->plainTextToken}")
                            ->persistent()
                            ->success()
                            ->send();
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

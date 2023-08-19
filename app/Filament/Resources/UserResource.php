<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Tables\Table;
use App\Models\Depertement;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\UserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Setting';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')
                    ->required()
                    ->label('Name')
                    ->maxLength(100),
                    
                    TextInput::make('email')
                    ->email()
                    ->required()
                    ->label('Email')
                    ->maxLength(100),

                    Auth::user()->dept_id != 1 ? 
                  
                    Select::make('dept_id')
                    ->label('Departemen')
                    ->required()
                    ->hiddenOn('edit')
                    ->options(Depertement::all()->pluck('nama_dept', 'id'))
                    ->searchable() 
                    
                    :
                   
                    Select::make('dept_id')
                    ->label('Departemen')
                    ->required()
                    ->options(Depertement::all()->pluck('nama_dept', 'id'))
                    ->searchable(),

                    TextInput::make('password')
                    ->password()
                        ->required(fn (Page $livewire) : bool => $livewire instanceof CreateRecord)
                        ->minLength(8)
                        ->same('passwordConfirmation')
                        ->dehydrated(fn ($state) => filled($state))
                        ->dehydrateStateUsing(fn ($state) => Hash::make($state)),

                    TextInput::make('passwordConfirmation')
                    ->password()
                        ->required(fn (Page $livewire) : bool => $livewire instanceof CreateRecord)
                        ->minLength(8)
                        ->dehydrated(false),
           
                    Auth::user()->dept_id != 1 ? 
                    Select::make('roles')
                        ->multiple()
                        ->hiddenOn('edit')
                        ->relationship('roles', 'name')->preload()
                    :
                    Select::make('roles')
                    ->multiple()
                    ->relationship('roles', 'name')->preload()

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->modifyQueryUsing(fn (Builder $query) => $query->withoutGlobalScopes())
            ->columns([
                TextColumn::make('No')->state(
                    static function (HasTable $livewire, stdClass $rowLoop): string {
                        return (string) (
                            $rowLoop->iteration +
                            ($livewire->getTableRecordsPerPage() * (
                                $livewire->getTablePage() - 1
                            ))
                        );
                    }
                ),
                TextColumn::make('name')->limit('50')->sortable()->searchable(),
                TextColumn::make('email')->limit('50')->searchable(),
               
                TextColumn::make('roles.name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }  
    
    public static function getEloquentQuery(): Builder
    {
   
       if(Auth::user()->dept_id == 1){
            return parent::getEloquentQuery()->withoutGlobalScopes();
        }else{
           return parent::getEloquentQuery()->where('id', auth()->id());
       }
    }
}

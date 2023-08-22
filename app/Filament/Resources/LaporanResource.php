<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Forms;
use Filament\Tables;
use App\Helper\Status;
use App\Models\Laporan;
use Filament\Forms\Form;
use App\Models\Pengajuan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\LaporanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use App\Filament\Resources\LaporanResource\RelationManagers;

class LaporanResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Form Pengajuan';
    protected static ?string $navigationLabel = 'Laporan';
    protected static ?int $navigationSort = 2;
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->poll('10s')
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
            TextColumn::make('nama_kegiatan')->label('Nama Kegiatan')->limit('50')->searchable(),
            TextColumn::make('nama_pj')->label('Nama Penanggungjawab')->limit('50')->searchable(),
            TextColumn::make('total_biaya')->label('Total Biaya')
            ->numeric(
                decimalPlaces: 0,
                decimalSeparator: '.',
                thousandsSeparator: '.',
            ),
            
            TextColumn::make('user.name')
            ->label('Pengaju'),
            
            TextColumn::make('status')->label('Status')
                        ->badge()
                        ->color(fn (string $state): string => match ($state) {
                            Status::MENUNGGU => 'gray',
                            Status::DIPERIKSA => 'warning',
                            Status::DITOLAK => 'danger',
                            Status::SETUJUFINANCE => 'success',
                            Status::SETUJUDIREKTUR => 'success',
                            Status::CAIR => 'success',
                            Status::SELESAI => 'success'

                        })

           
                    ])
      
        
        
            ->filters([
                Filter::make('created_at')
                ->form([
                    DatePicker::make('Dari'),
                    DatePicker::make('Sampai'),
                ])
                ->query(function (Builder $query, array $data): Builder {
                    return $query
                        ->when(
                            $data['Dari'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                        )
                        ->when(
                            $data['Sampai'],
                            fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                        );
                })
             
            ])
            ->actions([
                
                // Tables\Actions\ViewAction::make()
               
                

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
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }

    public static function getLabel(): ?string
    {
        return "Laporan";
    }

    public static function getEloquentQuery(): Builder
    {
           

         if(in_array(Auth::user()->dept_id, [1,3])){
                return parent::getEloquentQuery()->withoutGlobalScopes();
            }else{
               return parent::getEloquentQuery()->where('user_id', auth()->id());
           }
    
    }

}

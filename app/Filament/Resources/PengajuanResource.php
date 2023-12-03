<?php

namespace App\Filament\Resources;

use stdClass;
use Filament\Tables;
use App\Helper\Status;
use Filament\Forms\Form;
use App\Models\Pengajuan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;

use Filament\Tables\Filters\Filter;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PengajuanResource\Pages;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class PengajuanResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Form Pengajuan';
    protected static ?string $navigationLabel = 'Pengajuan';
    public static function form(Form $form): Form
    {
        if(in_array(Auth::user()->dept_id, [1,2])){
            return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama_kegiatan')
                    ->required()
                    ->label('Nama Kegiatan'),

                    TextInput::make('nama_pj')
                    ->required()
                    ->label('Nama Penanggung Jawab'),

                    Textarea::make('tujuan')
                    ->required()
                    ->autosize()
                    ->label('Tujuan Kegiatan'),
                    
                    TextInput::make('total_biaya')
                    ->required()
                    ->label('Total Biaya')
                    ->numeric(),

                    Textarea::make('catatan')
                    ->autosize()
                    ->label('Keterangan/Catatan')
                    ->when(in_array(Auth::user()->dept_id, [2]), function ($component) {
                        return $component->disabled();
                    }),

                    Repeater::make('rincian')
                    ->relationship()
                    ->label('Rincian')
                    ->schema([
                            TextInput::make('nama_peralatan')->required()
                            ->label('Nama Peralatan'),
                            TextInput::make('biaya')
                            ->required()
                            ->label('Total Biaya')
                            ->numeric()
                        ])
                        ->columns(2)

                    ]),
           
            ]);
       }else{

        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('nama_kegiatan')
                    ->required()
                    ->disabled()
                    ->label('Nama Kegiatan'),

                    TextInput::make('nama_pj')
                    ->required()
                    ->disabled()
                    ->label('Nama Penanggung Jawab'),

                    Textarea::make('tujuan')
                    ->required()
                    ->disabled()
                    ->autosize()
                    ->label('Tujuan Kegiatan'),
                    
                    TextInput::make('total_biaya')
                    ->required()
                    ->hidden()
                    ->label('Total Biaya')
                    ->numeric(),

                    Textarea::make('catatan')
                    ->autosize()
                    ->disabled()
                    ->label('Keterangan/Catatan'),

                    Repeater::make('rincian')
                    ->relationship()
                    ->disabled()
                    ->label('Rincian')
                    ->schema([
                            TextInput::make('nama_peralatan')->required()
                            ->label('Nama Peralatan'),
                            TextInput::make('biaya')
                            ->required()
                            ->label('Total Biaya')
                            ->numeric()
                        ])
                        ->columns(2)

                ]),
          
           
            ]);

       }
           
        
          
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
            TextColumn::make('user.name')
            ->label('Pengaju'),

            TextColumn::make('nama_kegiatan')->label('Nama Kegiatan')->limit('50')->searchable(),
            TextColumn::make('nama_pj')->label('Nama Penanggungjawab')->limit('50')->searchable(),
          
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

            }),

            SpatieMediaLibraryImageColumn::make('bukti')
            ->label('Bukti Pencairan'),

            TextColumn::make('total_biaya')->label('Total Biaya')
            ->numeric(
                decimalPlaces: 0,
                decimalSeparator: '.',
                thousandsSeparator: '.',
            ),
      
            
           
            
        

           
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
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()->visible(
                    fn ($record) => !in_array($record->status, [Status::DITOLAK, Status::SELESAI, Status::CAIR])),
                Tables\Actions\DeleteAction::make()->visible(
                    fn ($record) => Auth::user()->dept_id == 1
                                    && !in_array($record->status, [Status::DITOLAK, Status::SELESAI])),
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
            'index' => Pages\ListPengajuans::route('/'),
            'create' => Pages\CreatePengajuan::route('/create'),
            'edit' => Pages\EditPengajuan::route('/{record}/edit'),
        ];
    }

    
    public static function getEloquentQuery(): Builder
    {
   
       if(Auth::user()->dept_id == 1){
            return parent::getEloquentQuery()->withoutGlobalScopes();
       }elseif(Auth::user()->dept_id == 3){
            return parent::getEloquentQuery()
             ->whereIn('status', [Status::SETUJUFINANCE, Status::CAIR, Status::SELESAI]);
        }else{
           return parent::getEloquentQuery()->where('user_id', auth()->id());
       }
    }


  

 

}
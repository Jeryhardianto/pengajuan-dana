<?php

namespace App\Filament\Resources\LaporanResource\Pages;

use App\Models\User;
use Filament\Actions;
use Filament\Actions\Action;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\LaporanResource;
use Filament\Forms\Form;
class ListLaporans extends ListRecords
{ 
    protected static string $resource = LaporanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('updateAuthor')
            ->label('Cetak Laporan')
            ->icon('heroicon-s-printer')
            
            ->form([
                DatePicker::make('dari'),
                DatePicker::make('sampai')
            ])
            // ->url(fn (): string => route('form-laporan.cetak'))
            ->action(function (array $data) {
                 redirect()->route('form-laporan.cetak', ['data' => $data]);
            })
      
        ];
    }

}

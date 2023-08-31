<?php

namespace App\Filament\Resources\LaporanResource\Pages;

use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;

use App\Filament\Resources\LaporanResource;

class ListLaporans extends ListRecords
{ 
    protected static string $resource = LaporanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
            Action::make('cetak_cair')
                    ->label('Cetak Laporan')
                    ->icon('heroicon-s-printer')
                    ->color('success')
                    ->url(fn (): string => route('form-laporan.cetak'))
                    ->openUrlInNewTab()
        ];
    }

}

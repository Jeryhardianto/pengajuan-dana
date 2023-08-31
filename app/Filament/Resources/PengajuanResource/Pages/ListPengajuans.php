<?php

namespace App\Filament\Resources\PengajuanResource\Pages;

use Filament\Actions;
use App\Helper\Status;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PengajuanResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListPengajuans extends ListRecords
{
    protected static string $resource = PengajuanResource::class; 

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->icon('heroicon-o-plus'),
        ];
    }
    public function getTabs(): array
    {
        return [
            'Semua' => Tab::make('Semua'),
            'Menunggu' => Tab::make('Menunggu')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::MENUNGGU)),
            'Diperiksa' => Tab::make('Diperiksa')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::DIPERIKSA)),
            'Ditolak' => Tab::make('Ditolak')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::DITOLAK)),
            'DisetujuiFinance' => Tab::make('Disetujui Finance')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::SETUJUFINANCE)),
            'DisetujuiDirektur' => Tab::make('Disetujui Direktur')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::SETUJUDIREKTUR)),
            'Pencairan' => Tab::make('Pencairan')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::CAIR)),
            'Selesai' => Tab::make('Selesai')
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', Status::SELESAI)),
        ];
    }
}


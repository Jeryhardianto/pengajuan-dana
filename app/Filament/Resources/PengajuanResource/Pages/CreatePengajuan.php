<?php

namespace App\Filament\Resources\PengajuanResource\Pages;


use App\Helper\Status;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PengajuanResource;
use App\Models\DetailPengajuan;

class CreatePengajuan extends CreateRecord
{
    protected static string $resource = PengajuanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['status'] = Status::MENUNGGU;
        $data['tanggaldiajukan'] = date('Y-m-d h:i:s');

        // foreach ($data['rincian'] as $row){
        //     DetailPengajuan::create([
        //         'id_pengajuan' => 'London to Paris',
        //     ]);
        // }
     
        return $data;
    }



    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Sukses')
            ->body('Data pengajuan berhasil dibuat.');
    }
}

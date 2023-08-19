<?php

namespace App\Filament\Resources\PengajuanResource\Pages;

use App\Helper\Status;
use App\Models\BuktiCair;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\DatePicker;
use App\Filament\Resources\PengajuanResource;
use App\Models\Pengajuan;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class EditPengajuan extends EditRecord
{
    protected static string $resource = PengajuanResource::class;

    protected function getHeaderActions(): array
    {
        
        $data = $this->getRecord();


        if(Auth::user()->dept_id == 1){
        
           if($data->status != Status::CAIR){
            return [
                EditAction::make()
                ->icon('heroicon-m-pencil-square')

                ->mutateFormDataUsing(function (array $data): array {
                    if(in_array($data['status'],[Status::DIPERIKSA, Status::DITOLAK])){
                        $data['finance1_id'] = auth()->id();
                        $data['tanggaldiperiksa'] = date('Y-m-d h:i:s');
                    }elseif($data['status'] == Status::SETUJUFINANCE){
                        $data['finance2_id'] = auth()->id();
                        $data['tanggaldiselesaiperiksa'] = date('Y-m-d h:i:s');
                    }
                    
                    return $data;
                })
                ->label('Update Status')
                ->form(
                [
                   Select::make('status')
                    ->label('Update Status')
                    ->options([
                        // Finance 1
                        Status::DIPERIKSA => Status::DIPERIKSA,
                        Status::DITOLAK => Status::DITOLAK,
                        // Finance 2 = SPV Finance
                        Status::SETUJUFINANCE => Status::SETUJUFINANCE,
                        Status::CAIR => Status::CAIR,
                        Status::SELESAI => Status::SELESAI
                    ]),
                ]),
                
                // Untuk Cetak Form Pemeriksaan
                in_array($data->status, [Status::SETUJUFINANCE,Status::DIPERIKSA,Status::SELESAI ]) ?
                Action::make('cetak')
                    ->label('Cetak Form Pemeriksaan')
                    ->icon('heroicon-s-printer')
                    ->color('warning')
                    ->url(fn (): string => route('form-pemeriksaan.cetak', ['id' => $data->id]))
                    ->openUrlInNewTab()
                : Action::make('cetak')
                ->label('Cetak Form Pemeriksaan')
                ->hidden(),

                $data->status == Status::SELESAI ?
                Action::make('cetak_cair')
                    ->label('Cetak Bukti Pencairan')
                    ->icon('heroicon-s-printer')
                    ->color('success')
                    ->url(fn (): string => route('form-bukticair.cetak', ['id' => $data->id]))
                    ->openUrlInNewTab()
                : Action::make('cetak_cair')
                ->label('Cetak Bukti Pencairan')
                ->hidden(),

                

                ];
           }else{
            return [
                // Actions\DeleteAction::make(),
                EditAction::make()

                ->mutateFormDataUsing(function (array $data): array {

            
                    // Updated Table Pengajuan
                    $pengajuan = $this->getRecord();
                    $data['tanggaldiperiksa'] = date('Y-m-d h:i:s');
                    $data['bukti'] = 1;
                 
                    $bukticairs     = BuktiCair::where('pengajuan_id', $pengajuan->id)->first();
                    if($bukticairs){
                        BuktiCair::where( 'pengajuan_id',$pengajuan->id)
                        ->update([
                            'jenis_transaksi' => $data['jenis_transaksi'],
                            'total_cair' => $data['total_biaya'], 
                            'tanggal_cair' => $data['tanggal_cair'] 
                        ], );

                    }else{
                        BuktiCair::create([
                            'pengajuan_id' => $pengajuan->id,
                            'jenis_transaksi' => $data['jenis_transaksi'],
                            'total_cair' => $data['total_biaya'], 
                            'tanggal_cair' => $data['tanggal_cair'] 
                        ]);
                    }
                    
                    return $data;
                })


                ->label('Upload Bukti Pencairan')
                ->form(
                    [
                        Select::make('jenis_transaksi')
                            ->label('Jenis Transaksi')
                            ->required()
                            ->options([
                                Status::CASH => Status::CASH,
                                Status::TF => Status::TF
                            ]),

                        TextInput::make('total_biaya')
                        ->required()
                        ->label('Total Biaya')
                        ->numeric(),

                        DatePicker::make('tanggal_cair')
                        ->required()
                        ->label('Tanggal Cair'),

                        SpatieMediaLibraryFileUpload::make('bukti')
                        ->label('Bukti Pencairan'),
                        ]),

            EditAction::make('update_status')
                ->label('Update Status')
                ->form(
                [
                   Select::make('status')
                    ->label('Update Status')
                    ->options([
                        Status::SELESAI => Status::SELESAI
                    ]),
                ]),

                 // Untuk Cetak Form Pemeriksaan
                 Action::make('cetak')
                     ->label('Cetak Form Pemeriksaan')
                     ->icon('heroicon-s-printer')
                     ->color('warning')
                     ->url(fn (): string => route('form-pemeriksaan.cetak', ['id' => $data->id]))
                     ->openUrlInNewTab(),

                 // Untuk Cetak Form Pencairan
                $data->bukti == 1 || $data->status == Status::SELESAI ?
                Action::make('cetak_cair')
                    ->label('Cetak Bukti Pencairan')
                    ->icon('heroicon-s-printer')
                    ->color('success')
                    ->url(fn (): string => route('form-bukticair.cetak', ['id' => $data->id]))
                    ->openUrlInNewTab()
                : Action::make('cetak_cair')
                ->label('Cetak Bukti Pencairan')
                ->hidden(),

                 
                
                ];
                

           }
           
        }elseif(Auth::user()->dept_id == 3)
        return [
            // Actions\DeleteAction::make(),
            EditAction::make()
            ->mutateFormDataUsing(function (array $data): array {
                $data['tanggaldiperiksa'] = date('Y-m-d h:i:s');
                $data['direktur_id'] = auth()->id();
                return $data;
            })
            ->label('Update Status')
            ->form([
               Select::make('status')
                ->label('Update Status')
                ->options([
                    Status::SETUJUDIREKTUR => Status::SETUJUDIREKTUR
                ] 
            )]
            )
        ];
        {
            return [];
        }

      
    }

    

    


}

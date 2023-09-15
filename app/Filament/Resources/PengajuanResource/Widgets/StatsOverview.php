<?php

namespace App\Filament\Resources\PengajuanResource\Widgets;

use App\Helper\Status;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{

 
    protected function getStats(): array
    {
        if(in_array(Auth::user()->dept_id, [1,3])){
            return [
                Stat::make('Total Pengajuan', Pengajuan::all()->count()),
                Stat::make(Status::MENUNGGU, Pengajuan::where('status', Status::MENUNGGU)->count()),
                Stat::make(Status::DIPERIKSA, Pengajuan::where('status', Status::DIPERIKSA)->count()),
                Stat::make(Status::DITOLAK, Pengajuan::where('status', Status::DITOLAK)->count()),
                Stat::make(Status::SETUJUFINANCE, Pengajuan::where('status', Status::SETUJUFINANCE)->count()),
                Stat::make(Status::SETUJUDIREKTUR, Pengajuan::where('status', Status::SETUJUDIREKTUR)->count()),
                Stat::make(Status::CAIR, Pengajuan::where('status', Status::CAIR)->count()),
                Stat::make(Status::SELESAI, Pengajuan::where('status', Status::SELESAI)->count()),  
            ];
        }else{
            return [
                Stat::make('Total Pengajuan', Pengajuan::where('user_id', auth()->id())->count()),
                Stat::make(Status::MENUNGGU, Pengajuan::where([['status', '=', Status::MENUNGGU],['user_id', '=', auth()->id()]])->count()),
                Stat::make(Status::DIPERIKSA, Pengajuan::where([['status', '=', Status::DIPERIKSA],['user_id', '=', auth()->id()]])->count()),
                Stat::make(Status::DITOLAK, Pengajuan::where([['status', '=', Status::DITOLAK],['user_id', '=', auth()->id()]])->count()),
                Stat::make(Status::SETUJUFINANCE, Pengajuan::where([['status', '=', Status::SETUJUFINANCE],['user_id', '=', auth()->id()]])->count()),
                Stat::make(Status::SETUJUDIREKTUR, Pengajuan::where([['status', '=', Status::SETUJUDIREKTUR],['user_id', '=', auth()->id()]])->count()),
                Stat::make(Status::CAIR, Pengajuan::where([['status', '=', Status::CAIR],['user_id', '=', auth()->id()]])->count()),
                Stat::make(Status::SELESAI, Pengajuan::where([['status', '=', Status::SELESAI],['user_id', '=', auth()->id()]])->count())
            ];
          
       }
    }
   
}

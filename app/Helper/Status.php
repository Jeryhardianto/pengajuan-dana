<?php

namespace App\Helper;

abstract class Status
{
    const MENUNGGU       = 'Menunggu diperiksa';
    const DIPERIKSA      = 'Diperiksa';
    const DITOLAK        = 'Ditolak';
    const SETUJUFINANCE  = 'Disetujui Finance';
    const SETUJUDIREKTUR = 'Disetujui Direktur';
    const CAIR           = 'Pencairan';
    const SELESAI        = 'Selesai';
    
    // Jenis Transaksi 
    const CASH          = 'Cash';
    const TF            = 'Tranfer Bank';
    
}
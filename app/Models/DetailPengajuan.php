<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengajuan extends Model
{
    use HasFactory;
    protected $table = 'detail_pengajuans';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}

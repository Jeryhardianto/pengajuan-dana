<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengajuan extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;
    protected $table = 'pengajuans';
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function rincian() : HasMany
    {
        return $this->hasMany(DetailPengajuan::class);
    }

    public function dept() : BelongsTo
    {
        return $this->belongsTo(Depertement::class);
    }


    
}

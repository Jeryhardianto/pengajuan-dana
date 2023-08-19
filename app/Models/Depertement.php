<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depertement extends Model
{
    use HasFactory;
    protected $table = 'depertemens';
    protected $guarded = ['id', 'created_at', 'updated_at'];
}

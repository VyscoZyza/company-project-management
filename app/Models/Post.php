<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'content', 'target_selesai', 'name', 'jabatan', 'supervisi', 'bagian', 'bidang',  'status', 'tanggal_selesai', 'realisasi', 'target', 'kpi'
    ];
}

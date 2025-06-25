<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'service_type',
        'name',
        'phone_number',
        'email',
        'link_article',
        'file_path',
        'note',
        'is_completed',
    ];
    

    // Kolom yang tidak dapat diisi (bisa dikosongkan jika diperlukan)
    protected $guarded = [];
}

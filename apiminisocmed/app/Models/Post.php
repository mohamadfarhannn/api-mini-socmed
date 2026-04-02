<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    // Untuk mengaktifkan fitur soft delete
    use SoftDeletes;

    // Mendefinisikan kolom apa saja yang boleh diisi
    protected $fillable = [
        'user_id',
        'content',
        'image_url',
    ];
}

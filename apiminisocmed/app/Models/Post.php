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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }
}

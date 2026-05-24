<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatKonsultasi extends Model
{
    protected $table = 'tb_chat_konsultasi';
    protected $primaryKey = 'id_chat';
    protected $guarded = [];

    protected $casts = [
        'waktu_kirim' => 'datetime',
        'status_baca' => 'boolean',
    ];

    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_lampiran) {
            return null;
        }

        return url('uploads/chat/' . basename($this->file_lampiran));
    }

    public function getIsImageAttribute(): bool
    {
        if (!$this->file_lampiran) {
            return false;
        }

        $extension = strtolower(pathinfo($this->file_lampiran, PATHINFO_EXTENSION));
        return in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
    }

    public function pengirim()
    {
        return $this->belongsTo(User::class, 'id_pengirim', 'id_user');
    }
}

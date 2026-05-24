<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PertanyaanPemantauan extends Model
{
    protected $table = 'tb_pertanyaan_pemantauan';
    protected $primaryKey = 'id_pertanyaan_pemantauan';
    protected $guarded = [];

    public function getSentimenAttribute(): string
    {
        // Pertanyaan yang bersifat positif (semakin sering semakin baik)
        $positifKeywords = ['nyaman', 'senang', 'bahagia', 'tenang'];
        
        foreach ($positifKeywords as $keyword) {
            if (str_contains(strtolower($this->pertanyaan), $keyword)) {
                return 'positif';
            }
        }

        // Defaultnya dianggap negatif (semakin sering semakin buruk)
        return 'negatif';
    }
}

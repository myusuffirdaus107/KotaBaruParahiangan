<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HunianUnggulan extends Model
{
    protected $table = 'hunian_unggulan';

    protected $fillable = [
        'property_name',
        'tatar_name',
        'location',
        'image',
        'badge_label',
        'cicilan_harga',
        'cicilan_unit',
        'price_note',
        'benefits',
    ];

    protected $casts = [
        'benefits'      => 'array',
        'cicilan_harga' => 'decimal:1',
    ];

    /**
     * Ambil satu-satunya baris (ID=1), buat jika belum ada.
     */
    public static function getInstance(): self
    {
        return self::firstOrCreate(['id' => 1], [
            'property_name' => 'Nama Properti',
            'badge_label'   => 'New Launching',
            'cicilan_unit'  => 'Juta / bulan',
            'price_note'    => '*Harga dapat berubah sewaktu-waktu',
            'benefits'      => [],
        ]);
    }

    /**
     * Format harga: 16.0 → "16", 16.5 → "16.5"
     */
    public function getCicilanFormatAttribute(): string
    {
        if (!$this->cicilan_harga) return '-';
        $val = (float) $this->cicilan_harga;
        return $val == floor($val) ? (string)(int)$val : (string)$val;
    }

    /**
     * Benefits tervalidasi max 4
     */
    public function getBenefitsListAttribute(): array
    {
        return array_slice($this->benefits ?? [], 0, 4);
    }
}
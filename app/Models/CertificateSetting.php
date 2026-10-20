<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateSetting extends Model
{
    protected $fillable = [
        'company_name',
        'tagline',
        'title',
        'director_name',
        'director_title',
        'company_unit',
        'stamp_signature_path',
        'msme_logo_path',
        'aicte_logo_path',
        'default_mode',
        'default_duration',
        'website_url',
    ];

    /**
     * Retrieve the active certificate settings, creating defaults if not yet present.
     */
    public static function current(): self
    {
        $setting = static::first();

        if (! $setting) {
            $setting = static::create([
                'company_name' => 'INFINITY INTERNS',
                'tagline' => 'LEARN • GROW • SUCCEED',
                'title' => 'CERTIFICATE OF COMPLETION',
                'director_name' => 'Rahul Kumar',
                'director_title' => 'Director, Infinity Interns',
                'company_unit' => 'Infinity A1 Career Counselling Pvt. Ltd.',
                'stamp_signature_path' => '/images/certificate/stamp_signature.png',
                'msme_logo_path' => '/images/certificate/msme_logo.png',
                'aicte_logo_path' => '/images/certificate/aicte_logo.png',
                'default_mode' => 'Offline',
                'default_duration' => '45 Days',
                'website_url' => 'https://infinityinterns.com/',
            ]);
        }

        return $setting;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferLetterSetting extends Model
{
    protected $fillable = [
        'company_name',
        'company_subtitle',
        'cin_number',
        'address',
        'email',
        'website',
        'logo_path',
        'letter_title',
        'ref_prefix',
        'default_role',
        'default_department',
        'default_location',
        'default_duration',
        'default_stipend',
        'default_reporting_manager',
        'default_mode',
        'acceptance_days',
        'intro_text',
        'terms_text',
        'closing_text',
        'signatory_name',
        'signatory_designation',
        'signature_path',
        'seal_path',
    ];

    protected function casts(): array
    {
        return [
            'acceptance_days' => 'integer',
        ];
    }

    /**
     * Retrieve the active offer letter settings, creating defaults if not yet present.
     */
    public static function current(): self
    {
        $setting = static::first();

        if (! $setting) {
            $setting = static::create([
                'company_name' => 'INFINITY INTERNS',
                'company_subtitle' => 'A unit of Infinitya1 Career Counselling private limited',
                'cin_number' => 'U85500BR2025PTC075319',
                'address' => 'B-hub Maurya Lok Complex, Patna, Bihar – 800001',
                'email' => 'info@infinityinterns.com',
                'website' => 'www.infinityinterns.com',
                'letter_title' => 'INTERNSHIP OFFER LETTER',
                'ref_prefix' => 'II/OL/',
                'default_role' => 'Financial Management Intern',
                'default_department' => 'Marketing & Finance',
                'default_location' => 'ON-OFFICE',
                'default_duration' => '06 June 2026 to 21 July 2026',
                'default_stipend' => 'Rs 5000',
                'default_reporting_manager' => 'Aryav Singh Vishal',
                'default_mode' => 'Office',
                'acceptance_days' => 5,
                'signatory_name' => 'Aryav Singh Vishal',
                'signatory_designation' => 'Authorized Signatory',
            ]);
        }

        return $setting;
    }
}

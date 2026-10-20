<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ConsentLetterSetting extends Model
{
    protected $fillable = [
        'default_college',
        'annexure_text',
        'letter_title',
        'letter_subject',
        'letter_no_prefix',
        'credits_text',
        'intro_text',
        'authority_designation',
        'signature_path',
        'seal_path',
        'show_signature_line',
    ];

    protected function casts(): array
    {
        return [
            'show_signature_line' => 'boolean',
        ];
    }

    /**
     * Retrieve the active consent letter settings, creating defaults if not yet present.
     */
    public static function current(): self
    {
        $setting = static::first();

        if (! $setting) {
            $setting = static::create([
                'default_college' => 'GAYA COLLEGE, GAYA.',
                'annexure_text' => 'ANNEXURE I',
                'letter_title' => 'CONSENT LETTER',
                'letter_subject' => 'TO WHOM IT MAY CONCERN',
                'letter_no_prefix' => 'GC/CL/',
                'credits_text' => 'minimum 04 credits (120 hrs)',
                'intro_text' => 'As part of the curriculum of CBCS UG the students are required to undertake internship of minimum 04 credits (120 hrs) in an organization. In this regard, I am introducing the below mentioned student with the following details for the purpose of internship:',
                'authority_designation' => 'Signature of HOD / Principal with Seal',
                'show_signature_line' => true,
            ]);
        }

        return $setting;
    }
}

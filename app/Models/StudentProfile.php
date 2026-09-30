<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'application_number',
        'degree',
        'college',
        'semester',
        'program_domain',
        'status',
        'offer_letter_issued',
        'offer_letter_date',
        'certificate_issued',
        'certificate_number',
        'certificate_date',
        'marksheet_issued',
        'marksheet_grade',
        'marksheet_marks',
        'marksheet_date',
        'attendance_rate',
        'mentor_name',
        'project_title',
    ];

    protected function casts(): array
    {
        return [
            'offer_letter_issued' => 'boolean',
            'offer_letter_date' => 'datetime',
            'certificate_issued' => 'boolean',
            'certificate_date' => 'datetime',
            'marksheet_issued' => 'boolean',
            'marksheet_date' => 'datetime',
            'attendance_rate' => 'integer',
            'marksheet_marks' => 'integer',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

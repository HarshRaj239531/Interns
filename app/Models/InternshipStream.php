<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternshipStream extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'category',
        'duration',
        'credits',
        'description',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function studentProfiles()
    {
        return $this->hasMany(StudentProfile::class, 'program_domain', 'title');
    }
}

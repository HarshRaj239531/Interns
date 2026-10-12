<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Degree extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'duration',
        'description',
        'sort_order',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function studentProfiles(): HasMany
    {
        return $this->hasMany(StudentProfile::class, 'degree', 'code');
    }
}

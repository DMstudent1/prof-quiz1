<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionSpecialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'option_id',
        'specialties_id',
        'predisposition_level',
    ];

    public function questionOption()
    {
        return $this->belongsTo(QuestionOption::class, 'option_id');
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialties_id');
    }
}

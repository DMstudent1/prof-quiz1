<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\QuestionOption;
use App\Models\TestAnswer;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    public function options()
    {
        return $this->belongsToMany(QuestionOption::class, 'option_specialties')
            ->withPivot('predisposition_level')
            ->withTimestamps();
    }

    public function testAnswers()
    {
        return $this->hasMany(TestAnswer::class, 'specialties_id');
    }

}

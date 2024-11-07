<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Specialty;

class QuestionOption extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'option',
        'question_id',
    ];


    /*protected $casts = [
        'correct' => 'boolean',
    ];*/

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'option_specialties')
            ->withPivot('predisposition_level')
            ->withTimestamps();
    }
}

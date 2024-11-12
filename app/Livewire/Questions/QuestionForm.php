<?php

namespace App\Livewire\Questions;

use Livewire\Component;
use App\Models\Question;
use App\Models\Specialty;
use App\Models\OptionSpecialty;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Livewire\Features\SupportRedirects\Redirector;

class QuestionForm extends Component
{
    public ?Question $question = null;

    public string $question_text = '';
    public ?string $code_snippet = '';
    public ?string $answer_explanation = '';
    public ?string $more_info_link = '';

    public bool $editing = false;

    public array $questionOptions = [];

    public function mount(Question $question): void
    {
        if ($question->exists) {
            $this->initializeForEditing($question);
        }
    }

    private function initializeForEditing(Question $question): void
    {
        $this->question = $question;
        $this->editing = true;

        // Заполняем данные для редактирования
        $this->fill($question->only(['question_text', 'code_snippet', 'answer_explanation', 'more_info_link']));

        // Заполняем данные о вариантах вопросов и их связанных специальностях
        $this->questionOptions = $question->questionOptions->map(function ($option) {
            return [
                'option' => $option->option,
                'specialties' => $option->specialties->map(function ($specialty) {
                    return [
                        'specialty_id' => $specialty->id,
                        'predisposition_level' => $specialty->pivot->predisposition_level
                    ];
                })->toArray() // Преобразуем в массив, чтобы можно было удобно работать с ним
            ];
        })->toArray();
    }


    public function addQuestionsOption(): void
    {
        $this->questionOptions[] = [
            'option' => '',
            'specialties' => []
        ];
    }

    public function removeQuestionsOption(int $index): void
    {
        unset($this->questionOptions[$index]);
        $this->questionOptions = array_values($this->questionOptions);
    }

    public function save(): Redirector|RedirectResponse
    {
        $this->validate();

        $this->question = $this->question
            ? $this->updateQuestion()
            : $this->createQuestion();

        $this->syncQuestionOptions();

        return to_route('questions');
    }

    private function createQuestion(): Question
    {
        return Question::create($this->only(['question_text', 'code_snippet', 'answer_explanation', 'more_info_link']));
    }

    private function updateQuestion(): Question
    {
        $this->question->update($this->only(['question_text', 'code_snippet', 'answer_explanation', 'more_info_link']));
        return $this->question;
    }

    private function syncQuestionOptions(): void
    {
        $this->question->questionOptions()->delete();

        foreach ($this->questionOptions as $optionData) {
            // Сначала создаем опцию
            $option = $this->question->questionOptions()->create([
                'option' => $optionData['option']
            ]);

            // Если specialty_id есть, прикрепляем
            if (!empty($optionData['specialty_id'])) {
                $option->specialties()->attach($optionData['specialty_id'], [
                    'predisposition_level' => $optionData['predisposition_level']
                ]);
            }
        }
    }

    protected function rules(): array
    {
        return [
            'question_text' => ['string', 'required'],
            'code_snippet' => ['string', 'nullable'],
            'answer_explanation' => ['string', 'nullable'],
            'more_info_link' => ['url', 'nullable'],
            'questionOptions' => ['required', 'array'],
            'questionOptions.*.option' => ['required', 'string'],
            'questionOptions.*.specialties' => ['array'],
            'questionOptions.*.specialties.*.specialty_id' => ['exists:specialties,id'],
            'questionOptions.*.specialties.*.predisposition_level' => ['integer', 'min:1', 'max:5'], // assuming levels from 1 to 5
        ];
    }

    public function render(): View
    {
        return view('livewire.questions.question-form', [
            'specialties' => Specialty::all()
        ]);
    }
}

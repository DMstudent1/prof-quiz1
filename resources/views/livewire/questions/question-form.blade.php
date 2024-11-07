<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $editing ? 'Edit Question' : 'Create Question' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form wire:submit.prevent="save">
                        <div>
                            <x-input-label for="question_text" value="Question text" />
                            <x-textarea wire:model="question_text" id="question_text" class="block mt-1 w-full" type="text" name="question_text" required />
                            <x-input-error :messages="$errors->get('question_text')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="question_options" value="Question options"/>
                            @foreach($questionOptions as $index => $questionOption)
                                <div class="flex flex-col mt-2 space-y-2">
                                    <!-- Option text input -->
                                    <x-text-input type="text" wire:model="questionOptions.{{ $index }}.option" class="w-full" name="questions_options_{{ $index }}" id="questions_options_{{ $index }}" autocomplete="off"/>
                                    <x-input-error :messages="$errors->get('questionOptions.' . $index . '.option')" class="mt-2" />

                                    <!-- Specialty selection -->
                                    <div class="flex space-x-4">
                                        <div class="w-1/2">
                                            <x-input-label for="specialty_{{ $index }}" value="Specialty" />
                                            <select wire:model="questionOptions.{{ $index }}.specialties.0.specialty_id" id="specialty_{{ $index }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                                <option value="">Select Specialty</option>
                                                @foreach($specialties as $specialty)
                                                    <option value="{{ $specialty->id }}" @if($questionOption['specialties'][0]['specialty_id'] == $specialty->id) selected @endif>
                                                        {{ $specialty->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('questionOptions.' . $index . '.specialties.0.specialty_id')" class="mt-2" />
                                        </div>

                                        <!-- Predisposition level input -->
                                        <div class="w-1/2">
                                            <x-input-label for="predisposition_level_{{ $index }}" value="Predisposition Level" />
                                            <x-text-input type="number" wire:model="questionOptions.{{ $index }}.specialties.0.predisposition_level" id="predisposition_level_{{ $index }}" class="w-full" min="1" max="5" />
                                            <x-input-error :messages="$errors->get('questionOptions.' . $index . '.specialties.0.predisposition_level')" class="mt-2" />
                                        </div>
                                    </div>

                                    <!-- Delete option button -->
                                    <button wire:click.prevent="removeQuestionsOption({{ $index }})" type="button" class="mt-2 rounded-md border border-transparent bg-red-200 px-4 py-2 text-xs uppercase text-red-500 hover:bg-red-300 hover:text-red-700">
                                        Delete Option
                                    </button>
                                </div>
                            @endforeach



                            <x-input-error :messages="$errors->get('questionOptions')" class="mt-2" />

                            <x-primary-button wire:click.prevent="addQuestionsOption" type="button" class="mt-2">
                                Add Option
                            </x-primary-button>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="code_snippet" value="Code snippet" />
                            <x-textarea wire:model="code_snippet" id="code_snippet" class="block mt-1 w-full" type="text" name="code_snippet" />
                            <x-input-error :messages="$errors->get('code_snippet')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="answer_explanation" value="Answer explanation" />
                            <x-textarea wire:model="answer_explanation" id="answer_explanation" class="block mt-1 w-full" type="text" name="answer_explanation" />
                            <x-input-error :messages="$errors->get('answer_explanation')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="more_info_link" value="More info link" />
                            <x-text-input wire:model="more_info_link" id="more_info_link" class="block mt-1 w-full" type="text" name="more_info_link" />
                            <x-input-error :messages="$errors->get('more_info_link')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <x-primary-button>
                                Save
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

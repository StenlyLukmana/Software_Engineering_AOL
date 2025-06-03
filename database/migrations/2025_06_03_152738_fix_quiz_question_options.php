<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Fix quiz questions with string options by converting them to JSON arrays
        $questions = \DB::table('quiz_questions')
            ->where('type', 'multiple_choice')
            ->get();

        foreach ($questions as $question) {
            $options = $question->options;
            
            // Skip if already JSON
            if (is_null($options) || $options === 'null' || $options === '[]' || 
                (substr($options, 0, 1) === '[' && substr($options, -1) === ']')) {
                continue;
            }
            
            // Convert string options to array and then to JSON
            $optionsArray = preg_split('/\r?\n/', $options);
            $optionsArray = array_filter(array_map('trim', $optionsArray), fn($v) => $v !== '');
            $optionsJson = json_encode(array_values($optionsArray));
            
            \DB::table('quiz_questions')
                ->where('id', $question->id)
                ->update(['options' => $optionsJson]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};

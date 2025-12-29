<?php

namespace App\Rules;

use App\Models\Subject;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class SubjectInSchoolRule implements ValidationRule
{
     protected $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    /**

     * Run the validation rule.
     *
     * @param string  $attribute
     * @param mixed   $value
     * @param \Closure $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
    
        $schoolId = (int) $value;
        
        $exists=DB::table('schools_subjects')
            ->where('subject_id', $this->subject->id)
            ->where('school_id', $schoolId)
            ->exists();

        if (! $exists) {
            $fail("المادة المحددة لا تنتمي إلى هذه المدرسة");
        }
    }
}

<?php

namespace App\Rules;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class TeacherBelongsToSchoolRule implements ValidationRule
{
     protected ?User $teacher;

    public function __construct(User $teacher)
    {
        $this->teacher = $teacher;
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

        $exists = DB::table('schools_teachers')
            ->where('teacher_id', $this->teacher->id)
            ->where('school_id', $schoolId)
            ->exists();

        if (! $exists) {
            $fail("لمعلم المحدد لا ينتمي إلى هذه المدرسة");
        }
    }
}

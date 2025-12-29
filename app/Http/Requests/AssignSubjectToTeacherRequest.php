<?php

namespace App\Http\Requests;

use App\Models\Subject;
use App\Rules\SubjectInSchoolRule;
use App\Rules\TeacherBelongsToSchoolRule;
use Illuminate\Foundation\Http\FormRequest;

class AssignSubjectToTeacherRequest extends FormRequest
{
    public function authorize()
    {
        $user = $this->user();

        $schoolId = $this->input('school_id') ?? $user->school_id;

        $teacher = $this->route('teacher');
        $subject = Subject::find($this->route('subject'));
        return ($teacher && $subject && ($user->isSuperAdmin() || $user->school_id === (int)$schoolId) && $this->route('teacher')->type === 'teacher');
    }

    protected function prepareForValidation()
    {
        if (! $this->user()->isSuperAdmin()) {
            $this->merge([
                'school_id' => $this->user()->school_id,
            ]);
        }
    }

    public function rules()
    {
        // $teacher = $this->route('teacher');
        // $subject = Subject::find($this->route('subject'));
     
        return [
            'school_id' => ['required', 'integer', 'exists:schools,id',
            //  new TeacherBelongsToSchoolRule($teacher), new SubjectInSchoolRule($subject)
            ],
        ];
    }

    public function messages()
    {
        return [
            'school_id.required' => 'يجب تزويد معرف المدرسة (school_id).',
            'school_id.exists' => 'المدرسة غير موجودة.',
        ];
    }
}

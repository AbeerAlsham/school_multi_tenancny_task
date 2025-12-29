<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\HasSchoolScope;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens,HasSchoolScope;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
        'school_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function isSuperAdmin(): bool
    {
        return $this->email === 'admin@admin.com';
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // Many-to-Many relationship with School for teachers
    public function schools()
    {
        return $this->belongsToMany(School::class, 'schools_teachers', 'teacher_id', 'school_id');
    }

    public function subjectsTaught()
    {
        return $this->belongsToMany(Subject::class, 'subjects_teachers', 'teacher_id', 'subject_id')
                    ->withPivot('school_id');
    }
}

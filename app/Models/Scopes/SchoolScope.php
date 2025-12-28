<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema; // إضافة هذا السطر ضرورية جداً

class SchoolScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user || $user->isSuperAdmin() || ! $user->school_id) {
            return;
        }

        $schoolId = Auth::user()->school_id;

        /** @var \Illuminate\Database\Eloquent\Model $model */
        if (Schema::hasColumn($model->getTable(), 'school_id')) {
            $builder->where($model->getTable() . '.school_id', $schoolId);
        } elseif (method_exists($model, 'schools')) {
            $builder->whereHas('schools', function ($query) use ($schoolId) {
                $query->where('schools.id', $schoolId);
            });
        }
    }
}

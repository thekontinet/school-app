<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Student extends Model
{
    use HasFactory;

    protected function casts()
    {
        return [
            'address' => 'json'
        ];
    }

    public function fullName(): Attribute
    {
        return new Attribute(
            fn() => Str::of($this->firstname)
                ->append(' ', $this->middle_name, ' ', $this->lastname)
                ->title()
                ->toString()
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function invoices()
    {
        return $this->morphMany(Invoice::class, 'owner');
    }

    public static function booted()
    {
        static::creating(function (Student $student) {
            $student->reg_no = Str::random(8);
        });
    }
}

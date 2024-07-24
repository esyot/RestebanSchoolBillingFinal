<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'students';

    public function account()
    {
        return $this->hasOne(Account::class);
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpenseModel extends Model
{
    protected $fillable = [
        'no_letter', 'date_expense', 'description',
        'expense_type', 'riel', 'dollar', 'reciever',
    ];
}

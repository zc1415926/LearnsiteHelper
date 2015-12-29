<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentsInfo extends Model
{
    protected $table = 'students_info';
    protected $fillable = ['Sid', 'Sgrade', 'Sclass', 'Sname'];
}

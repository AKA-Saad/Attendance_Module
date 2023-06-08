<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class attendances extends Model
{
    use HasFactory;
    protected $table = 'attendance';

    protected $fillable = ['employee_id', 'check_in', 'check_out'];
}

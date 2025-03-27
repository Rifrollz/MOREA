<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use Hasfactory;

    protected $fillable = ['email']; // to allow mass assignment
}

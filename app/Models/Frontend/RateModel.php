<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RateModel extends Model
{
    use HasFactory;
    protected $table = "rates";
    public $timestamps = true;
}
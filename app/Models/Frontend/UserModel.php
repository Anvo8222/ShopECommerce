<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
  use HasFactory;
  protected $table = "users";

  protected $fillable = [
    'name',
    'email',
    'password',
    'avatar',
    'address',
    'phone',
    'id_country',
  ];
}
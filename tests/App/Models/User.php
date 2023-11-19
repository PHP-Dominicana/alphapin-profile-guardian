<?php

namespace PHPDominicana\AlphapinProfileGuardian\Tests\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	use HasFactory;

	protected $fillable = [
		'name',
		'email',
	];
}

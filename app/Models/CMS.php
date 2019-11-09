<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
    protected $table = 'cms';
	
	protected $fillable = [
		'logo',
		'about',
		'address',
		'slider1',
		'slider2',
		'slider3',
	];
}

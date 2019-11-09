<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebStatistic extends Model
{
    protected $table = 'web_statistic';
	
	protected $fillable = [
		'ip',
		'session_id',
		'browser',
		'device_type',
		'os',
		'is_mobile',
		'ref_url_name',
	];
}

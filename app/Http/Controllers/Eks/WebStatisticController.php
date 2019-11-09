<?php

namespace App\Http\Controllers\Eks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WebStatistic;
use File;

class WebStatisticController extends Controller
{
    public function store_visitor()
	{
		try {
            $data = [
				'ip'			=> get_ip(),
				'session_id'	=> \Session::getId(),
				'browser'		=> get_visitor_browser(),
				'device_type'	=> get_device(),
				'os'			=> get_os(),
				'is_mobile'		=> is_mobile(),
				'ref_url_name'	=> visitor_ref()
			];
			$save = WebStatistic::create( $data );
			
		}catch (\Throwable $e) {
            return response()->error('Error',throwable_msg($e));
        }catch (\Exception $e) {
            return response()->error('Error',exception_msg($e));
		}
		return response()->success('Success', $save);
	}

	public function run()
	{
		// dd(123);
		$path = public_path('logs');	
		// File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
		File::append($path.'/log_'.date('Ymd').'.txt',"\r\n==== Start Job ====");
		File::append($path.'/log_'.date('Ymd').'.txt',"\r\n==== End Job ====");
	}
}

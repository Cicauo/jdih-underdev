<?php

if (! function_exists('cek_berlaku_by_jenis_peraturan')) {
	function cek_berlaku_by_jenis_peraturan($id) {
	   $get = \App\Models\Dokumen::selectRaw('count(id_peraturan) as jml')->where('berlaku',true)->where('id_peraturan',$id)->first();
		if($get){
			return $get->jml;
		}else{
			return 0;
		}
	}	
}

if (! function_exists('cek_tidak_berlaku_by_jenis_peraturan')) {
	function cek_tidak_berlaku_by_jenis_peraturan($id) {
	   $get = \App\Models\Dokumen::selectRaw('count(id_peraturan) as jml')->where('berlaku',false)->where('id_peraturan',$id)->first();
		if($get){
			return $get->jml;
		}else{
			return 0;
		}
	}	
}

if (! function_exists('clean')) {
	function clean($string) {
	   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
	   return preg_replace('/-+/', '-', $string); // Replaces multiple hyphens with single one.
	}	
}

if (!function_exists('throwable_msg')) {
	function throwable_msg($e)
	{
		return 'Terjadi kesalahan pada backend -> '.substr($e->getMessage(),0,500);
	}
}

if (!function_exists('exception_msg')) {
	function exception_msg($e)
	{
		return 'Terjadi kesalahan sistem silahkan tunggu beberapa saat dan ulangi kembali. Error messages -> '.substr($e->getMessage(),0,300);
	}
}

if (!function_exists('is_mobile')) {
	function is_mobile()
	{
		$useragent=$_SERVER['HTTP_USER_AGENT'];

		if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
			return 1;
		}else{
			return 0;
		}
	}
}

if (!function_exists('visitor_ref')) {
	function visitor_ref()
	{
		$url = @$_SERVER['HTTP_REFERER'];
		$parse = parse_url($url);
		return @$parse['host'];
	}
}

if (!function_exists('get_ip')) {
	function get_ip(){
		$client  = @$_SERVER['HTTP_CLIENT_IP'];
		$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
		$remote  = $_SERVER['REMOTE_ADDR'];

		if(filter_var($client, FILTER_VALIDATE_IP)){
			$ip = $client;
		}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
			$ip = $forward;
		}else{
			$ip = $remote;
		}

		return $ip;
	}

}

if (!function_exists('get_visitor_browser')) {
	function get_visitor_browser(){
	
	if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
	   return 'Internet explorer';
	 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
		return 'Internet explorer';
	 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
	   return 'Mozilla Firefox';
	 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
	   return 'Google Chrome';
	 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
	   return "Opera Mini";
	 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
	   return "Opera";
	 elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
	   return "Safari";
	 else
	   return 'Tidak diketahui ('.$_SERVER['HTTP_USER_AGENT'].')';

	}


}

if (!function_exists('get_device')) {
	function get_device(){
		$deviceName='';
		$userAgent = $_SERVER["HTTP_USER_AGENT"];
		$devicesTypes = array(
			"computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
			"tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
			"mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
			"bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
		);
		foreach($devicesTypes as $deviceType => $devices) {           
			foreach($devices as $device) {
				if(preg_match("/" . $device . "/i", $userAgent)) {
					$deviceName = $deviceType;
				}
			}
		}
		return ucfirst($deviceName);
	}

}

if (!function_exists('get_os')) {
	function get_os() { 
		$user_agent     =   $_SERVER['HTTP_USER_AGENT'];
		$os_platform    =   "Unknown OS Platform";
		$os_array       =   array(
								'/windows nt 10/i'     =>  'Windows 10',
								'/windows nt 6.3/i'     =>  'Windows 8.1',
								'/windows nt 6.2/i'     =>  'Windows 8',
								'/windows nt 6.1/i'     =>  'Windows 7',
								'/windows nt 6.0/i'     =>  'Windows Vista',
								'/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
								'/windows nt 5.1/i'     =>  'Windows XP',
								'/windows xp/i'         =>  'Windows XP',
								'/windows nt 5.0/i'     =>  'Windows 2000',
								'/windows me/i'         =>  'Windows ME',
								'/win98/i'              =>  'Windows 98',
								'/win95/i'              =>  'Windows 95',
								'/win16/i'              =>  'Windows 3.11',
								'/macintosh|mac os x/i' =>  'Mac OS X',
								'/mac_powerpc/i'        =>  'Mac OS 9',
								'/linux/i'              =>  'Linux',
								'/ubuntu/i'             =>  'Ubuntu',
								'/iphone/i'             =>  'iPhone',
								'/ipod/i'               =>  'iPod',
								'/ipad/i'               =>  'iPad',
								'/android/i'            =>  'Android',
								'/blackberry/i'         =>  'BlackBerry',
								'/webos/i'              =>  'Mobile'
							);

		foreach ($os_array as $regex => $value) { 

			if (preg_match($regex, $user_agent)) {
				$os_platform    =   $value;
			}

		}   

		return $os_platform;

	}

}


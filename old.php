<?php
function generateSignature($file, $time, $qsv) {
	return md5($file.$qsv.'43e814b31f8764756672c1cd1217d775'.$time);
}
$url = 'http://webservices.hktv.com.hk/account/token';
$ki = '12';
$ts = date(U);
$s = generateSignature('account/token',$ts,$ki.'0');
$data = array(
	"muid" => "0",
	"ki" => $ki,
	"ts" => $ts,
	"s"=> $s
);

// use key 'http' even if you send the request to https://...
$options = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data),
	),
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$t_pos_s = strpos($result,'token',1);
$t_pos_e = strpos($result,'"',$t_pos_s+8);
$got_token = substr($result,$t_pos_s+8,$t_pos_e-strlen($result));

$vid = '1';
$uid = '1';
$d = 'USB Android TV';
$mf = 'SONY';
$mdl = 'C1905';
$os = '4.1.2';
$udid = '00000000-0000-0000-0000-000000000000';
$mxres = '1920'; // maximum screen dimension
$net = 'fixed'; // 3G/4G/fixed/wifi
$s2 = generateSignature('playlist/request',$ts,$d.$ki.$mdl.$mf.$mxres.$net.$os.$got_token.$udid.$uid.$vid);

//$url2 = 'http://webservices.hktv.com.hk/playlist/request';
$url2 = 'http://ott-www.hktvmall.com/api/playlist/request';
$data2 = array(
	"d" => $d,
	"ki" => $ki,
	"mdl" => $mdl,
	"mf" => $mf,
	"mxres" => $mxres,
	"net" => $net,
	"os" => $os,
	"t" => $got_token,
	"udid" => $udid,
	"uid" => $uid,
	"vid" => $vid,
	"ts" => $ts,
	"s"=> $s2
);
$options2 = array(
	'http' => array(
		'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		'method'  => 'POST',
		'content' => http_build_query($data2),
	),
);
$context2  = stream_context_create($options2);
$result2 = file_get_contents($url2, false, $context2);
$surl_pos_s = strpos($result2,'http',1);
$surl_pos_e = strpos($result2,'"',$surl_pos_s);
$surl = substr($result2,$surl_pos_s,$surl_pos_e-strlen($result2));
header("Location: $surl");
?>

<?php 
	$ch = curl_init(); 
	$url = 'https://toutiao.io/';
	$this_header = array(
	"content-type: application/x-www-form-urlencoded; 
	charset=UTF-8"
	);
	curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT,7);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_HEADER, 0);
	$output = curl_exec($ch); 
	$output = strstr($output,"daily");
	$regex_title="/<a target=\"_blank\" rel=\"external\".*?>.*?<\/a>/ism"; 
	preg_match_all($regex_title, $output, $title);
	$regex_link="/<div class=\"meta\".*?>.*?<span>/ism";
	preg_match_all($regex_link, $output, $link);
	$arr = Array();
	$arr['title'] = $title;
	$arr['link'] = $link;
	 var_dump($title);

	
//	print_r($title);die;















 ?>
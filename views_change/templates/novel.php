功能模块施工中。
<?php
//apache性能需调试，采集任务依然会造成假死。
//set_time_limit(0); 
//
//function html2text($str){
// $str = preg_replace("/<style .*?<\\/style>/is", "", $str);
// $str = preg_replace("/<script .*?<\\/script>/is", "", $str);
// $str = preg_replace("/<br \\s*\\/>/i", " ", $str);
// $str = preg_replace("/<\\/?p>/i", " ", $str);
// $str = preg_replace("/<\\/?td>/i", "", $str);
// $str = preg_replace("/<\\/?div>/i", " ", $str);
// $str = preg_replace("/<\\/?blockquote>/i", "", $str);
// $str = preg_replace("/<\\/?li>/i", " ", $str);
// $str = preg_replace("/ /i", " ", $str);
// $str = preg_replace("/ /i", " ", $str);
// $str = preg_replace("/&/i", "&", $str);
// $str = preg_replace("/&/i", "&", $str);
// $str = preg_replace("/</i", "<", $str);
// $str = preg_replace("/</i", "<", $str);
// $str = preg_replace("/“/i", '"', $str);
// $str = preg_replace("/&ldquo/i", '"', $str);
// $str = preg_replace("/‘/i", "'", $str);
// $str = preg_replace("/&lsquo/i", "'", $str);
// $str = preg_replace("/'/i", "'", $str);
// $str = preg_replace("/&rsquo/i", "'", $str);
// $str = preg_replace("/>/i", ">", $str);
// $str = preg_replace("/>/i", ">", $str);
// $str = preg_replace("/”/i", '"', $str);
// $str = preg_replace("/&rdquo/i", '"', $str);
// $str = strip_tags($str);
// $str = html_entity_decode($str, ENT_QUOTES, "utf-8");
// $str = preg_replace("/&#.*?;/i", "", $str);
// return $str;
//}
//
////取得指定位址的內容，并储存至 $text   
//
//$url='http://www.kanmaoxian.com/49/49589/index.html'; 
//$ch = curl_init(); 
//$timeout = 1; 
//curl_setopt ($ch, CURLOPT_URL, $url); 
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); //不自动输出内容
//curl_setopt($ch, CURLOPT_HEADER, 0);//不返回头部信息
//curl_setopt($ch, CURLOPT_ENCODING, 'gzip'); 
//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
//
//do {
//$file_contents1 = curl_exec($ch);//执行
//curl_close($ch); 
//} while (empty($file_contents1));
//
//
//
//
//$file_contents1 = iconv("gb2312","utf-8//IGNORE",$file_contents1);
////echo $file_contents1; 
//
//
////$rule="/<title>(.*)<\/title>/";
//$rule = '|<a\shref=\"\/49\/49589\/([0-9]*)\.html\"\stitle=\"(.*)\">(.*)<\/a>|i';//正则
//preg_match_all($rule,$file_contents1,$arr,PREG_PATTERN_ORDER);
//
//
//$novel_array = array_combine($arr[1],$arr[2]);//合并两个数组，一个为键名一个为键值；
//
//
//foreach ($novel_array as $num => $value){
//	
//
////取得指定位址的內容，并储存至 $text   
////$num = '8999439';
////$value = '1';
//$url='http://www.kanmaoxian.com/49/49589/'.$num.'.html'; 
//$ch = curl_init(); 
//$timeout = 1; 
//curl_setopt ($ch, CURLOPT_URL, $url); 
//curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1); //不自动输出内容
//curl_setopt($ch, CURLOPT_HEADER, 0);//不返回头部信息
//curl_setopt($ch, CURLOPT_ENCODING, 'gzip'); 
//curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout); 
//
// 
//do {
//	
//$file_contents = curl_exec($ch);//执行
//sleep(0.5);
//curl_close($ch); 
//
//} while (empty($file_contents));
//
//
//
//
//$file_contents = iconv("gb2312","utf-8//IGNORE",$file_contents);
//
//$rule = '|<div class=\"yd_text2\">([\s\S]*)<\/div>|i';//正则
//preg_match_all($rule,$file_contents,$arr,PREG_PATTERN_ORDER);
//
////print_r($arr[1][0]);
//
//$text = html2text($arr[1][0]);
//
//
//$text = $value."\r\n\r\n".$text."\r\n\r\n\r\n";
//$value1 = iconv("utf-8","gb2312//IGNORE",$value);
//file_put_contents('assets/novel/'.$value1.'.txt',$text,FILE_APPEND);
//
//
//
//
////echo $text;
//
//}
//
//
//
//
//?>
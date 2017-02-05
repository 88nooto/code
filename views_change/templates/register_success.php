<?php
echo '注册成功。</br>';


foreach($register_data as $name => $shuxing)
{
	echo $name.':'.$shuxing.'</br>';
}





?>
<p>10秒后自动返回主页，如果浏览器没有响应，您可以
<a href="localhost">返回主页</a>
 或者
<a href="login">登录</a>
</p>


<?php 

$url = 'http://localhost/';
header('refresh:10;url='.$url);


exit;
?>
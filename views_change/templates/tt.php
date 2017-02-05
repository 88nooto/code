
<style>
	img.avatar_img{
		width:150px;
		height:150px;
		border-radius:150px;
		vertical-align:middle;
		float:left;
	}
	
		
</style>



<?php 
echo '<div style="height:150px;">';

//显示头像
$avatar_img = 'assets/images/avatar/'.$_SESSION['loginfo']['uid'].'/'.$_SESSION['loginfo']['avatar'].'.png';
$avatar_img = '<img src = "'.$avatar_img.'" class="avatar_img"/>';
echo $avatar_img;



//显示用户登录信息
echo '<div style="display:inline-block;vertical-align:middle;padding:50px;">';
echo 'uid:'.$_SESSION['loginfo']['uid'];

				//加密配置
				$this->encryption->initialize(//加密算法，模式，key配置。
				array(
					'cipher' => 'aes-256',
					'mode' => 'ecb',
					)
				);
//解密用户名
$username = $this->encryption->decrypt($_SESSION['loginfo']['username']);
echo '</br>username:'.$username.'</br>';
echo 'nickname:'.$_SESSION['loginfo']['nickname'].'</br>';



echo '</div></div>';


echo '</br>-------------------</br>';


foreach(gd_info() as $name=>$shuxing)
{
	echo $name.':'.$shuxing.'</br>';
}

//foreach($register_data as $name=>$shuxing):
//	echo $name.':'.$shuxing.'</br>';
//endforeach;
?>

<a href="logout"> Log Out</a>

<div id="ttop">
	<div id="ttop-homelink">
		<a href="images/Coffeelogo01.png" class="navigation-link" target="_blank">
			if ( Co + 2Fe → Coffee ), So ~ Colorlili + Co + 2Fe → ?
		</a>
	</div>
	<div id="uesr">
		<?php 
				$this->encryption->initialize(//加密算法，模式，key配置。
		array(
		'cipher' => 'aes-256',
		'mode' => 'ecb',
		//'key' => $result -> string2,  //获取盐值2
		)
		);
		
		
		if (isset($_SESSION['loginfo']['username'])) {
				
				$avatar_img = 'assets/images/avatar/'.$_SESSION['loginfo']['uid'].'/'.$_SESSION['loginfo']['avatar'].'.png';
				$avatar_img = '<a href="usermenu"><img src = "'.$avatar_img.'" style= "width:34px;height:34px;border-radius:34px;margin-bottom:5px; vertical-align:middle;"/></a>';
				
				//读取头像
				
				
				//$_SESSION['loginfo']['username'] = $a
				$username = $this->encryption->decrypt($_SESSION['loginfo']['username']);
				
				$hpud = '<a href="usermenu" class="navigation-link" style= "">'.$_SESSION['loginfo']['nickname'].'</a><a href="logout" > Log Out</a>';
				
				//echo $ava;
				echo $avatar_img.$hpud;
		}else {
				$hpud = '
		<a href="login" class="navigation-link" >
			登陆
		</a>/
		<a href="register" class="navigation-link">
			注册
		</a>
				';
				echo $hpud;
		}
		?>
	</div>
	<!-- end .ttop -->
</div>
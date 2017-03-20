<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<title></title>

		
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/registerPage.css"/>
<script src= "assets/js/jquery-3.1.0.js"></script> 
<script src= "assets/js/easyform.js"></script> 
	</head>
	<body>
		<!--
		<div class=''>
		<form class="land-form" action="register" method='post'>
		<div>Username
		<input type="text" class="land-input" placeholder="" value="<?php //echo set_value('un'); ?>" name="un" autofocus/>

		</div>
		<div class="land-user">Password
		<input type="password" class="land-input" placeholder="" name="pw"/>
		</div>
		<div>Repeat password
		<input type="password" class="land-input" placeholder="" name="repw"/>
		</div>
		<div>Email
		<input type="email" class="land-input" placeholder="" name="email"/>
		</div>
		<div>
		<input type="submit" id="import-b" value="Get in">
		</div>
		</form>
		</form>
		</div>
		-->
		<div class="form-div" style="margin-top:50px;">
			<form id="reg-form" action="register" method="post">

				<table>
					<tr>
						<td>用户名</td>
						<td>
							<input name="un" type="text" id="uid" easyform="length:4-16;char-normal;real-time;" message="用户名必须为4—16位的英文字母或数字" easytip="disappear:lost-focus;theme:blue;" ajax-message="用户名已存在!" 
								value="<?php echo set_value('un'); ?>" autofocus/>
						</td>
					</tr>
					<tr>
						<td>密码</td>
						<td>
							<input name="psw" type="password" id="psw1" easyform="length:6-16;" message="密码必须为6—16位" easytip="disappear:lost-focus;theme:blue;"/>
						</td>
					</tr>
					<tr>
						<td>确认密码</td>
						<td>
							<input name="pw" type="password" id="psw2" easyform="length:6-16;equal:#pw;" message="两次密码输入要一致" easytip="disappear:lost-focus;theme:blue;"/>
						</td>
					</tr>
					<tr>
						<td>Email</td>
						<td>
							<input name="email" type="text" id="email" easyform="email;real-time;" message="Email格式要正确" easytip="disappear:lost-focus;theme:blue;" ajax-message="这个Email地址已经被注册过，请换一个吧!"
								value="<?php echo set_value('email'); ?>"/>
						</td>
					</tr>
					<tr>
						<td>昵称</td>
						<td>
							<input name="nickname" type="text" id="nickname" easyform="length:2-16" message="昵称必须为2—16位" easytip="disappear:lost-focus;theme:blue;"
								value="<?php echo set_value('nickname'); ?>"/>
						</td>
					</tr>
					<tr>
						<td>邀请码</td>
						<td>
							<input name="keycode" type="text" id="keycode" easyform="length:16;char-normal" message="请输入正确的邀请码" easytip="disappear:lost-focus;theme:blue;"
								value="<?php echo set_value('keycode'); ?>"/>
						</td>

				</table>
<?php echo $message; ?>
				<div class="buttons">
					
					<input value="注 册" type="submit" style="margin-right:20px; margin-top:20px;"/>
					<a href="login">
					<input  value="我有账号，我要登录" type="button" style="margin-right:45px; margin-top:20px;"/>
					</a>
				</div>

				<br class="clear">
			</form>
		</div>

		<script type="text/javascript">$(document).ready(function() {
	$('#reg-form').easyform();
});</script>

	</body>
</html>

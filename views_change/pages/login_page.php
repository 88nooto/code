<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
		<title>
		</title>
		<!--<link rel="stylesheet" type="text/css" href="css/loginPage.css">-->
		
		<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/loginPage.css">
			
	</head>
	<body>
		<!--
	嘘，或许可以尝试访问/admin
	user：temp
	pw：123456
-->
		<?php //echo $errors; ?>
			<div >
				
			</div>
		<!--<div class="ll">-->
			<div class="ll-box" style="margin-top:100px;">
				<div id="land-wod">
					<div id="land-logo">
						<img src="assets/images/logo/Coffeelogo01-samll.png" />
					</div>
					<div class="land-text">
						Welcome~
					</div>
					<div class="land-text2">
						Welcome~
					</div>
					<div style="font:normal normal 10px '微软雅黑'; color:red;margin: 5px 0;	text-align:center;"><?php echo $message; ?></div>
					<form class="land-form" action="" method='post'>

						<div class="land-user" style="">
							
							<input type="text" class="land-input" placeholder="import your username or Email" value="<?php echo set_value('un'); ?>" name="un" autofocus/>
						</div>
						<div class="land-user">
							<input type="password" class="land-input" placeholder="import your password" name="pw"/>
							
						</div>
					<div class="land-import">
						<button type="submit" id="import-b" value="go!">go!</button>
					</div>
					</form>
					<div id="reglink-box">
						<a href="register">
							<img id="reglink-img" src="assets/images/ohter/4.png" />
						</a>
					</div>
					<!--end. land-wd-->
				</div>
				<!--end. ll-box-->
			</div>
			<!--end. ll-->
		<!--</div>-->
		<!--<div class="lr">
			<div class="lr-box">
				<ul id="lr-ul">
					<li class="lr-ulli">
						<img src="javascript:vold(0)" />
<p><?php
//echo $str_un;
//echo "</br>";
//echo $str_pw;
//echo $_SERVER[HTTP_USER_AGENT];
?></p>
					</li>
					<li class="lr-ulli">
						<img src="javascript:vold(0)" />
					</li>
					<li class="lr-ulli">
						<img src="javascript:vold(0)" />
					</li>
					<li class="lr-ulli">
						<img src="javascript:vold(0)" />
					</li>
					<li class="lr-ulli">
						<img src="javascript:vold(0)" />
					</li>
					<li class="lr-ulli">
						<img src="javascript:vold(0)" />
					</li>
					<li class="lr-ulli">
						<img src="javascript:vold(0)" />
					</li>
					<li class="lr-ulli">
						<img src="javascript:vold(0)" />
					</li>
					<li class="lr-ulli">
						<img src="javascript:vold(0)" />
					</li>
				</ul>
			</div>
		</div>-->
	</body>
</html>

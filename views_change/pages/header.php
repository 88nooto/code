<!--<html>
    <head>
        <title>CodeIgniter Tutorial</title>
    </head>
    <body>

        <h1><?php echo $title; ?></h1>-->
        
<!DOCTYPE html>
<html lang="zh-cn">
	<head>
		<meta charset="utf-8" />
		<title>
			Co + 2Fe → ?
		</title>


	</head>
	<body>
		<div class="ccontainer">
			<?php 
				//$this->load->helper('array');
				//$data['hpud_num2'] = $hpud_num;
				$this->load->view($ttop);
			?>

		</div>
			<?php 	if (isset($header_data))
					{
						 
						 //$header_img = "$"."header_data['".$page_name."']";
						 //$header_img = $header_data['home_img'];
			?>
			<div id="h01" class="header"style="background:url(assets/images/header_bg/<?php echo $header_data['header_img']; ?>) no-repeat center top transparent;">
				<div id="logo">
					<!-- logo -->
					<a href="index.php" style="color:#0F0">
						<img src="/assets/images/logo/<?php echo $header_data['logo_img']; ?>" />
					</a>
				</div>
				<!-- end .header -->
			<?php 
					}
			?>
			</div>
			<?php 
				$this->load->view('mode/navigation');
				?>
			
			<?php 
//			echo $title; 
//			echo '</br></br>--------------header---------------';
//			
//				 foreach ($header_data as $a): 
//				    echo '</br>1* ';
//					echo $header_data['header_img'];	
//					echo '</br>2* ';
//					echo $header_data['logo_img'];	
//					echo '</br>3* ';
//					//$page_name= 'home';
//					//$tb_name = "'logo_img,".$page_name."_img'";
//					//echo $page_name;
//					//echo  $header_img;
//					endforeach;
//			echo '</br>--------------header---------------</br></br>';
					?>
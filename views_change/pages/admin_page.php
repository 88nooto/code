<?php
				//加密配置
				$this->encryption->initialize(//加密算法，模式，key配置。
				array(
					'cipher' => 'aes-256',
					'mode' => 'ecb',
					)
				);
//解密用户名
$username = $this->encryption->decrypt($_SESSION['loginfo']['a_un']);
?>
<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<h3>
				
				Welcome~  <?php echo $username; ?>
			</h3>
			<p class="text-info">您的ip为：<?php echo $this->input->ip_address(); ?></p>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-3 column">
			<ul class="nav nav-stacked nav-pills">
				<!--<li class="active">
					 <a href="#">首页</a>
				</li>
				<li>
					 <a href="#">简介</a>
				</li>
				<li class="disabled">
					 <a href="#">信息</a>
				</li>-->
				<?php foreach ($l_nav as $key => $value):
					?>
				<li>
					 <a href="javascript:void(0)" name="<?php echo $value;?>"><?php echo $key;?></a>
				</li>
				<?php endforeach; ?> 
				<li class="dropdown pull-right" >
					</br>
				</li>
			</ul>
			<a href="/admin/logout"> Log Out</a>
		</div>
		<div class="col-md-9 column" id = "r_div">
			<table class="table table-hover table-condensed" hidden>
				<thead>
					<tr>
						<th>
							编号
						</th>
						<th>
							产品
						</th>
						<th>
							交付时间
						</th>
						<th>
							状态
						</th>
						<th>
							最后登录ip
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							1
						</td>
						<td>
							TB - Monthly
						</td>
						<td>
							01/04/2012
						</td>
						<td>
							Default
						</td>
					</tr>
					<tr class="success">
						<td>
							1
						</td>
						<td>
							TB - Monthly
						</td>
						<td>
							01/04/2012
						</td>
						<td>
							Approved
						</td>
					</tr>
					<!--<tr class="error">
						<td>
							2
						</td>
						<td>
							TB - Monthly
						</td>
						<td>
							02/04/2012
						</td>
						<td>
							Declined
						</td>
					</tr>-->
					<tr class="warning">
						<td>
							3
						</td>
						<td>
							TB - Monthly
						</td>
						<td>
							03/04/2012
						</td>
						<td>
							Pending
						</td>
					</tr>
					<tr class="info">
						<td>
							4
						</td>
						<td>
							TB - Monthly
						</td>
						<td>
							04/04/2012
						</td>
						<td>
							Call in to confirm
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>


  </body>
</html>
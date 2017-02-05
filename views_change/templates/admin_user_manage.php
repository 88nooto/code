			<div id="myadd" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-sm">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			×
			</button>
			<h4 class="modal-title" id="myModalLabel"> add admin </h4>
			</div>
			<div class="modal-body" >
			
			<form id="add_form" class="form" role="form" >
				<div class="form-group">
				<label for="exampleInputEmail1">Name</label>
				<input type="text" class="form-control" name="user" placeholder="">
				</div>
				<div class="form-group">
				<label for="exampleInputEmail1">Password</label>
				<input type="password" class="form-control" name="first_pass" placeholder="">
				</div>
				<div class="form-group">
				<label for="exampleInputEmail1">Password Confirm</label>
				<input type="password" class="form-control" name="verify_pass" placeholder="">
				</div>
				<div class="form-group">
				<label for="exampleInputEmail1">Permissions</label>
				<select class="form-control" name="power">
					<option>系统管理员</option>
					<option>网站管理员</option>
					<option>普通管理员</option>
				</select>
				</div>
			</form>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">
			关闭
			</button>
			<button id="add" type="button" class="btn btn-success">
			添加
			</button>
			</div>
			</form>
			</div>
			</div>
			</div>
			
<div style="position: absolute;width: 100%;">
	<div style="float: right;position: relative;top:-30px;left: -30px;">
		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myadd">
		添加管理员
		</button>
	</div>
</div>
<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th> Uid </th>
			<th> 管理员账户 </th>
			<th> 权限 </th>
			<th> 最后登录ip </th>
			<th> 最后登陆时间 </th>
			<th> 创建时间 </th>
			<th> Action </th>
		</tr>
	</thead>
	<tbody>
		<?php
		$num = 0;
		foreach ($admin_user as $user_data):
		?>
		<tr class="<?php
		//$arr=array_rand($tr_class,1);
		$num = $num + 1;
		echo $tr_class[$num];
		if($num>2){$num = -1;}
		?>
		">
			<td> <?php	echo $user_data['admin_uid']; ?> </td>
			<td> <?php
//加密配置
$this->encryption->initialize(//加密算法，模式，key配置。
array(
'cipher' => 'aes-256',
'mode' => 'ecb',
)
);
//解密用户名
$username = $this->encryption->decrypt($user_data['admin_user']);
echo $username;

			?>
			</td>
			<td>
			<?php
			switch ($user_data['power']) {
				case "1" :
					echo "系统管理员";
					break;
				case "2" :
					echo "网站管理员";
					break;
				case "3" :
					echo "普通管理员";
					break;
				default :
					echo "error";
			}
		?></td>
			<td> <?php
			echo $user_data['last_ip'];
			?>
			</td>
			<td> <?php echo $user_data['last_login']; ?>
			</td>
			<td> <?php echo $user_data['c_time']; ?>
			</td>
			<td>
			<button type="button" class="btn btn-warning btn-xs revise" data-toggle="modal" data-target="#myModal">
			修改
			</button>
			<button type="button" class="btn btn-danger btn-xs remove">
			删除
			</button>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
			×
			</button>
			<h4 class="modal-title" id="myModalLabel"> Revise data </h4>
			</div>
			<div id="revise_page" class="modal-body" >
			内容...
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">
			关闭
			</button>
			<button id="revise_confirm" type="button" class="btn btn-warning">
			修改
			</button>
			</div>
			</div>
			</div>
</div>
<script type="text/javascript">



$('#add').click(function() {

	$.ajax({
		type: "post",
		url: "/admin/add_admin",
		//async: false ,
		//dataType: "json",
		data: $("#add_form").serialize(),
		success: function(result) 
		{
				//$("#r_div").load('/admin/revise_admin_user_data');
				//$("#r_div").load(result);
			alert(result+" / ok");
		},
		error: function (result) 
		{
			alert(this+" / no");
		}
//		complete: function (XMLHttpRequest, textStatus) 
//		{
//  	alert(this); // 调用本次AJAX请求时传递的options参数
//		}
	});
});


$('.revise').click(function() {
	var children = $(this).parent().parent().children();
	//console.log(children.eq(0).text());
	//alert($.trim(children.eq(1).text()));
	var uid = $.trim(children.eq(0).text());
	var user = $.trim(children.eq(1).text());
	$.ajax({
		type: "post",
		url: "/admin/revise_admin_user_data",
		//async: false ,
		//dataType: "json",
		data: {"uid": uid,"user": user},
		success: function(result) {
				//$("#r_div").load('/admin/revise_admin_user_data');
				//$("#r_div").load(result);
				$("#revise_page").html(result);
				
			}
			//error: function (XMLHttpRequest, textStatus, errorThrown) {alert(XMLHttpRequest.responseText);}
	});
});

$('#revise_confirm').click(function() {
	var r = confirm("确定要修改吗？")
	if(r == true) {
		$.ajax({
			type: "post",
			url: "/admin/revise_now_user",
			async: false,
			//dataType: "json",
			data: $("#revise_form").serialize(),
			success: function(result) {
				//$("#r_div").load('/admin/revise_admin_user_data');
				//$("#r_div").load(result);
				alert($.trim(result));
				//$("#revise_page").html(result);
				//location.reload(true);

			},
			error: function(result) {
				alert($.trim(result));
			}
		});
	} else {

	}
});

$('.remove').click(function() {
	var children = $(this).parent().parent().children();
	//console.log(children.eq(0).text());
	//alert($.trim(children.eq(1).text()));
	var uid = $.trim(children.eq(0).text());
	var user = $.trim(children.eq(1).text());
	var r = confirm("确定要删除 "+uid+"."+user+" 吗？")
	if(r == true) 
	{
		$.ajax({
		type: "post",
		url: "/admin/remove_admin_data",
		//async: false ,
		//dataType: "json",
		data: {"uid": uid,"user": user},
		success: function(result) {
				//$("#r_div").load('/admin/revise_admin_user_data');
				//$("#r_div").load(result);
				//$("#revise_page").html(result);
				alert($.trim(result));
				//location.reload(true);
				$("#r_div").load("/admin/admin_data_ctrl/user",function()
       			{
   					//alert("The last 25 entries in the feed have been loaded / "+name);
        		});
		},
		error: function(result) {
				alert(result);
		}
		});
	}
});



</script>

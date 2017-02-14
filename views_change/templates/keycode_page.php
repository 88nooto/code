<table class="table table-hover table-condensed">
	<thead>
		<tr>
			<th> Keycode </th>
			<th> 状态 </th>
			<th> 使用用户Uid </th>
			<th> 使用时间 </th>
			<th> 创建时间 </th>
			<th> Action </th>
		</tr>
	</thead>
	<tbody>
		<?php
		$num = 0;
		foreach ($keycode_data as $keycode):
		?>
		<tr class="<?php
		//$arr=array_rand($tr_class,1);
		//$num = random_int(0, 3);
		$num = $num + 1;
		echo $tr_class[$num];
		if($num>2){$num = -1;}
		?>
		">
			<td> <?php	echo $keycode['key_code']; ?> </td>
			<td> <?php 	switch ($keycode['state_code']) {
				case "0" :
					echo "未使用";
					break;
				case "1" :
					echo "已使用";
					break;
				default :
					echo "error";
			}?>
			</td>
			<td><?php echo $keycode['uid_code']; ?></td>
			<td> <?php echo $keycode['keydate_use']; ?></td>
			<td> <?php echo $keycode['keydate_create']; ?></td>
			<td>
			<button type="button" class="btn btn-danger btn-xs remove_code">
			删除
			</button>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<script type="text/javascript">



$('.remove_code').click(function() {
	var children = $(this).parent().parent().children();
	//console.log(children.eq(0).text());
	//alert($.trim(children.eq(1).text()));
	var keycode = $.trim(children.eq(0).text());
	var r = confirm("确定要删除/ "+keycode+" /吗？")
	if(r == true) 
	{
		$.ajax({
		type: "post",
		url: "/admin/remove_keycode",
		//async: false ,
		//dataType: "json",
		data: {"key": keycode},
		success: function(result) {
				//$("#r_div").load('/admin/revise_admin_user_data');
				//$("#r_div").load(result);
				//$("#revise_page").html(result);
				alert($.trim(result));
				console.log($.trim(result));
				//location.reload(true);
				$("#r_div").load("/admin/admin_data_ctrl/code",function()
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
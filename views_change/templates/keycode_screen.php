<div id="addcode" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
				×
				</button>
				<h4 class="modal-title" id="myModalLabel"> add keycode </h4>
			</div>
			<div class="modal-body" >
				<div id="show">
					请点击添加按钮，以新增邀请码。
				</br>
				</div>
			</div>
			</form>
		
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">
			关闭
			</button>
			<button id="add" type="button" class="btn btn-success">
			添加
			</button>
		</div>
		</div>
		</form>
	</div>
</div>
</div>



<div style="position: absolute;width: 100%;">
	<div style="float: left;position: relative;top:-30px;left: 0px;">
		<button name="not" type="button" class="btn btn-default btn-sm keycode-status" >
		未使用
		</button>
		<button name="yes" type="button" class="btn btn-default btn-sm keycode-status" >
		已使用
		</button>
	</div>
	
	<div style="float: right;position: relative;top:-30px;left: -30px;">
		<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addcode">
		添加邀请码
		</button>
	</div>
	
</div>
<div id="datalist">
</div>


<script type="text/javascript">

$.ajax({
		type: "post",
		url: "/admin/screen_admin_keycode_data",
		data: {"active": name},
		success: function(result)
		{
			$("#datalist").load("/admin/screen_admin_keycode_data");
			//console.log(children.eq(0).text());
		},
		error: function (result) 
		{
			//alert(this+" / no");
		}
	});



$('button.keycode-status').click(function() {
	
	$("button.keycode-status").removeClass("btn-primary");
	$("button.keycode-status").removeClass("btn-default");
	$("button.keycode-status").addClass("btn-default");
	$(this).removeClass("btn-default");
	$(this).addClass("btn-primary");
	var name = $(this).attr("name");
	$.ajax({
		type: "post",
		url: "/admin/screen_admin_keycode_data",
		//async: false ,
		//dataType: "json",
		data: {"active": name},
		success: function(result) 
		{
				//$("#r_div").load('/admin/revise_admin_user_data');
				//$("#show").text(result);
			alert(name+" / ok");
			$("#datalist").html(result);
			//console.log(children.eq(0).text());
		},
		error: function (result) 
		{
			//alert(this+" / no");
		}
//		complete: function (XMLHttpRequest, textStatus) 
//		{
//  	alert(this); // 调用本次AJAX请求时传递的options参数
//		}
	});

});


$('#add').click(function() {

	$.ajax({
		type: "post",
		url: "/admin/add_keycode",
		//async: false ,
		//dataType: "json",
		success: function(result) 
		{
				//$("#r_div").load('/admin/revise_admin_user_data');
				$("#show").text(result);
			//alert(result+" / ok");
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
</script>
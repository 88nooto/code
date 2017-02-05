<?php ?>
<div class="row clearfix">
	
	<div class="col-md-6 column">
		<label for="exampleInputEmail1" >Uid：</label>
		<p class="text-muted"><?php echo $data['admin_uid']; ?></p>
		<label for="exampleInputEmail1">User：</label>
		<p class="text-primary"><?php 
		$data['admin_user'] = $this -> encryption -> decrypt($data['admin_user']);
		echo $data['admin_user']; ?></p>
		<label for="exampleInputEmail1">Permissions：</label>
		<p class="text-success"><?php 
							switch ($data['power']){
								case "1":
									echo "系统管理员";
									break; 
								case "2":
									echo "网站管理员";
									break;
								case "3":
									echo "普通管理员";
									break;
								default:
									echo "error";
							}
				//echo $data['admin_power']; 
								?></p>
		
	</div>


	<div class="col-md-6 column">
		<form id="revise_form" class="form" role="form">
			<div class="form-group">
				<label for="exampleInputPassword1">Permissions</label>
				<select class="form-control" name="power" >
					<option>系统管理员</option>
					<option>网站管理员</option>
					<option>普通管理员</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Password</label>
				<input type="password" class="form-control" name="first_pass" placeholder="选填">
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password Confirm</label>
				<input type="password" class="form-control" name="verify_pass" placeholder="选填">
			</div>
			<div hidden>
				<input type="password" value="<?php echo $data['admin_uid']; ?>" name="uid">
				<input type="password" value="<?php echo $data['admin_user']; ?>"name="user">
			</div>
		</form>
	</div>
	
</div>
<!--<button type="button" class="btn btn-primary">
Primary
</button>-->
<!--
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<div class="checkbox">
<label>
<input type="checkbox" />
Remember me</label>
</div>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-default">
Sign in
</button>
</div>
</div>
-->
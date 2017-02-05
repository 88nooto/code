 <script src="http://cdn.bootcss.com/jquery/1.11.1/jquery.min.js"></script>
 <script src="assets/js/bootstrap.min.js"></script>
<script type="text/javascript">

$(function(){
		$("#import-b").click(function () {
            $.ajax({
                type: "post",
                url: "login",
                data: $("form").serialize(),
//              success: function (result) 
//              {
//              	$("#r_div").load("/admin/admin_data_ctrl/"+name,function()
//     				{
// 						alert("The last 25 entries in the feed have been loaded / "+name);
//      			});
//      		},
                //error: function (XMLHttpRequest, textStatus, errorThrown) {alert(XMLHttpRequest.responseText);}
            });
    	});
});
</script>

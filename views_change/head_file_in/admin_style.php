<head>
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet"> 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/assets/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/assets/js/bootstrap.min.js"></script>
    
    <script type="text/javascript">


    
    

    

$(function()
{
    $("li a").click(function()
    {
    	
        var name = $(this).attr("name");
        
       	$("#r_div").load("/admin/admin_data_ctrl/"+name,function()
       	{
   			//alert("The last 25 entries in the feed have been loaded / "+name);
        });
        

    });
    
    $("#r_div").load("/admin/admin_data_ctrl/menu",function()
    {
   			//alert("The last 25 entries in the feed have been loaded / "+name);
    });
	
		$("#import-b").click(function () 
	{
            $.ajax(
            {
                type: "post",
                url: "admin",
                data: $("form").serialize(),
                success: function (result) 
                {
                	$('html').load(result);
                }
                //error: function (XMLHttpRequest, textStatus, errorThrown) {alert(XMLHttpRequest.responseText);}
            });
    });
//$("#revise").click(function(){
//  var tr = $(this);
//
//  alert(tr.text());//这个输出的是tr的文本
//  //如果想要取到td需要再次遍历tr
//
//  var tds = tr.find("td");
//
//  tds.click(function(){
//      var td = $(this);
//      alert(td.text());//这个就是td的文本
//
//  });
//
//});




	
	
//	$.extend({get_page:function (var pages) {
//				var configObj = {
//				url: window.location.host+"/admin/admin_data_ctrl", //数据的提交路劲
//				type :"POST", //数据的提交方式：get和post
//				//async : false, //是否支持异步刷新，默认是true
//				//data : "menu",
//				//dataType : "xml", //服务器返回数据的类型，例如xml,String,Json等
//				success : function(data){ //请求成功后的回调函数
//					$("#r_div").html(data);
//					
//					},
//				error : function(){
//					$("#r_div").html('<h1>get error</h1>');
//					
//					}
//				}
//
//				$.ajax(configObj); //通过$.ajax函数进行调用。	
//  }});
	
	
});
    </script>
</head>


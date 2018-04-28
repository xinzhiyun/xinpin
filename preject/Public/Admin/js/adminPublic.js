//计算左边导航栏高度
	window.onload=function(){
		if($(".nav").height()<($("body").height()-70)){
			$(".nav").height($("body").height()-71);
		}else{
			$(".nav").height($(".tableBox").height());
		}
	}
	function getLocalTime(nS) {     
        return new Date(parseInt(nS) * 1000).toLocaleString().replace(/年|月/g, "-").replace(/日/g, " "); 
    }  
    // 字符串格式化
  	String.prototype.format = function(args) {
        var result = this;
        if (arguments.length > 0) {
            if (arguments.length == 1 && typeof (args) == "object") {
                for (var key in args) {
                    if(args[key]!=undefined){
                        var reg = new RegExp("({" + key + "})", "g");
                        result = result.replace(reg, args[key]);
                    }
                }
            }
            else {
                for (var i = 0; i < arguments.length; i++) {
                    if (arguments[i] != undefined) {
                        var reg= new RegExp("({)" + i + "(})", "g");
                        result = result.replace(reg, arguments[i]);
                    }
                }
            }
        }
        return result;
    }
    //layuiHint弹框提示封装
    function layuiHint(text){
        layui.use('layer', function(){
            var layer = layui.layer;
            layer.msg(text);
        });  
   }

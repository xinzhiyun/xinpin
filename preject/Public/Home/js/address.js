
// html模板
var div = document.createElement('div');
div.setAttribute('class','citys');
div.setAttribute('id', 'areaChoose');
var html =
    '<div class="areaChoosebg"></div>'+
    '<div class="areaDiv">'+
        '<div>'+
            '<span>省份</span>'+
            '<span>城市</span>'+
            '<span>区县</span>'+
        '</div>'+
        '<ul>'+
            '<li class="province">'+
            '<p></p>'+
            '</li>'+
            '<li class="city">'+
            '<p></p>'+
            '</li>'+
            '<li class="area">'+
            '<p></p>'+
            '</li>'+
        '</ul>'+
    '</div>';
div.innerHTML = html;
// 样式
var style = document.createElement('style');
var stylecode = '#areaChoose{width:100vw;height:100vh;display:none;position:fixed;top:0;left:0;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-flow:column;flex-flow:column;padding:0;border-bottom:0;z-index:1000}.areaChoosebg{width:100vw;height:40vh;background:rgba(0,0,0,.4)}.areaDiv{height:60vh;display:-webkit-box;display:-ms-flexbox;display:flex;-webkit-box-pack:center;-ms-flex-pack:center;justify-content:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;flex-flow:column;background:#fff}#confirmAreaChoose{height:14vh;width:100%;background:#fff}#confirmAreaChoose>div{width:80%;height:6vh;line-height:6vh;position:relative;top:0;left:0;right:0;bottom:0;margin:auto;text-align:center;color:#fff;border-radius:4px;background:#2eb6aa}.areaDiv>div{width:100%;height:12vmin;line-height:12vmin;border-bottom:1px solid #eee}.areaDiv>div::after{content:"";visibility:hidden;zoom:1;clear:both}.areaDiv>div>span{width:33%;float:left;text-align:center}.areaDiv>ul{width:80%;height:100%;display:-webkit-box;display:-ms-flexbox;display:flex;height:100%;overflow-y:hidden}.areaDiv>ul>li{flex:1;width:80%;height:100%;padding:1% 2%;margin:10px auto;border-radius:4px;background:#fff;overflow-y:scroll;-webkit-overflow-scrolling:touch;transform:translate3d(0,0,0)}';
style.innerHTML = stylecode;
// 添加到页面
window.addEventListener('DOMContentLoaded', function(){
    document.body.appendChild(div);
    document.head.appendChild(style);
    
})
var province_id,city_id,area_id;
function areaFn(callback){
    // 选择地区
    $(".areabtn").on("click", function(){
        $("#areaChoose").css({display: "block"});
    });

    // 获取地址数据
    function getAddress(parentid, callback){
        $.ajax({
            url: getAddressURL,
            type: 'post',
            data: {parentid: parentid},
            success: function(res){
                console.log('res: ',res);
                if(res.status == 200){
                     $("#areaChoose").css({display: "block"});
                    callback(res.data);	
                }else{
                    layuiHint(res.msg);
                }
            },
            error: function(err){
                console.log('err: ',err);
                layuiHint('获取地址失败，请稍后再试');
            }
        })
    }

    // 获取省份数据
    getAddress(0, function(res){
        if(res.length){
            var html = '';
            for(var i=0; i<res.length; i++){
                html += '<p aid='+ res[i].id +'>'+ res[i].areaname +'</p>';
            }
            $(".province").html(html);
        }
    });

    var province,city,area;
    // 选择省份，城市，区县
    $('.areaDiv').on('click', 'p', function(){
        var parent = $(this).parent()[0].className;
        var aid = $(this).attr('aid');	// 省份id
        var _this = $(this);
        console.log('parent: ',parent);

        // 根据省份id 获取城市数据
        getAddress(aid, function(res){
            if(parent == 'province'){
                province = _this.text();
                $('#province_name').val(province);
                province_id = _this.attr('aid');
                console.log('cityres: ',res);
                // 点击省份
                console.log('city: ');
                var cityhtml = '';
                for(var i=0; i<res.length; i++){
                    cityhtml += '<p aid='+ res[i].id +'>'+ res[i].areaname +'</p>';
                }
                $('.city').html(cityhtml);
                for(var j=0; j<$('.province>p').length; j++){
                    $('.province>p').eq(j).removeClass('addrselect');
                }
                _this.attr('class','addrselect');

            }else if(parent == 'city'){
                city = _this.text();
                 $('#city_name').val(city);
                city_id = _this.attr('aid');
                // 点击城市
                console.log('areares: ',res);
                var areahtml = '';
                for(var i=0; i<res.length; i++){
                    areahtml += '<p aid='+ res[i].id +'>'+ res[i].areaname +'</p>';
                }
                $('.area').html(areahtml);
                for(var j=0; j<$('.city>p').length; j++){
                    $('.city>p').eq(j).removeClass('addrselect');
                }
                _this.attr('class','addrselect');

            }else if(parent == 'area'){
                
                area = _this.text();
                 $('#area_name').val(area);
                area_id = _this.attr('aid');
                // 点击区县
//                  var _str = province+' '+city+' '+area;
//           
//              $('#pca').val(_str);
                console.log('area: ',_this);
                for(var j=0; j<$('.area>p').length; j++){
                    $('.area>p').eq(j).removeClass('addrselect');
                }
                _this.attr('class','addrselect');
                 
                areaover();
            }
            //设置所选的省市区
            $('#province').val(province_id);
              $('#city').val(city_id);
              $('#area').val(area_id);
              student.info.province = province_id;
               student.info.city = city_id;
                student.info.area = area_id;
                
//                 var _str =  $('#province_name').val()+' '+ $('#city_name').val()+' '+ $('#area_name').val();
//               //  console.log(_str);
//                // document.getElementById('pca').value=4444;
//              $('#pca').val(_str);
             // console.log(  student.info);
           
//            console.log('province,city,area: ',province,city,area);
//            console.log('province_id,city_id,area_id: ',province_id,city_id,area_id);
        })
    })

    // 选择完区县后自动消失
    function areaover(){
        if(!province){
            layuiHint('请选择省份');
            return
        }
        if(!city){
            layuiHint('请选择城市');
            return
        }
        if(!area){
            layuiHint('请选择区县');
            return
        }

        // 回调
        callback({
            province: province, 
            city: city,
            area: area
        })
        setTimeout(function(){
              var _str =  $('#province_name').val()+' '+ $('#city_name').val()+' '+ $('#area_name').val();
                console.log(_str);
                // document.getElementById('pca').value=4444;
              $('#pca').html(_str);
            $('#areaChoose').fadeOut('fast');
        },300);
    }

    // 关闭地址选择
    $('.areaChoosebg').click(function(){
        $('#areaChoose').fadeOut('fast');
    })
}
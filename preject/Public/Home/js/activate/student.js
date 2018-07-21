var student = new Vue({
    el: '.student',
    data() {
        return {
            // 提交的信息
            info: {
                name: '',
                parent: '',
                phone: '',
                address: '',
                addrdetail: '',
                schoolid: '',
                iccard: '',
                relation: '',
            },
            schoolList: [],     // 学校名单
            notetext: '',       // 条款
            accept: false,
        }
    },
    created() {
        var vm = this;
        vm.schoolList = [
            {id: 1, name:'深圳大学'},
            {id: 1, name:'广州大学'},
            {id: 1, name:'华南理工'},
            {id: 1, name:'暨南大学'},
        ];
        vm.notetext = '女事件的看法你收集东方那部手机电脑辐射，电脑辐射，短发女生，你的发生的骄傲i圣诞节偶爱五哦i恶业温热因为u人';
    },
    methods: {
        // 激活
        activate() {
            var vm = this;
            console.log('info: ',vm.info);
            // 验证输入
            vm.checkFn(function(){
                $.ajax({
                    url: activate,
                    type: 'post',
                    data: vm.info,
                    success: function(res){
                        console.log('res: ',res);
                    },
                    error: function(err){
                        console.log('err: ',err);
                    }
                })
            })
        },
        // 同意条款
        acceptFn(type) {
            var el = document.querySelector('.imgcheck');
            var val = el.getAttribute('value');
            if(type == 1){  // 勾选
                if(val == 0){   // 选中
                    this.accept = true;
                    el.setAttribute('value', 1);
                    el.setAttribute('src', el.getAttribute('check'));
                }else{  // 取消
                    this.accept = false;
                    el.setAttribute('value', 0);
                    el.setAttribute('src', el.getAttribute('none'));
                }

            }else if(type == 2){  // 条款确定
                this.accept = true;
                el.setAttribute('value', 1);
                el.setAttribute('src', el.getAttribute('check'));
            }
            $('.notePanel').fadeOut('fast');
        },
        // 查看条款
        note() {
            $('.notePanel').fadeIn('fast');
        },
        // 隐藏条款
        hidepanel() {
            $('.notePanel').fadeOut('fast');
        },
        // 验证函数
        checkFn(callback) {
            var vm = this;
            var info = vm.info;
            if(!info.name){
                layuiHint('请输入姓名');
                return;
            }
            if(!info.parent){
                layuiHint('请输入家长姓名');
                return;
            }
            if(!info.phone){
                layuiHint('请输入手机号码');
                return;
            }else{
                if(!/^1[34578]\d{9}$/.test(info.phone)){
                    layuiHint('手机号码格式不正确');
                    return
                }
            }
            if(!info.address){
                layuiHint('请选择学校地址');
                return;
            }
            if(!info.addrdetail){
                layuiHint('请输入学校详细地址');
                return;
            }

            if(info.schoolid == ''){
                layuiHint('请选择所在学校');
                return
            }
            if(!info.iccard){
                layuiHint('请输入IC卡号');
                return
            }else{
                if(!/^[0-9a-zA-Z]+$/.test(info.iccard)){
                    layuiHint('IC卡号只能是数字、字母');
                    return
                }
            }
            if(!info.relation){
                layuiHint('请输入您与持卡人的关系');
                return
            }
            if(!vm.accept){
                layuiHint('请同意条款后继续');
                return;
            }
            // 回调
            callback();
        },
        // 手机号失去焦点
        phoneChange() {
            if(!/^1[34578]\d{9}$/.test(this.info.phone)){
                $('.phone').css({border: '1px solid red'});
            }else{
                $('.phone').css({border: '1px solid #ddd'});
            }
        },
        // IC卡号失去焦点
        cardChange() {
            if(!/^[0-9a-zA-Z]+$/.test(this.info.iccard)){
                $('.iccard').css({border: '1px solid red'});
            }else{
                $('.iccard').css({border: '1px solid #ddd'});
            }
        }
    },
})
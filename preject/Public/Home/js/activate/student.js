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
                school: '',
                iccard: '',
                relation: '',
            },
        }
    },
    created() {
        var vm = this;
    },
    methods: {
        // 激活
        activate() {
            var vm = this;
            console.log('info: ',vm.info);
        }
    },
})
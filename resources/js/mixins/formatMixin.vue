<script>
    export default {
        methods: {
            formatPhone(number) {
                if(number != null){
                    var x = number.replace(/\D/g, '').match(/(\d{0,2})(\d{0,4})(\d{0,4})/);
                    return '(' + x[1] + ') ' + x[2] + '-' + x[3];
                }
            },
            formatCpf(number) {
                if(number != null){
                    var x = number.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
                    return x[1] + '.' + x[2] + '.' +  x[3] + '-' + x[4];
                }
            },
            formatCurrency(value, showCurrency = true) {
                if (value != null) {
                    return (showCurrency ? 'R$ ' : '')+(value / 100).toFixed(2).toString().replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, ".")
                }
            },
        },
    }
</script>
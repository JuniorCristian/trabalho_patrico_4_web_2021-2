<script>
    $(".grade").mask('00,0', {reverse:true}).on("keyup", function(e)
    {
        let code = (e.keyCode || e.which);

        if(code === 37 || code === 38 || code === 39 || code === 40 || code === 8) {
            return;
        }
        let num = Number(this.value.replace(",", "."));
        if (this.value.replace(",", "").length > 2) num = num * 100;
        let value = (num <= 10 ? num : 10);
        $(this).val(value.toFixed(1).replace(".", ","));
    });

</script>

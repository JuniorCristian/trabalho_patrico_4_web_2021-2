<script>
    $(document).ready(function (){
        $('.weighted').mask('000', {
            onKeyPress: function(val, e, field, options) {
                if (val > 100) {
                    field.val('100')
                }
            }
        });
    });
</script>

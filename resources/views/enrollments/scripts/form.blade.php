<script>
    $(document).ready(function (){
        $('.selectList').bootstrapDualListbox({
            nonSelectedListLabel: 'Não selecionado',
            selectedListLabel: 'Selecionado',
            moveOnSelect: false,
            iconsPrefix: 'fa',
            iconMove: 'fa-angle-right',
            iconRemove: 'fa-angle-left'
        });
        $(function() {
            var customSettings = $('.selectList').bootstrapDualListbox('getContainer');
            customSettings.find('.moveall i').removeClass().addClass('fa fa-angle-right');
            customSettings.find('.removeall i').removeClass().addClass('fa fa-angle-left');
            customSettings.find('.move i').removeClass().addClass('fa fa-angle-right');
            customSettings.find('.remove i').removeClass().addClass('fa fa-angle-left');
        });
    });
</script>

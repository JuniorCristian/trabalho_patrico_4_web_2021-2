<script>
    function reload() {
        dataTables.draw();
    }

    let dataTables = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,
        initComplete: function () {
        },
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.10.22/i18n/Portuguese-Brasil.json'
        },

        "pageLength": 10,
        fixedHeader: {
            header: true,
            footer: true
        },

        "ajax": {
            url: '{{route('student.datatable')}}',
            dataType: 'JSON',
            type: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader('Authorization');
            },
            data: function (d) {
                d._token = "{{csrf_token()}}"
            },
        },
        columns: [
            {data: 'ag', name: 'ag'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'course', name: 'course'},
            {data: 'born_date', name: 'born_date'},
            {data: 'entry_date', name: 'entry_date'},
            {data: 'actions', name: 'actions', searchable: false, orderable: false},
        ],
        "drawCallback": function () {
            $('[data-toggle="tooltip"]').tooltip()
        }
    });

    {{--function deleta() {--}}
    {{--    $('.deleta').off('click').click(function () {--}}
    {{--        id = $(this).data('id');--}}
    {{--        Swal.fire({--}}
    {{--            title: "Tem certeza que deseja deletar essa obra?",--}}
    {{--            text: "Uma vez deletada você irá perder todos os dados dela",--}}
    {{--            icon: "warning",--}}
    {{--            buttons: true,--}}
    {{--            dangerMode: true,--}}
    {{--        })--}}
    {{--            .then((willDelete) => {--}}
    {{--                if (willDelete.isConfirmed) {--}}
    {{--                    var form = $('<form action="obras/delete/'+ id +'" method="post">' +--}}
    {{--                        '<input type="hiden" name="_token" value="{{csrf_token()}}" />' +--}}
    {{--                        '<input type="hiden" name="_method" value="delete" />' +--}}
    {{--                        '<input type="hiden" name="obra" value="' + id + '" />' +--}}
    {{--                        '</form>');--}}
    {{--                    $('body').append(form);--}}
    {{--                    form.submit();--}}
    {{--                }--}}
    {{--            });--}}
    {{--    });--}}
    {{--}--}}
</script>

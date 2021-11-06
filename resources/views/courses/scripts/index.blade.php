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
            deleta();
        }
    });

    function deleta() {
        $('.deleta').off('click').click(function () {
            id = $(this).data('id');
            const deleteModal = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mr-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            deleteModal.fire({
                title: "Tem certeza que deseja excluir esse aluno?",
                text: "Uma vez excluído você irá perder todos os dados dele",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confimar',
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        var form = $('<form action="alunos/'+ id +'" method="post">' +
                            `@csrf` +
                            `@method('delete')` +
                            '</form>');
                        $('body').append(form);
                        form.submit();
                    }
                });
        });
    }
</script>

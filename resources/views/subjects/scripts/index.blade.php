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
            url: '{{ url(mix('datatable-pt_br.json')) }}'
        },

        "pageLength": 10,
        fixedHeader: {
            header: true,
            footer: true
        },

        "ajax": {
            url: '{{route('subject.datatable')}}',
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
            {data: 'id', name: 'id'},
            {data: 'course_unit', name: 'course_unit'},
            {data: 'term', name: 'term'},
            {data: 'teacher', name: 'teacher'},
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
                title: "Tem certeza que deseja excluir essa disciplina?",
                text: "Uma vez excluído você irá perder todos os dados dela",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confimar',
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        var form = $('<form action="disciplinas/'+ id +'" method="post">' +
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

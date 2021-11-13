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
            url: '{{route('enrollment.datatable')}}',
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
            {data: 'subject', name: 'subject'},
            {data: 'term', name: 'term'},
            {data: 'lock', name: 'lock', searchable: false, orderable: false},
        ],
        "drawCallback": function () {
            $('[data-toggle="tooltip"]').tooltip()
            lock();
        }
    });

    function lock() {
        $('.lock').off('click').click(function () {
            id = $(this).data('id');
            const deleteModal = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success mr-2',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });
            deleteModal.fire({
                title: "Aviso",
                text: "Tem certeza que deseja trancar essa disciplina?",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Confimar',
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        var form = $('<form action="{{ route('enrollment.lock') }}" method="post">' +
                            `@csrf` +
                            '<input type="hidden" name="id_subject" value="'+ id +'">'+
                            '</form>');
                        $('body').append(form);
                        form.submit();
                    }
                });
        });
    }
</script>

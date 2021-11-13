<script>
    function reload() {
        dataTables.draw();
    }

    let dataTables = $('#datatable').DataTable({
        "order": [[ 0, "asc" ]],
        rowsGroup: [0, 4],
        processing: true,
        serverSide: true,
        responsive: true,
        initComplete: function () {
        },
        language: {
            url: '{{ url(mix('datatable-pt_br.json')) }}'
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf'
        ],


        "pageLength": 10,
        fixedHeader: {
            header: true,
            footer: true
        },

        "ajax": {
            url: '{{route('grades.subject.datatable', $subject->id)}}',
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
            {data: 'student', name: 'student', orderable: false},
            {data: 'task', name: 'task', orderable: false},
            {data: 'weighted', name: 'weighted', orderable: false},
            {data: 'grade', name: 'grade', orderable: false},
            {data: 'average', name: 'average', orderable: false},
        ],
        "drawCallback": function () {
            $('[data-toggle="tooltip"]').tooltip()
        }
    });
</script>

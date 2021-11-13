<script>
    function reload() {
        dataTables.draw();
    }

    @foreach($subjects as $subject)
    let dataTables = $('#datatable{{$subject->id}}').DataTable({
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
            url: `{{route('grades.subject.datatable', ['subject'=>$subject])}}`,
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
            {data: 'name', name: 'name'},
            {data: 'weighted', name: 'weighted'},
            {data: 'value', name: 'value'}
        ],
        "drawCallback": function () {
            $('[data-toggle="tooltip"]').tooltip()
        }
    });
    @endforeach
</script>

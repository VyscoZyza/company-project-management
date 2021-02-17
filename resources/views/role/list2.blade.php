@extends('layouts.app')
@section('content')
<style type="text/css">
    .container {
        margin-top: 150px;
    }

    table.dataTable thead th {
        border-bottom: none;
    }

    .page-item.active .page-link {
        background-color: blue !important;
        border: none;
    }

    .page-link {
        color: blue !important;
    }

    table.dataTable.no-footer {
        border-bottom: 0 !important;
    }

    h4 {
        margin-bottom: 30px;
    }

    #example_filter input {
        border-radius: 100px;
    }

    .exit {
        background: #dc3545;
        border-top-left-radius: 5% 5%;
        border-bottom-left-radius: 5% 5%;
        border-top-right-radius: 5% 5%;
        border-bottom-right-radius: 5% 5%;
    }

    .mg {
        margin-left: 40px;
        margin-right: 40px;
        display: block;
    }

    .page-item.active .page-link {
        background-color: lightgrey !important;
        border: 1px #292f4c;
    }

    .page-link {
        color: #292f4c !important;
    }
</style>

<div class="col-sm-8" style="width: 100%">
    <table class="table table-hover data-table">
        <thead class="table-white">
            <tr>
                <th scope="col " style="width: 1%" class="text-center">No</th>
                <th scope="col" style="width: 40%;">Nama</t>
                <th scope="col" style="width: 20%;">Bagian</t>
                <th scope="col" class="text-center" style="width: 20%;">Jabatan</t>

            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>




<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            paging: true,
            info: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                    "targets": [0, 2, 3], // your case first column
                    "className": "text-center",

                },

            ],
            language: {
                paginate: {
                    next: '<span class="fas fa-arrow-right"></span>', // or '→'
                    previous: '<span class="fas fa-arrow-left"></span>' // or '←' 
                }
            },
            oLanguage: {
                "oPaginate": {
                    next: '&#8594;', // or '→'
                    previous: '&#8592;' // or '←' 
                },
                "sLengthMenu": "Tampilkan _MENU_ Item",
                "sEmptyTable": "Tidak ada data",
                "sInfoEmpty": "Tidak ditemukan",
                "sLoadingRecords": "Sedang memproses - loading...",
                "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ Item",
                "sSearch": "Cari:",
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('list2') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'bagian',
                    name: 'bagian'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'
                },

            ]
        });


    });
</script>


@endsection
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

    .bubble {
        margin-left: -15px;

    }

    .page-item.active .page-link {
        background-color: lightgrey !important;
        border: 1px #292f4c;
    }

    .page-link {
        color: #292f4c !important;
    }
</style>


<h3>Bagian {{Auth::user()->bagian}}</h3>
<div class="col-md-12">
    <table class="table table-hover data-table">
        <thead class="table-white">
            <tr>
                <th scope="col " style="width: 1%" class="text-center">No</th>
                <th scope="col" style="width: 30%">Bagian</th>

                <th scope="col" class="text-center" style="width: 5%">Total</th>
                <th scope="col" class="text-center" style="width: 5%">Selesai</th>
                <th scope="col" class="text-center" style="width: 5%">Belum Selesai</th>
                <th scope="col" class="text-center" style="width:1%">Action</th>
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
                    "targets": [0, 2, 3, 4, 5], // your case first column
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
            ajax: "{{ route('company.task') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'bagian',
                    name: 'bagian',
                    orderable: false,
                },

                {
                    data: 'total',
                    name: 'total',

                },
                {
                    data: 'selesai',
                    name: 'selesai',

                },
                {
                    data: 'belum',
                    name: 'belum',
                    orderable: false,
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                },

            ]
        });

    });
</script>


@endsection
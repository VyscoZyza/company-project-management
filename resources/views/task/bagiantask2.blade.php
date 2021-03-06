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


<h3 id="identifier"></h3>
<div class="col-md-12 text-right mb-1">
    <a class="btn blue text-white" href="javascript:history.back()" id=" createNewProduct"> Kembali</a>


</div>
<div class="col-md-12">
    <table class="table table-hover data-table">
        <thead class="table-white">
            <tr>
                <th scope="col " style="width: 1%" class="text-center">No</th>
                <th scope="col" style="width: 30%">Nama</th>
                <th scope="col" class="text-center" style="width: 10%">Personal Number</th>
                <th scope="col" class="text-center" style="width: 5%">Total</th>
                <th scope="col" class="text-center" style="width: 5%">Selesai</th>
                <th scope="col" class="text-center" style="width: 9%">Belum Selesai</th>
                <th scope="col" class="text-center" style="width: 5%">KPI</th>
                <th scope="col" class="text-center" style="width: 7%">Non-KPI</th>
                <th scope="col" class="text-center" style="width:1%">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>



<script type="text/javascript">
    $(function() {
        var initial_url = window.location.href;
        var url = initial_url.split('/');
        var bagian = url[url.length - 1];
        document.getElementById("identifier").innerHTML = "Bagian " + bagian;
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
                    "targets": [0, 2, 3, 4, 5, 6, 7, 8], // your case first column
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
            ajax: "/company-task/" + bagian,

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name',

                },
                {
                    data: 'user_id',
                    name: 'user_id',

                },


                {
                    data: 'selesai',
                    name: 'selesai',

                },
                {
                    data: 'belum',
                    name: 'belum',

                },
                {
                    data: 'total',
                    name: 'total',

                },
                {
                    data: 'kpi',
                    name: 'kpi',

                },
                {
                    data: 'non',
                    name: 'non',

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
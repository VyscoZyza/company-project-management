@extends('admin.app')
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
        margin-left: -2px;

    }
</style>


<h3>Selamat Datang Admin!</h3>
@if(Session::has('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ Session::get('error')}} <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div><br />
@endif

<div class="col-md-12 text-right mb-5">
    <a class="btn blue text-white" href="javascript:void(0)" id="createNewProduct"> Buat Pengguna Baru</a>


</div>
<div class="col-md-12">
    <table class="table table-hover data-table">
        <thead class="table-light">
            <tr>
                <th scope="col " style="width: 1%" class="text-center">No</th>
                <th scope="col">Nama</th>
                <th scope="col" class="text-center">Email</th>
                <th scope="col" style="width: 9%" class="text-center">Bidang</th>
                <th scope="col" style="width: 11%" class="text-center">Bagian</th>
                <th scope="col " style="width: 15%" class="text-center  justify-content-center">Supervisi</th>
                <th scope="col " style="width: 15%" class="text-center  justify-content-center">Jabatan</th>
                <th scope="col" style="width: 6%" class="text-center">Action</th>
                <th scope="col" class="text-center" style="display: none;">Password</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>


<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="productForm" name="productForm" class="form-horizontal">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Nama</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Nama" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bidang</label>
                        <div class="col-sm-12">
                            <div class="btn-group dropright">
                                <select class="form-control" id="bidang" name="bidang">
                                    <option value="-">-</option>
                                    <option value="Operasional">Operasional</option>
                                    <option value="Bisnis">Bisnis</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Bagian</label>
                        <div class="col-sm-12">
                            <div class="btn-group dropright">
                                <select class="form-control" id="bagian" name="bagian">
                                    <option value="-">-</option>
                                    <option value="IT">IT</option>
                                    <option value="Humas">Humas</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Supervisi</label>
                        <div class="col-sm-12">
                            <div class="btn-group dropright">
                                <select class="form-control" id="supervisi" name="supervisi">
                                    <option value="-">-</option>
                                    <option value="Software">Software</option>
                                    <option value="Hardware">Hardware</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Jabatan</label>
                        <div class="col-sm-12">
                            <div class="btn-group dropright">
                                <select class="form-control" id="jabatan" name="jabatan">
                                    <option value="-">-</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Supervisor">Supervisor</option>
                                    <option value="Kabag">Kabag</option>
                                    <option value="Vp">VP</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-12">
                            <input type="Password" class="form-control" id="password" name="password" placeholder="Password" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-xl-4 control-label">Konfirmasi&nbsp;Password</label>
                        <div class="col-sm-12">
                            <input type="Password" class="form-control" id="cpassword" name="cpassword" placeholder="Konfirmasi Password" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <br>

                        <div class="col text-center">
                            <button type="submit" class="btn blue center" id="saveBtn" value="create">Simpan</button>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="alert" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <div class="alert alert-danger bubble fade show">
                Password Tidak Valid
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            columnDefs: [{
                "targets": [0, 2, 3, 4, 5, 6], // your case first column
                "className": "text-center",
            }, ],
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
            ajax: "{{ route('admin.index') }}",

            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: false,
                },
                {
                    data: 'email',
                    name: 'email',
                    orderable: false,

                },
                {
                    data: 'bidang',
                    name: 'bidang'
                },

                {
                    data: 'bagian',
                    name: 'bagian'
                },
                {
                    data: 'supervisi',
                    name: 'supervisi'
                },
                {
                    data: 'jabatan',
                    name: 'jabatan'

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'password',
                    name: 'password',
                    orderable: false,
                    searchable: false,
                    visible: false,

                },

            ]
        });

        $('#createNewProduct').click(function() {

            $('#saveBtn').val("create-product");
            $('#id').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Buat Pengguna Baru");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editProduct', function() {

            var id = $(this).data('id');
            $.get("{{ route('admin.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit Task");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#bidang').val(data.bidang);
                $('#bagian').val(data.bagian);
                $('#supervisi').val(data.supervisi);
                $('#jabatan').val(data.jabatan);
                $('#password').val("");
                $('#cpassword').val("");
            })
        });

        $('body').on('click', '.detailProduct', function() {

            var id = $(this).data('id');
            $.get("{{ route('admin.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit Task");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#bidang').val(data.bidang);
                $('#bagian').val(data.bagian);
                $('#supervisi').val(data.supervisi);
                $('#jabatan').val(data.jabatan);

            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Mengirim..');

            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('admin.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#productForm').trigger("reset");
                    $('#alert').modal('hide');
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Simpan');
                    $('#alert').modal('show');
                }
            });
        });

        $('body').on('click', '.deleteProduct', function() {
            var id = $(this).data("id");
            var result = confirm("Yakin menghapus?");
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('admin.store') }}" + '/' + id,
                    success: function(data) {
                        table.draw();
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            } else {
                return false;
            }
        });

    });
</script>


@endsection
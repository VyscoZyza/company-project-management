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

    .page-item.active .page-link {
        background-color: lightgrey !important;
        border: 1px #292f4c;
    }

    .page-link {
        color: #292f4c !important;
    }
</style>
<h3>Staff</h3><br>
<div class="col-md-12">
    <table class="table table-hover data-table">
        <thead class="table-white">
            <tr>
                <th scope="col " style="width: 1%" class="text-center">No</th>
                <th scope="col" style="width: 20%">Nama</th>
                <th scope="col " style="width: 20%">Judul</th>
                <th scope="col" class="text-center" style="display:none">Deskripsi</th>
                <th scope="col " style="width: 20%">Progress</th>
                <th scope="col" style="width: 11%" class="text-center">Status</th>
                <th scope="col" style="width: 9%" class="text-center">Target</th>
                <th scope="col" style="width: 4%" class="text-center">Action</th>
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
                        <label for="name" class="col-sm-2 control-label">Judul</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Judul" value="" maxlength="50" required="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Deskripsi</label>
                        <div class="col-sm-12">
                            <textarea id="content" name="content" required="" placeholder="Deskripsi" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="range" name="progress" class="form-range" style="width: 80%" id="progress" value="0" min="0" max="100" step="10" oninput="this.nextElementSibling.value = this.value ">
                        <output id="progressVal" class="btn blue" style="color: #fff !important; text-decoration: none;">0</output>
                        <output class="btn  bubble blue" style="color: #fff !important; text-decoration: none;">%</output>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-12">
                            <div class="btn-group dropright">
                                <select class="form-control" id="status" name="status">
                                    <option value="Direncanakan">Direncanakan</option>
                                    <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                                    <option value="Ditunda">Ditunda</option>
                                    <option value="Terkendala">Terkendala</option>
                                    <option value="Dibatalkan">Dibatalkan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12 control-label">Target Selesai</label>
                        <div class="col-sm-12">
                            <div class="input-group date" data-target-input="nearest">
                                <input name="target_selesai" id="target_selesai" type="date">

                            </div>
                        </div>
                        <input type="hidden" id="user_id" name="user_id" value=" {{ Auth::user()->id }}">
                        <input type="hidden" id="name" name="name" value=" {{ Auth::user()->name }}">
                        <input type="hidden" id="jabatan" name="jabatan" value=" {{ Auth::user()->jabatan }}">
                        <input type="hidden" id="supervisi" name="supervisi" value=" {{ Auth::user()->supervisi }}">
                        <input type="hidden" id="bagian" name="bagian" value=" {{ Auth::user()->bagian }}">
                        <input type="hidden" id="bidang" name="bidang" value=" {{ Auth::user()->bidang }}">
                        <input type="hidden" id="tanggal_selesai" name="tanggal_selesai" value="">
                        <br>

                        <div class="col text-center">
                            <button type="submit" class="btn blue center" id="saveBtn" value="create">Simpan</button>
                        </div>

                </form>
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
            paging: true,
            info: true,
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                    "targets": [0, 3, 4, 5, 6, 7], // your case first column
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
                "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ Halaman",
                "sSearch": "Cari:",
            },
            processing: true,
            serverSide: true,
            ajax: "{{ route('staff') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                },
                {
                    data: 'name',
                    name: 'name',
                    orderable: false,
                },
                {
                    data: 'title',
                    name: 'title',
                    orderable: false,
                },
                {
                    data: 'content',
                    name: 'content',
                    orderable: false,
                    visible: false,

                },
                {
                    data: 'progress',
                    name: 'progress'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'target_selesai',
                    name: 'target_selesai',

                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('body').on('click', '.detailProduct', function() {
            document.getElementById('title').readOnly = true;
            document.getElementById('content').readOnly = true;
            document.getElementById('progress').disabled = true;
            document.getElementById('status').disabled = true;
            document.getElementById('target_selesai').readOnly = false;
            document.getElementById('saveBtn').style.visibility = 'hidden';
            var id = $(this).data('id');
            $.get("{{ route('home.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit Task");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#content').val(data.content);
                $('#progress').val(data.progress);
                $('#progressVal').val(data.progress);
                $('#status').val(data.status);
                $('#target_selesai').val(data.target_selesai);

            })
        });
    });
</script>


@endsection
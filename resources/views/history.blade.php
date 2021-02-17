@extends('layouts.app')

@section('content')
<!-- Content Wrapper. Contains page content -->

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Riwayat</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Timeline</li> -->
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">

        <!-- Timelime example  -->
        <div class="row">
            <div class="col-md-12">
                <!-- The time line -->
                <div class="timeline">
                    <!-- timeline time label -->

                    <!-- /.timeline-label -->
                    <!-- timeline item -->
                    <div>
                        <i class="fas fa-start"></i>
                        <div class="timeline-item" style="background-color: #292f4c">

                            <h3 class=" timeline-header text-white"><a>Present</a></h3>
                        </div>
                    </div>
                    @foreach ($posts as $post)
                    <div>
                        <i class="fas fa-clock text-white" style="background-color: #292f4c;"></i>
                        <div class="timeline-item">

                            <span class="time"><i class="fas fa-clock"></i>&nbsp{{ date("d M Y", strtotime($post->tanggal_selesai)) }}</span>
                            <h3 class="timeline-header"><a>{{ $post->name }}</a>&nbsp{{ $post->title }}</h3>

                            <div class="timeline-body ">
                                {{ $post->content }}
                            </div>
                            <!-- <div class="timeline-footer"> -->
                            <!-- <a class="btn btn-primary btn-sm "><span class="fas fa-pen"></span></a>
                                <a class="btn btn-danger btn-sm"><span class="fas fa-trash"></span></a> -->
                            <!-- </div> -->
                        </div>
                    </div>
                    @endforeach
                    <!-- END timeline item -->
                    <div>
                        <i class="fas fa-start bg-secondary"></i>
                        <div class="timeline-item" style="background-color: #292f4c">

                            <h3 class="timeline-header text-white"><a>Past</a></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- /.timeline -->

</section>
<!-- /.content -->
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('home.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'content',
                    name: 'content'
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
                    name: 'target_selesai'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        $('#createNewProduct').click(function() {
            $('#saveBtn').val("create-product");
            $('#id').val('');
            $('#productForm').trigger("reset");
            $('#modelHeading').html("Create New Product");
            $('#ajaxModel').modal('show');
        });

        $('body').on('click', '.editProduct', function() {
            var id = $(this).data('id');
            $.get("{{ route('home.index') }}" + '/' + id + '/edit', function(data) {
                $('#modelHeading').html("Edit Task");
                $('#saveBtn').val("edit-user");
                $('#ajaxModel').modal('show');
                $('#id').val(data.id);
                $('#title').val(data.title);
                $('#content').val(data.content);
                $('#progress').val(data.progress);
                if (+data.progress === 100) {
                    $('#status').val("Done");
                } else {
                    $('#status').val(data.status);
                }

                $('#target_selesai').val(data.target_selesai);
            })
        });

        $('#saveBtn').click(function(e) {
            e.preventDefault();
            $(this).html('Sending..');

            $.ajax({
                data: $('#productForm').serialize(),
                url: "{{ route('home.store') }}",
                type: "POST",
                dataType: 'json',
                success: function(data) {
                    $('#productForm').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.draw();
                },
                error: function(data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        $('body').on('click', '.deleteProduct', function() {
            var id = $(this).data("id");
            var result = confirm("Are You sure want to delete !");
            if (result) {
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('home.store') }}" + '/' + id,
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
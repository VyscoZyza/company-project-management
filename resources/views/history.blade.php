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
                            <h3 class="timeline-header"><a>{{ $post->name }}</a>&nbsp &nbsp{{ $post->title }}</h3>

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

@endsection
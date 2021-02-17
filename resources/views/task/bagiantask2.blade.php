@extends('layouts.app')
@section('content')



<h3>Task Saya</h3>
<div class="row mt-5 mb-5">

</div>


<table class="table table-hover data-table">
    <thead class="table-white">
        <tr>
            <th scope="col " style="width: 1%" class="text-center">No</th>
            <th scope="col" style="width: 40%">Nama</th>
            <th scope="col" style="width: 11%" class="text-center">Total</th>
            <th scope="col " style="width: 11%" class="text-center  justify-content-center">Selesai</th>
            <th scope="col" style="width: 11%" class="text-center">Belum Selesai</th>
            <th scope="col" style="width: 9%" class="text-center">Action</t>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $post)
        <?php
        $i = 0;
        ?>
        <tr>
            <td class="text-center">{{ ++$i }}</td>
            <td>{{ $post->name }}</td>
            <td class="text-center">{{ $post->total }}</td>
            <td class="text-center">{{ $post->selesai }}</td>
            <td class="text-center">{{ $post->belum }}</td>
            <td class="text-center">

                <a class="btn btn-success btn-sm" href="{{ route('detail.user', $post->user_id) }}"><span class="fas fa-eye"></span></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
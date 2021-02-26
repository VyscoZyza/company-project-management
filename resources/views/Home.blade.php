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


<h3>Selamat Datang {{ Auth::user()->name }} ! </h3>


@endsection
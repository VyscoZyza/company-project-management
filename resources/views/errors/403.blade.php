<!DOCTYPE html>
<html lang="id" dir="ltr">
<style type="text/css">
    .image {

        background-image: url("https://cdn.dribbble.com/users/2950423/screenshots/7191173/media/5e53ea26e1458bdb27fe61bea68516cd.png"), url("paper.gif");


    }

    .blue {
        background-color: #292f4c;
        color: white;
    }

    .bg {


        background-color: #00008B;
        background-repeat: no-repeat;
        background-size: cover;
    }

    .card {
        background: #f8f9fa;
        border-top-left-radius: 5% 5%;
        border-bottom-left-radius: 5% 5%;
        border-top-right-radius: 5% 5%;
        border-bottom-right-radius: 5% 5%;
    }

    .blue {
        color: whi;
        background-color: #00008B;
    }

    .img-wrapper {
        position: relative;
    }

    .img-responsive {
        display: block;
        width: 60%;
        height: auto;
        margin-left: auto;
        margin-right: auto;
    }

    .img-overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        text-align: center;
    }

    .img-overlay:before {
        content: ' ';
        display: block;
        /* adjust 'height' to position overlay content vertically */
        height: 70.5%;
    }

    .btn-responsive {
        /* matches 'btn-md' */
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.3333333;
        border-radius: 6px;
    }

    @media (max-width:760px) {

        /* matches 'btn-xs' */
        .btn-responsive {
            padding: 1px 5px;
            font-size: 12px;
            line-height: 1.5;
            border-radius: 3px;
        }
    }

    /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
</style>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!-- Title -->
    <title>Sorry, This Page Can&#39;t Be Accessed</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous" />
</head>


<body>
    <div class="img-wrapper">
        <img class="img-responsive" src="{{asset('error/403.png')}}">
        <div class="img-overlay">
            <a class="btn btn-xl blue" href="javascript:history.back()">Kembali</a>

        </div>
    </div>
</body>

</html>
@extends('layouts.pre')

@section('content')

<style>
    body {
        width: 100vw;
        height: 100vh;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-div {
        max-width: 430px;
        padding: 35px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
    }

    .logo {
        background-image: url("Logo.png");
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin: 0 auto;
    }

    /* label focus color */
    .input-field input:focus+label {
        color: #292f4c !important;
    }

    /* label underline focus color */
    .row .input-field input:focus {
        border-bottom: 1px #292f4c !important;
        box-shadow: 0 1px 0 0 #292f4c !important
    }

    .wid {
        width: 800px;
    }
</style>




<div class="login-div wid">

    <div class="row center-align">
        <h5>Login</h5>
        <h6>Silahkan Login</h6>
    </div>
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
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="row">
            <div class="input-field col s12 ">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="email_input">{{ __('Alamat Email') }}</label>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <label for="password_input">{{ __('Password') }}</label>

            </div>
        </div>
        <div class="row">
            <div class="input-field col s12">

                <input id="captcha" type="text" class="form-control " required name="captcha">
                <label for="captcha">Captcha</label>
            </div>
            <div class="form-group mt-2 mb-2 text-center">
                <div class="captcha">
                    <span>{!! captcha_img() !!}</span>
                    <button type="button" class="btn indigo darken-3" class="reload" style="color:#fff; font-size:15px;" id="reload">
                        &#x21bb;
                    </button>
                </div>
            </div>

        </div>
        <div class="row">

        </div>
        <div class="row"></div>
        <div class="row">
            <div class="col s6"><a href="#"></a></div>
            <button type="submit" class="waves-effect indigo darken-3 btn"><a class="text-white">{{ __('Login') }}</a></button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $('#reload').click(function() {
        $.ajax({
            type: 'GET',
            url: 'reload-captcha',
            success: function(data) {
                $(".captcha span").html(data.captcha);
            }
        });
    });
</script>
@endsection
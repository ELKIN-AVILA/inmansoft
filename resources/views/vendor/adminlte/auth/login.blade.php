@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Log in
@endsection

@section('content')
<body class="hold-transition login-page" style="background: rgb(2,0,36);background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(7,14,105,1) 31%, rgba(8,17,120,1) 38%, rgba(9,18,127,1) 39%, rgba(9,9,121,1) 47%, rgba(0,212,255,1) 100%);">
    <div id="app">
        <div class="login-box">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="login-box-body" style="border-radius:40px">
	
            <div class="login-logo">
                <a href="{{ url('/home') }}" style="color:#2f363c;"><b>INMANSOFT</b></a>
            </div><!-- /.login-logo -->
	    <img />
        <form action="{{ url('/login') }}" method="post">
	    
	   <input type="hidden" name="_token" value="{{ csrf_token() }}">
	   
	        <div class="form-group has-feedback">
                <input type="email" class="form-control" placeholder="{{ trans('adminlte_lang::message.email') }}" name="email"/>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="{{ trans('adminlte_lang::message.password') }}" name="password"/>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox" name="remember"> Recordar
                        </label>
                    </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" style="border-radius: 100px 100px 100px 100px;
                    -moz-border-radius: 100px 100px 100px 100px;-webkit-border-radius: 100px 100px 100px 100px;border: 0px solid #000000;">Ingresar</button>
                </div><!-- /.col -->
            </div>
        </form>


    </div><!-- /.login-box-body -->

    </div><!-- /.login-box -->
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });
        });
    </script>
</body>

@endsection

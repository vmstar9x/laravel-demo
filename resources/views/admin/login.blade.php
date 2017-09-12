<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel='stylesheet' type='text/css' href='{{ asset('css/bootstrap.css') }}' />
    <link rel='stylesheet' type='text/css' href='{{ asset('css/icons.css') }}' />
    <link rel='stylesheet' type='text/css' href='{{ asset('css/login.css') }}' />
    <link rel='stylesheet' type='text/css' href='{{ asset('css/stylesheet.css') }}' />
    <link rel='stylesheet' type='text/css' href='{{ asset('css/stylesheets.css') }}' />
</head>
<body>
    <div class="loginBox">
        <div class="loginHead">
            <img src="{{ asset('img/logo.png') }}" alt="NTQ Solution Admin Control Panel" title="NTQ Solution Admin Control Panel"/>
        </div>
        <form class="form-horizontal" action="{{ route('admin.postLogin') }}" method="POST">
            {!! csrf_field() !!}
            <input type="hidden" name="url_continue" value="{{ old('url', request('url')) }}"/>
            <div class="control-group">
                <label for="inputUsername">Username</label>
                <input type="text" id="inputUsername" name="username" value="{{ old('username') }}"/>
                @foreach ($errors->get('username') as $error)
                    <p id='notifyMessage'>{{ $error }}</p>
                @endforeach
            </div>
            <div class="control-group">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" name="password"/>
                @foreach ($errors->get('password') as $error)
                    <p id='notifyMessage'>{{ $error }}</p>
                @endforeach
            </div>
            <div class="control-group" style="margin-bottom: 5px;">
                <label class="checkbox"><input type="checkbox" name="remember"> Remember me</label>
            </div>
            <div class="control-group" style="margin-bottom: 5px;">
                <center><p id = 'notifyMessage'></p></center>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-block" name="btn-login">Login</button>
            </div>
        </form>

    </div>
</body>
</html>
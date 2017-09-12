<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <link rel='stylesheet' type='text/css' href='{{ asset('css/bootstrap.css') }}' />
        <link rel='stylesheet' type='text/css' href='{{ asset('css/icons.css') }}' />
        <link rel='stylesheet' type='text/css' href='{{ asset('css/login.css') }}' />
        <link rel='stylesheet' type='text/css' href='{{ asset('css/stylesheet.css') }}' />
        <link rel='stylesheet' type='text/css' href='{{ asset('css/stylesheets.css') }}' />
        <link rel='stylesheet' type='text/css' href='{{ asset('css/pagination.css') }}' />
        <script type='text/javascript' src='{{ asset('js/jquery-2.1.3.min.js') }}'></script>
        <script type='text/javascript' src='{{ asset('js/checkBox.js') }}'></script>
    </head>
    <body>
    <div class="header">
        <a class="logo" href="{{ route ('admin.home') }}">
            <img src="{{ asset('img/logo.png') }}" alt="NTQ Solution - Admin Control Panel" title="NTQ Solution - Admin Control Panel"/>
        </a>
    </div>

    <div class="menu">

        <div class="breadLine">
            <div class="arrow"></div>
            <div class="adminControl active">
                Hi, {{ session()->get('username') }}
            </div>
        </div>

        <div class="admin">
            <div class="image">
                <img src="{{ asset('upload/user') }}/{{ session()->get('user_img') }}" class="img-polaroid"/>
            </div>
            <ul class="control">
                <li><span class="icon-cog"></span> <a href="{{ route('admin.user.getEdit', session()->get('user_id') ) }}">Update Profile</a></li>
                <li><span class="icon-share-alt"></span> <a href="{{ route('admin.logout') }}">Logout</a></li>
            </ul>
        </div>

        <ul class="navigation">
            <li>
                <a href="{{ route('admin.category.index') }}">
                    <span class="isw-grid"></span><span class="text">Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.product.index') }}">
                    <span class="isw-list"></span><span class="text">Products</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.user.index') }}">
                    <span class="isw-user"></span><span class="text">Users</span>
                </a>
            </li>
        </ul>

    </div>
    <div class="content">@yield('Noi Dung')</div>
    </body>
</html>
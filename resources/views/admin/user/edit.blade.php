@extends('admin.layout.master')
@section('title')
    Sửa user
@endsection
@section('Noi Dung')
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.user.index') }}">List Users</a> <span class="divider">></span></li>
            <li class="active">Edit User</li>
        </ul>
    </div>

    <div class="workplace">
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Users Management</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.user.postEdit', $edit['user_id']) }}">
                        {!! csrf_field() !!}
                        <div class="row-form">
                            <div class="span3">Username:</div>
                            <div class="span9">
                                <input type="text" placeholder="some text value..." name="username" value="{{ $edit['username'] }}">
                                @foreach ($errors->get('username') as $error)
                                    <p id='notifyMessage'>{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <div class="span3">Email:</div>
                            <div class="span9">
                                <input type="text" placeholder="some text value..." name="email" value="{{ $edit['user_email'] }}"/>
                                @foreach ($errors->get('email') as $error)
                                    <p id='notifyMessage'>{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <div class="span3">Password:</div>
                            <div class="span9">
                                <input type="password" placeholder="some text value..." name="pass" value=""/>
                                @foreach ($errors->get('pass') as $error)
                                    <p id='notifyMessage'>{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <div class="span3">Upload Avatar:</div>
                            <div class="span9">
                                <img src="{{ asset('upload/user') }}/{{ $edit['user_img'] }}" alt="Old Image" width="50" height="50">
                                <input type="checkbox" name="checkdel">Delete
                                <br>
                                <input type="file" name="user_img">
                                @foreach ($errors->get('user_img') as $error)
                                    <p id='notifyMessage'>{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="status">
                                    {!! $stringStatus !!}
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <button class="btn btn-success" type="submit" name="btn-add">Button</button>
                            <div class="clear"></div>
                        </div>
                    </form>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="dr"><span></span></div>
    </div>
@endsection
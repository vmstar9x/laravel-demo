@extends('admin.layout.master')
@section('title')
    Danh sách users
@endsection
@section('username')
    Admin
@endsection
@section('Noi Dung')
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="">List Users</a></li>
        </ul>
    </div>
    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form method="GET" action="">
                    <input type="text" class="span11" placeholder="Some text for search..." name="search" value="{{ $search }}"/>
                    <button class="btn span1" type="submit" value="Search">Search</button>
                </form>
            </div>
        </div>
        <!-- /row-fluid-->
        @if(session('message'))
            <div class="alert alert-danger">{{ session('message') }}</div>
        @endif
        <div class="row-fluid">

            <div class="span12">
                <div class="head">

                    <div class="isw-grid"></div>
                    <h1>Users Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="{{ route('admin.user.getAdd') }}" class="btn btn-add">Add User</a>
                    <form action="{{ route('admin.user.postIndex') }}" method="POST">
                        {!! csrf_field() !!}
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">

                            <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <th width="5%" class="sorting"><a href="{{ $path[0] }}">ID</a></th>
                                <th width="40%" class="sorting"><a href="{{ $path[1] }}">Username</a></th>
                                <th width="20%" class="sorting"><a href="{{ $path[2] }}">Activate</a></th>
                                <th width="10%" class="sorting"><a href="{{ $path[3] }}">Time Created</a></th>
                                <th width="10%" class="sorting"><a href="{{ $path[4] }}">Time Updated</a></th>
                                <th width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td><input class="case" type="checkbox" value="{{ $user->user_id }}" name="checkbox[]"/></td>
                                    <td><a href="">{{ $user->user_id }}</a></td>
                                    <td>{{ $user->username }}</td>
                                    @if($user->status == 1)
                                        <td>
                                            <span class='text-success'>Activated</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class='text-error'>Deactive</span>
                                        </td>
                                    @endif
                                    <td>{{ $user->user_time_created }}</td>
                                    <td>{{ $user->user_time_updated }}</td>
                                    <td>
                                        <a href="{{ route('admin.user.getEdit', $user->user_id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('admin.user.delete', $user->user_id) }}" class="btn btn-danger" onClick="return ask()">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="bulk-action">
                            <input type="submit" class="btn btn-success" name="btn_ac" value="Activate">
                            <input type="submit" class="btn btn-danger" name="btn_dac" value="Deactive">
                        </div><!-- /bulk-action-->
                    </form>
                    <div class="dataTables_paginate">{{ $users->appends(['search' => $search,'field' => $field, 'sort' => $sort])->links() }}</div>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
        <div class="dr"><span></span></div>
    </div>
@endsection
@extends('admin.layout.master')
@section('title')
    Danh sách Categories
@endsection
@section('username')
    Admin
@endsection
@section('Noi Dung')
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="">List Categories</a></li>
        </ul>
    </div>
    <div class="workplace">

        <div class="row-fluid">
            <div class="span12 search">
                <form method="GET" action="">
                    <input type="text" class="span11" placeholder="Some text for search..." name="search" value="{{ $search }}"/>
                    <button class="btn span1" type="submit" name = "btn-search-category" value="Search">Search</button>
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
                    <h1>Categories Management</h1>

                    <div class="clear"></div>
                </div>
                <div class="block-fluid table-sorting">
                    <a href="{{ route('admin.category.getAdd') }}" class="btn btn-add">Add Category</a>
                    <form action="" method="POST">
                        {!! csrf_field() !!}
                        <table cellpadding="0" cellspacing="0" width="100%" class="table" id="tSortable_2">

                            <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll"/></th>
                                <th width="5%" class="sorting"><a href="{{ $path[0] }}">ID</a></th>
                                <th width="40%" class="sorting"><a href="{{ $path[1] }}">Category</a></th>
                                <th width="20%" class="sorting"><a href="{{ $path[2] }}">Activate</a></th>
                                <th width="10%" class="sorting"><a href="{{ $path[3] }}">Time Created</a></th>
                                <th width="10%" class="sorting"><a href="{{ $path[4] }}">Time Updated</a></th>
                                <th width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td><input class="case" type="checkbox" value="{{ $category->category_id }}" name="checkbox[]"/></td>
                                    <td><a href="">{{ $category->category_id }}</a></td>
                                    <td>{{ $category->category_name }}</td>
                                    @if($category->category_status == 1)
                                        <td>
                                            <span class='text-success'>Activated</span>
                                        </td>
                                    @else
                                        <td>
                                            <span class='text-error'>Deactive</span>
                                        </td>
                                    @endif

                                    <td>{{ $category->category_time_created }}</td>
                                    <td>{{ $category->category_time_updated }}</td>
                                    <td>
                                        <a href="{{ route('admin.category.getEdit', $category->category_id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('admin.category.delete', $category->category_id) }}" class="btn btn-danger" onClick="return ask()">Delete</a>
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
                    <div class="dataTables_paginate">{{ $categories->appends(['search' => $search,'field' => $field, 'sort' => $sort])->links() }}</div>
                    <div class="clear"></div>
                </div>
            </div>
        </div>
        <div class="dr"><span></span></div>
    </div>
@endsection
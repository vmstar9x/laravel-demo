@extends('admin.layout.master')
@section('title')
    Sửa Category
@endsection
@section('Noi Dung')
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="">List Categories</a> <span class="divider">></span></li>
            <li class="active">Edit Category</li>
        </ul>
    </div>

    <div class="workplace">
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Category Management</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.category.postEdit', $edit['category_id']) }}">
                        {!! csrf_field() !!}
                        <div class="row-form">
                            <div class="span3">Category Name:</div>
                            <div class="span9">
                                <input type="text" placeholder="some text value..." name="category_name" value="{{ $edit['category_name'] }}">
                                @foreach ($errors->get('category_name') as $error)
                                    <p id='notifyMessage'>{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="category_status">
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
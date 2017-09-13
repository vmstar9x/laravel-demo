@extends('admin.layout.master')
@section('title')
    Sửa sản phẩm
@endsection
@section('Noi Dung')
    <div class="breadLine">
        <ul class="breadcrumb">
            <li><a href="">List Products</a><span class="divider">></span></li>
            <li class="active">Edit Product</li>
        </ul>
    </div>

    <div class="workplace">
        <div class="row-fluid">
            <div class="span12 search">
                <form method="GET" action="">
                    <input type="text" class="span11" placeholder="Some text for search..." name="search" value=""/>
                    <button class="btn span1" type="submit" name = "btn-search-category" value="Search">Search</button>
                </form>
            </div>
        </div>
        @if(session('message'))
            <div class="alert alert-info">{{ session('message') }}</div>
        @endif
        <div class="row-fluid">
            <div class="span12">
                <div class="head">
                    <div class="isw-grid"></div>
                    <h1>Products Management</h1>
                    <div class="clear"></div>
                </div>
                <div class="block-fluid">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.product.postEdit', $edit->product_id) }}">
                        {!! csrf_field() !!}
                        <div class="row-form">
                            <div class="span3">Product name:</div>
                            <div class="span9">
                                <input type="text" placeholder="some text value..." name="product_name" value="{{ $edit->product_name }}"/>
                                @foreach ($errors->get('product_name') as $error)
                                    <p id='notifyMessage'>{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <div class="span3">Price:</div>
                            <div class="span9">
                                <input type="number" placeholder="some number value..." name="product_price" value="{{ $edit->product_price }}"/>
                                @foreach ($errors->get('product_price') as $error)
                                    <p id='notifyMessage'>{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <div class="span3">Description:</div>
                            <div class="span9">
                                <textarea name="product_description" id="" cols="30" rows="10" placeholder="some text value...">{{ $edit->product_description }}</textarea>
                                @foreach ($errors->get('product_description') as $error)
                                    <p id='notifyMessage'>{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="row-form">
                            <div class="span3">Upload Images:</div>
                            <div class="span9">
                                @foreach($images as $image)
                                    <img src="{{ asset('upload/product') }}/{{ $image['img_path'] }}" alt="Old Image" width="50" height="50">
                                    <input type="checkbox" value="{{ $image['img_id'] }}" name="checkdel[]">Delete
                                    <br>
                                @endforeach
                                <input type="file" name="product_img[]"><br/>
                                <input type="file" name="product_img[]"><br/>
                                <input type="file" name="product_img[]">
                                @foreach ($errors->get('product_img') as $error)
                                    <p id='notifyMessage'>{{ $error }}</p>
                                @endforeach
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="row-form">
                            <div class="span3">Activate:</div>
                            <div class="span9">
                                <select name="product_status">
                                    {!! $stringStatus !!}
                                </select>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="row-form">
                            <button class="btn btn-success" type="submit" name="">Button</button>
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
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>Tambah Produk</h2>
            <br>
            @if(count($errors))
            <div class="form-group">
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            </div>
            @endif

            <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input type="text" name="name" id="" class="form-control" placeholder="Nama Produk">
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="number" name="price" id="" class="form-control" placeholder="Harga">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="description" id="" class="form-control tinymce" placeholder="Deskripsi"></textarea>
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image_url" id="" class="form-control" placeholder="Image">
                </div>
                <div class="form-group">
                    <label for="">Video</label>
                    <input type="file" name="video_url" id="" class="form-control" placeholder="Video">
                </div>

                <a href="{{route('admin.products.index')}}" class="btn btn-sm btn-success">Kembali</a>
                <button class="btn btn-sm btn-primary float-right">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
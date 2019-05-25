@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>Ubah Produk</h2>
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
        
            @foreach($product as $p)
            <form action="/admin/products/update" method="post">
                {{csrf_field()}}

                <input type="hidden" name="id" value="{{$p->id}}">
                <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input type="text" name="name" id="" class="form-control" placeholder="Nama Produk" value="{{$p->name}}">
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="number" name="price" id="" class="form-control" placeholder="Harga" value="{{$p->price}}">
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="description" id="" rows="3" class="form-control tinymce" placeholder="Deskripsi">{{$p->description}}</textarea>
                </div>
                <!-- <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image_url" id="" class="form-control">
                </div> -->

                <a href="{{route('admin.products.index')}}" class="btn btn-sm btn-success">Kembali</a>
                <button class="btn btn-sm btn-primary float-right">Submit</button>
            </form>
            @endforeach
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <h2>Show Produk</h2>
            <br>
            
            @foreach($product as $p)
            <div class="form-group">
                    <label for="">Nama Produk</label>
                    <input type="text" name="name" id="" class="form-control" placeholder="Nama Produk" value="{{$p->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="">Harga</label>
                    <input type="number" name="price" id="" class="form-control" placeholder="Harga" readonly>
                </div>
                <div class="form-group">
                    <label for="">Deskripsi</label>
                    <textarea name="description" id="" rows="3" class="form-control" placeholder="Deskripsi" readonly>{{$p->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Dibuat Tanggal</label>
                    <input type="text" name="" id="" class="form-control" readonly value="{{date('d M Y', strtotime($p->created_at))}}">
                </div>
            @endforeach

            <a href="{{route('admin.products.index')}}" class="btn btn-sm btn-success">Kembali</a>
        </div>
    </div>
</div>
@endsection
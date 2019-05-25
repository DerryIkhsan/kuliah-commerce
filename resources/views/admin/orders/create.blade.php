@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <h2>Menambahkan Alamat</h2>

                <br>

                @if(count($errors))
                    <div class="form-group">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                <br>

                <form action="{{route('admin.orders.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Alamat Pengiriman</label>
                        <textarea name="shipping_address" id="" class="form-control" placeholder="Alamat Pengiriman"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Kode Pos</label>
                        <input type="number" name="zip_code" id="" class="form-control" placeholder="Kode Pos">
                    </div>
                    <button class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
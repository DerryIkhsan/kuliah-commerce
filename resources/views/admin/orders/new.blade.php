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

                <form>
                    @csrf
                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea name="address" id="" class="form-control" placeholder="Address"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Address Line 2</label>
                        <textarea name="address_line2" id="" class="form-control" placeholder="Address Line 2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">District</label>
                        <input type="text" name="district" id="" class="form-control" placeholder="District">
                    </div>
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" name="city" id="" class="form-control" placeholder="City">
                    </div>
                    <div class="form-group">
                        <label for="">Province</label>
                        <input type="text" name="province" id="" class="form-control" placeholder="Province">
                    </div>
                    <div class="form-group">
                        <label for="">Zip Code</label>
                        <input type="number" name="zip_code" id="" class="form-control" placeholder="Zip Code">
                    </div>
                    <div class="form-group">
                        <label for="">Phone Number</label>
                        <input type="number" name="phone" id="" class="form-control" placeholder="Phone Number">
                    </div>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
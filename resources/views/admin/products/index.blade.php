@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 mb-3">
            <h2>Product</h2>
            <a href="{{route('admin.products.create')}}" class="btn btn-primary">Tambah Produk</a>
        </div>

        <div class="col-md-4 offset-md-4">
            <div class="form-group">
                <select id="order_field" class="form-control">
                    <option value="" disabled selected>Urutkan</option>
                    <option value="best_seller">Best Seller</option>
                    <option value="terbaik">Terbaik</option>
                    <option value="termurah">Termurah</option>
                    <option value="termahal">Termahal</option>
                    <option value="terbaru">Terbaru</option>
                </select>
            </div>
        </div>
    </div>

        <div id="product-list">
            @foreach($products as $idx => $val)
                @if($idx == 0 || $idx % 4 == 0)
                    <div class="row mt-4">
                @endif

                <div class="col">
                    <img src="{{url('image/view/'.$val->image_url)}}" alt="" class="img-thumbnail" width="300">
                    <br>
                    <hr>
                    <video width="300" controls>
                        <source src="{{url('video/view/'.$val->video_url)}}" type="video/mp4">
                    </video>
                    <br>
                    {{$val->name}}
                    <br>
                    Rp. {{number_format($val->price, 0, ",", ".")}}
                    {!!html_entity_decode($val->description)!!}
                    <hr>

                    <a href="{{route('admin.products.edit', $val->id)}}" class="btn btn-sm btn-info text-white">Ubah</a>
                    |
                    <a href="{{route('admin.products.show', $val->id)}}" class="btn btn-sm btn-success text-white">Rinci</a>
                    |
                    <a href="/admin/products/destroy/{{$val->id}}" class="btn btn-sm btn-danger text-white">Hapus</a>
                </div>

                @if($idx > 0 && $idx %4 == 3)
                    </div>
                @endif
            @endforeach
        </div>
</div>

<!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
        //     function getUrlParameter(sParam) {
        //         var sPageURL = window.location.search.substring(1),
        //             sURLVariables = sPageURL.split('&'),
        //             sParameterName,
        //             i;
            
        //         for (i = 0; i < sURLVariables.length; i++) {
        //             sParameterName = sURLVariables[i].split('=');
                
        //             if (sParameterName[0] === sParam) {
        //                 return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        //             }
        //         }
        //     };
        
        //     $("#order_field option[value="+getUrlParameter('order_by')+"]").prop("selected", true);
        
            $('#order_field').change(function(){
                // window.location.href = window.location.pathname+'?order_by=' + $(this).val();
           
                $.ajax({
                    type: "GET",
                    url: "/admin/products",
                    data: {
                        order_by : $(this).val(),
                    },
                    dataType:'json',
                    success: function(data){
                        var products = '';

                        $.each(data, function(idx, product){
                            if(idx == 0 || idx % 4 == 0){
                                products += '<div class="row mt-4">';
                            }

                            products += 
                                '<div class="col">' +
                                    '<img src="/image/view/'+product.image_url+'" class="img-thumbnail" width="300">' +
                                    '<br>' +
                                    '<hr>' +
                                    '<video width="300" controls>' +
                                        '<source src="/video/view/'+product.video_url+'" type="video/mp4">' +
                                    '</video>' +
                                    '<br>' +
                                        product.name +
                                    '<br>' +
                                    'Rp. '+ product.price +
                                    product.description +
                                    '<hr>' +
                                    '<a href="/admin/products/'+product.id+'/edit" class="btn btn-sm btn-info text-white">Ubah</a>' +
                                    '|' +
                                    '<a href="/admin/products/'+product.id+'" class="btn btn-sm btn-success text-white">Rinci</a>' +
                                    '|' +
                                    '<a href="/admin/products/destroy/'+product.id+'" class="btn btn-sm btn-danger text-white">Hapus</a>' +
                                '</div>'
                            ;

                            if(idx > 0 && idx % 4 == 3){
                                products += '</div>';
                            }
                        });

                        //update element
                        $('#product-list').html(products);
                    },
                    error: function(data){
                        alert('Unable to handle request');
                    }
                });
            });
        });
    </script>
@endsection
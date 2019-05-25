@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-4 offset-md-8">
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
            @foreach($products as $idx => $product)
                @if($idx == 0 || $idx % 4 == 0)
                    <div class="row mt-4">
                @endif
                        <div class="col">
                            <div class="card">
                                <img src="{{route('products.image', ['imageName' => $product->image_url])}}" alt="" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{route('products.show', ['id' => $product->id])}}">
                                            {{$product->name}}
                                        </a>
                                    </h5>
                                    <p class="card-text">
                                        Rp. {{number_format($product->price, 0, ",", ".")}}
                                    </p>
                                    <a href="{{route('carts.add', ['id' => $product->id])}}" class="btn btn-primary">Beli</a>
                                </div>
                            </div>
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
            // function getUrlParameter(sParam) {
            //     var sPageURL = window.location.search.substring(1),
            //         sURLVariables = sPageURL.split('&'),
            //         sParameterName,
            //         i;

            //     for (i = 0; i < sURLVariables.length; i++) {
            //         sParameterName = sURLVariables[i].split('=');
                
            //         if (sParameterName[0] === sParam) {
            //             return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            //         }
            //     }
            // };

            // $("#order_field option[value="+getUrlParameter('order_by')+"]").prop("selected", true);

            $('#order_field').change(function(){
                // window.location.href = window.location.pathname+'?order_by=' + $(this).val();
                
                $.ajax({
                    type: "GET",
                    url : "/products",
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
                                '<div class="card">' +
                                    '<img src="/products/image/' +product.image_url+ '" class="card-img-top">' +
                                    '<div class="card-body">' +
                                        '<h5 class="card-title">' +
                                            '<a href="/products/' +product.id+ '">' +
                                                product.name +
                                            '</a>' +
                                        '</h5>' +
                                        '<p class="card-text">' +
                                            'Rp. '+ product.price +
                                        '</p>' +
                                        '<a href="/carts/add/' +product.id+ '" class="btn btn-primary">Beli</a>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';

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
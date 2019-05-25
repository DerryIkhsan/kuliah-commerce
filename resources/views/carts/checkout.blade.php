@extends('layouts.app')

@section('content')
    <div class="container">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th style="width:58%">Product</th>
                    <th style="width:18%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:22%" class="text-center">Subtotal</th>
                    <th style="width:18%"></th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0 ?>
                
                @if(session('cart'))
                @foreach(session('cart') as $id => $product)

                <?php $total += $product['price'] = $product['quantity'] ?>

                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-3 hiddex-xs">
                                <img src="{{url('image/view/'.$product['image_url'])}}" alt="" class="card-img-top">
                            </div>
                            <div class="col-sm-9">
                                <h4 class="nomargin">{{$product['name']}}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">{{$product['price']}}</td>
                    <td data-th="Quantity">
                        <input type="number" value="{{$product['quantity']}}" class="form-control quantity" readonly>
                    </td>
                    <td data-th="Subtotal" class="text-center">{{$product['price'] * $product['quantity']}}</td>
                    <td class="action" data-th="">
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr class="visible-xs">
                    <td class="text-center"><strong>Total ${{$total}}</strong></td>
                </tr>
                <tr>
                    <td>
                        <a href="#" class="btn btn-primary"><i class="fa fa-angle-left"></i> Bayar</a>
                    </td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>Total ${{$total}}</strong></td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
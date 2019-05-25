@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <img src="{{route('products.image', ['imageName' => $product['image_url']])}}" alt="" class="card-img-top">
            </div>

            <div class="col-md-9">

                <h3>{{$product->name}}</h3>

                <div class="star-rating mb-2" title="{{$rating->rating}}">
                    <div class="back-stars">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <i class="fa fa-star" aria-hidden="true"></i>
    
                        <div class="front-stars" style="width: {{($rating->rating / 5) * 100}}%">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <h3 class="text-secondary">{{$rating->rating}}<small>/5 ({{$review->review}} Reviews)</small></h3>
            
                <h4>Rp. {{number_format($product->price, 0, ",", ".")}}</h4>

                <div class="mt-4">
                    <a href="{{route('carts.add', ['id' => $product['id']])}}" class="btn btn-primary">Beli</a>
                </div>
                
                <div class="mt-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{route('products.show', ['id' => $product['id']])}}" class="social-button" target="_blank">Share Facebook</a>
                    |
                    <a href="https://twitter.com/intent/tweet?text=my share text&amp;url={{route('products.show', ['id' => $product['id']])}}" class="social-button" target="_blank">Share Twitter</a>
                    |
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{route('products.show', ['id' => $product['id']])}}" class="social-button" target="_blank">Share Linkedin</a>
                    |
                    <a href="https://wa.me/?text={{route('products.show', ['id' => $product['id']])}}" class="social-button" target="_blank">Share Whatsapp</a>
                </div>

                <div class="mt-4">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="#description" class="nav-link active" role="tab" data-toggle="tab">Deskripsi</a>
                        </li>
                        <li class="nav-item">
                            <a href="#review" class="nav-link" role="tab" data-toggle="tab">Review</a>
                        </li>
                    </ul>

                    <div class="tab-content mt-2">
                        <div role="tabpanel" class="tab-pane fade in active show" id="description">
                            {!! $product->description !!}
                        </div>
                        <div class="tab-pane fade" id="review">
                            <form action="{{route('products.update')}}" method="post">
                                {{csrf_field()}}
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="form-group">
                                    <label for="">Rating</label>
                                    <br>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rating" class="form-check-input" id="rating-1" value="1" required>
                                        <label for="rating-1" class="form-check-label">1</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rating" class="form-check-input" id="rating-2" value="2" required>
                                        <label for="rating-2" class="form-check-label">2</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rating" class="form-check-input" id="rating-3" value="3" required>
                                        <label for="rating-3" class="form-check-label">3</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rating" class="form-check-input" id="rating-4" value="4" required>
                                        <label for="rating-4" class="form-check-label">4</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" name="rating" class="form-check-input" id="rating-5" value="5" required>
                                        <label for="rating-5" class="form-check-label">5</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="description" id="" class="form-control tinymce" placeholder="Deskripsi"></textarea>
                                </div>

                                <button class="btn btn-sm btn-primary">Submit</button>
                            </form>

                            <br>

                            @foreach($reviews as $review)
                                    
                                <div class="row m-2">
                                    <div class="col-sm-12">
                                        <div class="card shadow-sm">
                                            <div class="card-body">
                                                <div class="col-sm-3 text-center">
                                                    <span class="float-left">
                                                        <img src="{{asset('/images/avatar5.png')}}" class="rounded-circle mx-auto" width="125" alt="">
                                                        <br>
                                                        <small class="text-secondary">
                                                            {!! Helper::time_since(strtotime($review->created_at)) !!} Ago
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="col-sm-9">
                                                    <span class="ml-3 float-left">
                                                        <div class="mb-3">
                                                            @if(empty($review->user_id))
                                                                <strong class="text-primary">Anonymous</strong>
                                                            @else
                                                                <strong class="text-primary">{{$review->name}}</strong>
                                                            @endif
                                                        </div>
    
                                                        {!! $review->review !!}
                                                    </span>
                                                </div>
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
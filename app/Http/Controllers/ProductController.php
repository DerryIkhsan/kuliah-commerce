<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Auth;
use Image;

class ProductController extends Controller
{
    //
    public function __construct(){
        date_default_timezone_set("Asia/Jakarta");
    }

    // public function index(){
    //     $products = Product::all();
    //     return view('products.index', compact('products'));
    // }

    public function index(Request $request){
        $productInstance = new Product();
        $products = $productInstance->orderProducts($request->get('order_by'));

        //apabila request ajax maka akan return json
        if($request->ajax()){
            return response()->json($products, 200);
        }

        return view('products.index', compact('products'));
    }

    public function show($id){
        $product = Product::find($id);
        $reviews = DB::table('product_reviews as pr')
            ->select('pr.user_id', 'pr.description as review', 'pr.created_at', 'u.name')
            ->leftJoin('users as u', 'u.id', '=', 'pr.user_id')
            ->join('products as p', 'p.id', '=', 'pr.product_id')
            ->where('pr.product_id', '=', $id)
            ->get()
            ->toArray();
        
        $rating = DB::table('product_reviews')
            ->select(DB::raw("IF(ROUND(AVG(rating), 1) IS NULL, 0, ROUND(AVG(rating), 1)) as rating"))
            ->where('product_id', '=', $id)
            ->get()
            ->first();
        
        $review = DB::table('product_reviews')
            ->select(DB::raw("COUNT(*) as review"))
            ->where('product_id', '=', $id)
            ->get()
            ->first();
        
        if($product){
            return view('products.show', compact('product', 'reviews', 'rating', 'review'));
        }
        else{
            return redirect('/products')->with('errors', 'Produk tidak ditemukan');
        }
    }

    public function update(Request $request){
        DB::table('product_reviews')
            ->insert([
                'user_id'       => Auth::check() ? Auth::user()->id : NULL,
                'product_id'    => $request->product_id,
                'rating'        => $request->rating,
                'description'   => $request->description,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s')
            ]);

        return redirect('products/'.$request->product_id);
    }

    public function image($imageName){
        $filePath = storage_path(env('PATH_IMAGE').$imageName);
        return Image::make($filePath)->response();
    }
}

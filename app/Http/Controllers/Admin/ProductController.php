<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Auth;
use Image;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     //
    //     $products = DB::table('products')->where('user_id', Auth::user()->id)->get();
    //     return view('admin.products.index', compact('products'));
    // }

    public function index(Request $request)
    {
        //
        $productInstance = new Product();
        $products = $productInstance->orderProductsAdmin($request->get('order_by'), Auth::user()->id);
        
        //apabila request ajax maka akan return json
        if($request->ajax()){
            return response()->json($products, 200);
        }

        return view('admin.products.index', compact('products'));
    }

    public function viewImage($fileImage){
        $filepath = storage_path(env('PATH_IMAGE').$fileImage);
        return Image::make($filepath)->response();
    }

    public function viewVideo($fileVideo){
        return response()->file(storage_path(env('PATH_VIDEO').$fileVideo), [
            'Content-Type'          => 'video/mp4',
            'Content-Disposition'   => 'inline; filename"Lesson-file"'
        ]);

        return false;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name'          => 'required|unique:products,name',
            'price'         => 'required|numeric',
            'description'   => 'required'
        ]);

        //
        $image                  = $request->file('image_url');
        $ext                    = $image->getClientOriginalExtension();
        $image_url              = 'image_'.date('Ymd_his').'.'.$ext;

        $image->move(storage_path(env('PATH_IMAGE')), $image_url);

        $video                  = $request->file('video_url');
        $ext                    = $video->getClientOriginalExtension();
        $video_url              = 'video_'.date('Ymd_his').'.'.$ext;

        $video->move(storage_path(env('PATH_VIDEO')), $video_url);

        $product                = new Product();
        $product->user_id       = Auth::user()->id;
        $product->name          = $request->post('name');
        $product->price         = $request->post('price');
        $product->description   = $request->post('description');
        $product->image_url     = $image_url;
        $product->video_url     = $video_url;
        $product->save();

        return redirect('admin/products')->with('success', 'Produk berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = DB::table('products')->where('id', $id)->get();

        return view('admin.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $product = DB::table('products')->where('id', $id)->where('user_id', Auth::user()->id)->get();

        return view('admin.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $this->validate(request(), [
            'name'          => 'required|unique:products,name,'.$request->post('id'),
            'price'         => 'required|numeric',
            'description'   => 'required'
        ]);

        DB::table('products')
            ->where('id', $request->post('id'))
            ->update([
                'name'          => $request->post('name'),
                'price'         => $request->post('price'),
                'description'   => $request->post('description')
            ]);

        return redirect('admin/products')->with('success', 'Produk berhasil di simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::table('products')->where('id', $id)->delete();

        return redirect('admin/products');
    }
}

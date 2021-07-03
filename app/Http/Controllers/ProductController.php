<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'products' => Product::get()
        ];
        return view('admin.product.product-list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => "Tambah Produk",
            'new' => true,
        ];
        return view('admin.product.product-form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create([
            'name' => request('name'),
            'price' => request('price'),
            'stock' => request('stock'),
            'description' => request('description'),
            'type' => request('type'),
        ]);

        return redirect()->route('admin-editImage', ['id' => $product->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        $data = [
            'title' => "Lihat Produk | ".$product->name,
            'product' => $product,
            'images' => $product->images,
            'id' => $product->id
        ];
        return view('admin.product.product-show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $data = [
            'title' => "Lihat Produk ".$product->name,
            'product' => $product,
            'id' => $product->id,
            'new' => false
        ];
        return view('admin.product.product-form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductStoreRequest $request, $id)
    {
        $product = Product::find($id);

        $product->name = request('name');
        $product->price = request('price');
        $product->stock = request('stock');
        $product->description = request('description');
        $product->type = request('type');
        $product->save();

        return redirect()->route('admin-showProduct',['id'=>$id])->with('success','Produk Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        foreach($product->images as $i){
            $file_path = public_path().'/files/images/'.$i->image;
            File::delete($file_path);
        }
        $product->delete();

        return redirect()->route('admin-product')->with('success','Produk Berhasil Dihapus');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ImageStoreRequest;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        if (!$id || !$product) {
            return view('notfound');
        } else {

            $data = [
                'title' => 'Gambar Produk ' . $product->name,
                'name' => $product->name,
                'images' => $product->images,
                'id' => $product->id,
            ];
            return view('admin.image.image-form', $data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ImageStoreRequest $request, $id)
    {
        if ($request->hasfile('image')) {
            $i = Product::find($id)->images->count();
            foreach ($request->file('image') as $file) {
                if ($i < 6) {
                    $name = time() . '-' . $file->getClientOriginalName();
                    $file->move(public_path() . '/files/images/', $name);
                    Image::create([
                        'product_id' => $id,
                        'image' => $name
                    ]);
                    $i++;
                }
            }
        }

        return back()->with('success', 'Gambar Berhasil Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);

        $file_path = public_path().'/files/images/'.$image->image;
        unlink($file_path);

        $image->delete();
        return back()->with('success', 'Gambar Berhasil Dihapus');
    }
}

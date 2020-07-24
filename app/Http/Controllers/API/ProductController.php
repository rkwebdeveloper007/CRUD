<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|string|max:191|unique:products',
            'price'=>'required',
            'desc'=>'required',
            'image'=>'required'
        ]);
        if($request->image){
            $name = str_slug($request->title).'.' . explode('/', explode(':',substr($request->image,0, strpos($request->image, ';')))[1])[1];
           \Image::make($request->image)->save(public_path('uploads/').$name);
        }
        return Product::create([
            'title'=>$request['title'],
            'price'=>$request['price'],
            'desc'=>$request['desc'],
            'image'=>$name
        ]);

        return response()->json(['uploaded']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $data = Product::where('slug', $slug)->first();
        return $data;       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}

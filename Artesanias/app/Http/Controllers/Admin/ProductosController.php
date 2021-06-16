<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\Product;
use File;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos=\DB::table('products')
            ->select('products.*')
            //->where('id','?') //syntax para where
            ->orderBy('id','DESC')
            ->get();
        return view('admin.productos') 
            ->with('productos',$datos);
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
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255|min:1',
            'price'=>'required|max:255|min:0|numeric',
            'price'=>'required|max:255|min:1',
            'stock'=>'required|max:255|min:1|numeric',
            'tags'=>'required|max:255|min:1',
            'img_product'=>'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorInsert','Favor de llenar todos los campos')
                ->withErrors($validator);
        }else{
            $imagen=$request->file('img_product');
            $nombre=time().'.'.$imagen->getClientOriginalExtension();
            $destino= public_path('img/productos');
            $request->img_product->move($destino, $nombre);
            $producto= Product::create([ 
                'name'=>$request->name,
                'price'=>$request->price, 
                'stock'=>$request->stock,
                'description'=>$request->description,
                'img_product'=>$nombre,
                'tags'=>$request->tags,
                'slug'=>''
            ]);
            $producto->save();
            return back()->with('Listo', 'Se ha agregado correctamente');
        }
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
    public function edit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'=>'required|max:255|min:1',
            'price'=>'required|max:255|min:0|numeric',
            'description'=>'required|max:255|min:1',
            'stock'=>'required|max:255|min:1|numeric',
            'tags'=>'required|max:255|min:1',
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorEdit','Favor de llenar todos los campos')
                ->withErrors($validator);
        }else{
            $prod = Product::find($request->id);
            $prod->name=$request->name;
            $prod->description=$request->description;
            $prod->price=$request->price;
            $prod->stock=$request->stock;
            $prod->tags=$request->tags;   
            $validator2=Validator::make($request ->all(),[
                'img_product'=>'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048'
            ]);
            if(!$validator2->fails()){
                $imagen=$request->file('img_product');
                $nombre=time().'.'.$imagen->getClientOriginalExtension();
                $destino= public_path('img/productos');
                $request->img_product->move($destino, $nombre);
                if(File::exists( public_path('img/productos/'.$prod->img_product))){
                    unlink( public_path('img/productos/'.$prod->img_product));
                }
                $prod->img_product=$nombre; 
            }
                $prod ->save();
                return back()->with('Listo', 'Se ha actualizado correctamente');
        }
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
        $producto = Product::find($id);
        if(File::exists( public_path('img/productos/'.$producto->img_product))){
            unlink( public_path('img/productos/'.$producto->img_product));
        }
        $producto->delete();
        return back()->with('Listo', 'Se ha borrado correctamente');
    }
}

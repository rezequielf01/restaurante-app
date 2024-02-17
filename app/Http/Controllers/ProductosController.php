<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nette\Utils\Html;

class ProductosController extends Controller
{

    public function show(){
        $productos = Productos::all();
        return view("admin.productos",compact("productos"));
    }

    public function crearProducto(){
        $categorias = Categorias::all();
        return view("admin.crear-producto",compact("categorias"));
    }

    public function showCategorias(){
        $categorias = Categorias::all();
        return view("admin.categorias",compact("categorias"));
    }
    
    public function crearCategoria(){
        return view("admin.crear-categoria");
    }

    public function subirCategoria(Request $request){

        //UPLOAD PRODUCT
        $icono = time().'.'.$request->icono->extension();
        $request->icono->move(public_path('productos'),$icono);

        $categoria = new Categorias();
        $categoria->nombre = ucfirst($request->nombre);
        $categoria->icono = $icono;

        $categoria->save();
        return back()->withSuccess('CATEGORIA AGREGADO EXITOSAMENTE!');
        
    }

    public function filtrarTodosLosProductos(){
        $productos = Productos::all();
        return response()->json($productos);
    }

    public function filtrarPorCategoria($categoria_id)
    {
        $productos = Productos::where('categoria_id', $categoria_id)->get();
     
        return response()->json($productos);
    }


    public function subirProducto(request $request){

        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'nullable',
            'precio'=>'required|numeric',
            'imagen'=>'required|mimes:jpeg,jpg,png',
            'categoria_id'=>'nullable',
            'stock'=>'nullable',
        ]);


        //UPLOAD PRODUCT
        $imageName = time().'.'.$request->imagen->extension();
        $request->imagen->move(public_path('productos'),$imageName);

        $producto = new Productos();
        $producto->imagen = $imageName;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = number_format($request->precio,0,',','.');
        $producto->categoria_id = $request->categoria;
        $producto->stock = $request->stock;

        $producto->save();
        return back()->withSuccess('PRODUCTO AGREGADO EXITOSAMENTE!');
        
    }

    public function edit($id){
        $producto = Productos::where("id",$id)->first();
        $categorias = Categorias::all();
        return view("admin.editar-producto",compact("producto","categorias"));
        dd($id);
    }

    public function update(Request $request, $id){
        
        $producto = Productos::where("id",$id)->first();
        
        if(isset($producto->imagen)){
            //UPLOAD PRODUCT
            $imageName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('productos'),$imageName);
            $producto->imagen = $imageName;
        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria;
        $producto->stock = $request->stock;

        $producto->save();
        return back()->withSuccess('PRODUCTO ACTUALIZADO EXITOSAMENTE!');
    }

    public function destroy($id){

        $producto = Productos::where("id",$id)->first();
        $producto->delete();
        return back()->withSuccess('PRODUCTO ELIMINADO CORRECTAMENTE!');

    }

    public function destroyCategoria($id){

        $categoria = Categorias::where("id",$id)->first();
        $categoria->delete();

        return back()->withSuccess('PRODUCTO ELIMINADO CORRECTAMENTE!');

    }
}

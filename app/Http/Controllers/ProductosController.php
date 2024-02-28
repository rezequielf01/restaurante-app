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
        $categorias = Categorias::all();
        
        return view("admin.productos",compact("productos","categorias"));
    }

    public function showCategorias(){
        $categorias = Categorias::all();
        return view("admin.categorias",compact("categorias"));
    }
    
    public function agregarATablaCategoria(){
        $categorias = Categorias::all();
        return response()->json($categorias);
    }

    public function verificarNombreProducto(Request $request)
    {
        $nombre = $request->input('nombre');
        
        // Busca un producto con el mismo nombre en la base de datos
        $productoExistente = Productos::where('nombre', $nombre)->exists();
        
        // Devuelve una respuesta JSON indicando si el nombre existe o no
        return response()->json(['existe' => $productoExistente]);
    }

    public function subirCategoria(Request $request){

        //UPLOAD PRODUCT
        $icono = time().'.'.$request->icono->extension();
        $request->icono->move(public_path('productos'),$icono);

        $categoria = new Categorias();
        $categoria->nombre = ucfirst($request->nombre);
        $categoria->icono = $icono;

        $categoria->save();
        
        return response()->json(['success' => '¡Categoria agregada correctamente!']);
        
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
        return response()->json(['message' => '¡Producto agregado correctamente!']);
        
    }

    public function edit($id){
        
        $producto = Productos::findOrFail($id);
        
        return response()->json($producto);
    }

    public function update(Request $request, $id) {
        $producto = Productos::findOrFail($id);
    
        $request->validate([
            'nombre'=>'nullable',
            'descripcion'=>'nullable',
            'precio'=>'nullable|numeric',
            'imagen'=>'nullable|mimes:jpeg,jpg,png',
            'categoria_id'=>'nullable',
            'stock'=>'nullable',
        ]);

        if (!$producto) {
            return response()->json(['message' => 'El producto no fue encontrado'], 404);
        }
    
        if ($request->hasFile('imagen')) {
            $imageName = time().'.'.$request->imagen->extension();
            $request->imagen->move(public_path('productos'), $imageName);
            $producto->imagen = $imageName;
        }
    
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria_id = $request->categoria;
        $producto->stock = $request->stock;
    
        $producto->save();
    
        return response()->json(['message' => '¡Producto actualizado correctamente!']);
    }

    public function eliminarProducto($id){

        $producto = Productos::where("id",$id)->first();
        $producto->delete();
        return response()->json(['message' => '¡Producto eliminado correctamente!']);

    }

    public function eliminarCategoria($id){

        $categoria = Categorias::where("id",$id)->first();
        $categoria->delete();

        return response()->json(['message' => '¡Categoria eliminada correctamente!']);


    }
}

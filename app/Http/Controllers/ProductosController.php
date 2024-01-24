<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Nette\Utils\Html;

class ProductosController extends Controller
{
    public function create(){
        return view("admin.crear-producto");
    }

    public function store(request $request){

        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'nullable',
            'precio'=>'required',
            'imagen'=>'required|mimes:jpeg,jpg,png',
            'categoria'=>'nullable',
            'stock'=>'nullable',
        ]);


        //UPLOAD PRODUCT
        $imageName = time().'.'.$request->imagen->extension();
        $request->imagen->move(public_path('productos'),$imageName);

        $producto = new Productos();
        $producto->imagen = $imageName;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->categoria = $request->categoria;
        $producto->stock = $request->stock;

        $producto->save();
        return back()->withSuccess('PRODUCTO AGREGADO EXITOSAMENTE!');
        
    }

    public function edit($id){
        $producto = Productos::where("id",$id)->first();
        return view("admin.editar-producto",compact("producto"));
        dd($id);
    }

    public function update(Request $request, $id){

        $request->validate([
            'nombre'=>'required',
            'descripcion'=>'required',
            'precio'=>'required',
            'imagen'=>'nullable|mimes:jpeg,jpg,png',
            'categoria'=>'required',
            'stock'=>'nullable',
        ]);
        
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
        $producto->categoria = $request->categoria;
        $producto->stock = $request->stock;

        $producto->save();
        return back()->withSuccess('PRODUCTO ACTUALIZADO EXITOSAMENTE!');
    }

    public function destroy($id){

        $producto = Productos::where("id",$id)->first();
        $producto->delete();

        return back()->withSuccess('PRODUCTO ELIMINADO CORRECTAMENTE!');

    }
}

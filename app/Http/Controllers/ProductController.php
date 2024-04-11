<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{

    public function index()
    {
        return Product::paginate();
    }

    public function store(StoreProductRequest $request)
    {
        // Crear un nuevo producto con los datos proporcionados
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->model = $request->model;
        $product->save();
    
        // Devolver una respuesta indicando que el producto se ha creado correctamente
        return response()->json(['message' => 'Producto creado correctamente'], 201);
    }

    public function show(StoreProductRequest $request)
    {
        $search = $request->all();
        
        $isUnique = count($search) > 1 ? false : true; //Verifico si la request tiene 1 sola key

        $message = $isUnique ? "Tengo un solo valor" : "Tengo varios valores";

/*         if($isUnique){
            $key = array_keys($search);

            $value = $search[$key];

            return $value;

        } */
        

        return $message;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}

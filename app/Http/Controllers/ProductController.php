<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

use function PHPUnit\Framework\returnSelf;

class ProductController extends Controller
{
    protected $validKeys = ['title', 'description', 'price', 'brand', 'model', 'img'];
    protected $columnsNumbers =6;

    public function index()
    {
        return Product::paginate();
    }

    public function store(StoreProductRequest $request)
    {

        $keys = $request->keys();

        if(($this->searchInvalidsKeys($keys)) !== null){
            $message = $this->searchInvalidsKeys($keys);
            return response()->json(['error' => $message]);
        }
        if(count($keys) < $this->columnsNumbers){
            return response()->json(['error' => 'Falta informacion']);
        }
        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->brand = $request->brand;
        $product->model = $request->model;
        $product->img = $request->img;
        $product->save();
    
        // Devolver una respuesta indicando que el producto se ha creado correctamente
        return response()->json(['message' => 'Producto creado correctamente'], 201);
    }
    
    public function search(StoreProductRequest $request)
    {
        $data = $request->all();

        $key = key($data);
        $value = $data[$key];

        $isValidKey = (!in_array($key, $this->validKeys)) ? false : true;
        $isUniqueKey = (count($data) > 1) ? false : true;
    
        if (!$isUniqueKey) {
            return response()->json(['error' => 'Ingrese solo una clave para buscar registros'], 400);
        }
    
        if (!$isValidKey){
            return response()->json(['error' => 'Ingrese una clave válida para buscar registros'], 400);
        }
    
        $products = Product::where($key, 'like', '%' . $value . '%')->get();
        return response()->json($products);
    }
    

    public function searchById($id){
        $product = Product::find($id);

        if(!$product){
            return response()->json(['error' => 'No se existe un producto con ese id']);
        }
        
        return response()->json($product);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $keys = $request->keys();

        if(($this->searchInvalidsKeys($keys)) !== null){
            $message = $this->searchInvalidsKeys($keys);
            return response()->json(['error' => $message]);
        }

        foreach ($keys as $key) {
            $updateProduct[$key] = $request->$key;
        }

        Product::find($id)->update($updateProduct);

        return response()->json(['message' => 'Producto '. $id. ' actualizado correctamente'], 201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::destroy($id);

        if(!$product){
            return response()->json(['error' => 'No se existe un producto con ese id']);
        }
        
        return response()->json(['message' => 'Producto '. $id. ' eliminado con exito']);
    }
}

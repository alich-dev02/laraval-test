<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * @return Product[]|Collection
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric'
            ]
        );

        return Product::create($validatedData);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (\Exception $exception) {
            return response()->json(['message' => "The requested product wasn't found"]);
        }

        return $product;
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|max:255',
                'description' => 'required',
                'price' => 'required|numeric'
            ]
        );

        try {
            $product = Product::findOrFail($id);
        } catch (\Exception $exception) {
            return response()->json(['message' => "The requested product wasn't found"]);
        }

        return $product->update($validatedData);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(['message'=>'Product Deleted Successfully.']);
    }
}

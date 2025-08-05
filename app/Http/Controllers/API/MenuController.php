<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\ProductResource;
use App\Http\Resources\MenuResource;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Menu::leftJoin('tb_m_product', function($join) {
                $join->on('tb_m_product_menu.UCODE_PRODUCT', '=', 'tb_m_product.UCODE_PRODUCT');
                })
            ->where('ISSHOW',1)->where('PARENTMENUID',0)->orderBy('BUTTONNUMBER', 'ASC')->paginate(10);
        return response()->json([
            'status' => true,
            'message' => 'get menu successfully',
            'data' => MenuResource::collection($products)
        ], 200);
    }
    
    public function all()
    {
        $products = Menu::leftJoin('tb_m_product', function($join) {
                $join->on('tb_m_product_menu.UCODE_PRODUCT', '=', 'tb_m_product.UCODE_PRODUCT');
                })
            ->where('ISSHOW',1)->where('ISPRODUCT',1)->orderBy('DISPLAYEDTEXT', 'ASC')->get();
        return response()->json([
            'status' => true,
            'message' => 'get menu successfully',
            'data' => MenuResource::collection($products)
        ], 200);
    }
    
    public function category($cat)
    {
        $products = Menu::leftJoin('tb_m_product', function($join) {
                $join->on('tb_m_product_menu.UCODE_PRODUCT', '=', 'tb_m_product.UCODE_PRODUCT');
                })
            ->where('ISSHOW',1)->where('ISPRODUCT',1)
            ->where('CATEGORY_NAME',$cat)->orderBy('DISPLAYEDTEXT', 'ASC')->get();
        return response()->json([
            'status' => true,
            'message' => 'get menu successfully',
            'data' => MenuResource::collection($products)
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $product = Product::create($data);
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $product->update($request->all());
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return new ProductResource($product);
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        //$products = Product::where('title', 'like', '%'.$title.'%')->get();
        //return ProductResource::collection($products);
        
        $products = Menu::leftJoin('tb_m_product', function($join) {
                $join->on('tb_m_product_menu.UCODE_PRODUCT', '=', 'tb_m_product.UCODE_PRODUCT');
                })
            ->where('ISSHOW',1)->where('ISPRODUCT',1)
            ->where('DISPLAYEDTEXT', 'like', '%'.$title.'%')
            ->orderBy('DISPLAYEDTEXT', 'ASC')->get();
        return response()->json([
            'status' => true,
            'message' => 'get menu successfully',
            'data' => MenuResource::collection($products)
        ], 200);
    }
}

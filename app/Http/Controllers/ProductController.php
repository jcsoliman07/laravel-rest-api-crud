<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductRepositoryInterface;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    use ApiResponse;

    /**
     * The product repository instance.
     *
     * @var ProductRepositoryInterface
     */

    private ProductRepositoryInterface $productRepositoryInterface;
    
    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepositoryInterface = $productRepositoryInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->productRepositoryInterface->getAllProducts();

        return $this->sendResponse(ProductResource::collection($data), 'Products retrieved successfully.'); 
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        //
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
           
            $product = $this->productRepositoryInterface->createProduct($validatedData);

            DB::commit();
            return $this->sendResponse(new ProductResource($product), 'Product created successfully.');

        } catch (\Exception $e) {

            return $this->rollback($e);

        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $product = $this->productRepositoryInterface->getProductById($id);
        
        if (!$product) {
            return $this->sendError('Product not found.');
        }

        return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
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
    public function update(UpdateProductRequest $request, $id)
    {
        //
        $validatedData = $request->validated();

        DB::beginTransaction();

        try{

            $updatedProduct = $this->productRepositoryInterface->updateProduct($id, $validatedData);

            if (!$updatedProduct) {

                DB::rollback();
                return $this->sendError('Product not found or not updated.');

            }

            DB::commit();

            return $this->sendResponse(new ProductResource($updatedProduct), 'Product updated successfully.');

        }catch(\Exception $e) {

            return $this->rollback($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();

        try {

            $deleted = $this->productRepositoryInterface->deleteProduct($id);

            if (!$deleted) {
                DB::rollback();
                return $this->sendError('Product not found or not deleted.');
            }

            DB::commit();

            return $this->sendResponse([], 'Product deleted successfully.');

        } catch (\Exception $e) {

            return $this->rollback($e);
        }

    }
}

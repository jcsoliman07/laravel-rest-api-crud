<?php

namespace App\Repositories;

use App\Interfaces\ProductRepositoryInterface;
use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProductById($id)
    {
        return Product::find($id);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }

    public function updateProduct($id, array $data)
    {
        $product = Product::find($id);

        if (!$product) {
            return null;
        }

        $product->update($data);
        
        return $product;
    }   

    public function deleteProduct($id)
    {
        return Product::destroy($id);
    }
}
{
    
}

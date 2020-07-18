<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 */

namespace App\Services\Impl;


use App\Repositories\ProductRepositoryInterface;
use App\Services\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    protected $productRepository;

    /**
     * ProductService constructor.
     * @param $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function addNewProduct(array $product)
    {
        return $this->productRepository->create($product);
    }

    public function findProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function deleteProductById($id)
    {
        return $this->productRepository->destroy($id);
    }

    public function getAllProducts()
    {
        return $this->productRepository->all();
    }

    public function getAllProductsSortedBy($sortField, $sortType = 'ASC')
    {
        return $this->productRepository->allSortBy($sortField, $sortType);
    }

    public function getAllProductsFilteredByCategory($category)
    {
        // TODO: Implement getAllProductsFilteredByCategory() method.
    }

}

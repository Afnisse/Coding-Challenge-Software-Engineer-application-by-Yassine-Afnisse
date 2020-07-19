<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 */

namespace App\Services\Impl;


use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Services\ProductServiceInterface;

class ProductService implements ProductServiceInterface
{
    protected $productRepository;
    protected $categoryRepository;

    /**
     * ProductService constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
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
        return $this->categoryRepository->allFilteredBy($category);
    }

    public function getAllProductsFilteredByCategoryAndSortedBy($category, $sortField, $sortType = 'ASC')
    {

        //dd([$category, $sortField, $sortType]);
        if ($category === null && ($sortField === null || $sortType === null)) {
            return $this->getAllProducts();
        }
        if ($category === null) {
            return $this->getAllProductsSortedBy($sortField, $sortType);
        }

        if ($sortField === null || $sortType === null) {
            //dd($this->getAllProductsFilteredByCategory($category));
            return $this->getAllProductsFilteredByCategory($category);
        }

        return $this->categoryRepository->allFilteredByCategoryNameAndSortedBy($category, $sortField, $sortType);
    }
}

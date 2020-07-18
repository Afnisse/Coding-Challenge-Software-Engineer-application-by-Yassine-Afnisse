<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 */

namespace App\Services;


interface ProductServiceInterface
{

    public function addNewProduct(array $product);

    public function findProductById($id);

    public function deleteProductById($id);

    public function getAllProducts();

    public function getAllProductsSortedBy($sortField, $sortType = 'ASC');

    public function getAllProductsFilteredByCategory($category);
}

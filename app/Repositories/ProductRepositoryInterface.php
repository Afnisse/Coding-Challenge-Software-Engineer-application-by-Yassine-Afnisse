<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 * Time: 17:54
 */

namespace App\Repositories;


use App\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface extends EloquentRepositoryInterface
{
    public function all(): Collection;

    public function store(array $product);

    public function destroy($id);

    public function allSortBy(string $sortField, string $sortType);

    public function allFilteredBy(string $category);

    public function allFilteredByAndSortBy(string $category, string $sortField, string $sortType);

}

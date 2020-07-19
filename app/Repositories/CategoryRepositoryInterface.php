<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 * Time: 17:55
 */

namespace App\Repositories;


interface CategoryRepositoryInterface extends EloquentRepositoryInterface
{

    public function allFilteredBy(string $category);

    public function allNamesDistinct();

    public function allFilteredByCategoryNameAndSortedBy($category, $sortField, string $sortType);

}

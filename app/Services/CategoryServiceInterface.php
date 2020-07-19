<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 */

namespace App\Services;


interface CategoryServiceInterface
{

    public function getAllCategories();

    public function addNewCategory(array $category);

    public function getCategoryById($id);

    public function deleteCategoryById($id);

    public function getCategoriesDistinct();

}

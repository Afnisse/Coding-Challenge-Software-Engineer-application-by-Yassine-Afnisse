<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 */

namespace App\Services\Impl;


use App\Repositories\CategoryRepositoryInterface;
use App\Services\CategoryServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class CategoryService
 * @package App\Services\Impl
 */
class CategoryService implements CategoryServiceInterface
{
    /**
     * @var CategoryRepositoryInterface
     */
    protected $categoryRepository;


    /**
     * CategoryService constructor.
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * @return Collection
     */
    public function getAllCategories() : Collection
    {
        return $this->categoryRepository->all();
    }

    /**
     * @param array $category
     * @return Model
     */
    public function addNewCategory(array $category)
    {
        return $this->categoryRepository->create($category);
    }

    /**
     * @param $id
     * @return Model
     */
    public function getCategoryById($id) : ?Model
    {
        return $this->categoryRepository->find($id);
    }

    /**
     * @param $id
     * @return int
     */
    public function deleteCategoryById($id) : int
    {
        return $this->categoryRepository->destroy($id);
    }
}

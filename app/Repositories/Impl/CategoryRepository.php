<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 * Time: 17:55
 */

namespace App\Repositories\Impl;


use App\Category;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    /**
     * CategoryRepository constructor.
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function allFilteredBy(string $category)
    {
        //dd($this->model->with('products')->where('name', '=', $category)->first()->products);
        return $this->model->where('name', '=', $category)->first()->products;
    }

    public function allNamesDistinct()
    {
        return $this->model->select('id', 'name')->distinct('name')->get();
    }

    public function allFilteredByCategoryNameAndSortedBy($category, $sortField, string $sortType)
    {
        return $this->model->where('name', '=', $category)->first()->products()->orderBy($sortField, $sortType)->get();
    }
}

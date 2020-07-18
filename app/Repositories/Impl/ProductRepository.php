<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 * Time: 17:58
 */

namespace App\Repositories\Eloquent;


use App\Product;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    /**
     * ProductRepository constructor.
     * @param Product $model
     */
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }
}

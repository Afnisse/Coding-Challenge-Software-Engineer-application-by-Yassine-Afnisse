<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/17/20
 * Time: 17:54
 */

namespace App\Repository;


use App\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface
{
    public function all(): Collection;

}

<?php

namespace ZnBundle\Article\Domain\Repositories\Eloquent;

use ZnBundle\Article\Domain\Entities\CategoryEntity;
use ZnBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use ZnCore\Db\Db\Base\BaseEloquentCrudRepository;

class CategoryRepository extends BaseEloquentCrudRepository implements CategoryRepositoryInterface
{

    protected $tableName = 'article_category';

    public function getEntityClass(): string
    {
        return CategoryEntity::class;
    }

}
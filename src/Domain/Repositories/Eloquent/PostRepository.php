<?php

namespace ZnBundle\Article\Domain\Repositories\Eloquent;

use ZnBundle\Article\Domain\Entities\PostEntity;
use ZnBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use ZnBundle\Article\Domain\Repositories\Relations\PostRelation;
use ZnCore\Domain\Interfaces\Repository\RelationConfigInterface;
use ZnLib\Db\Base\BaseEloquentCrudRepository;
use ZnLib\Db\Capsule\Manager;

class PostRepository extends BaseEloquentCrudRepository implements PostRepositoryInterface, RelationConfigInterface
{

    protected $tableName = 'article_post';
    private $relation;

    public function __construct(Manager $capsule, PostRelation $postRelation)
    {
        parent::__construct($capsule);
        $this->relation = $postRelation;
    }

    public function getEntityClass(): string
    {
        return PostEntity::class;
    }

    public function relations()
    {
        return $this->relation->relations();
    }

}
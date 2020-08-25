<?php

namespace PhpBundle\Article\Domain\Repositories\Eloquent;

use PhpBundle\Article\Domain\Entities\PostEntity;
use PhpBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use PhpBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use PhpBundle\Article\Domain\Repositories\Relations\PostRelation;
use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use PhpLab\Eloquent\Db\Helpers\Manager;

class PostRepository extends BaseEloquentCrudRepository implements PostRepositoryInterface
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
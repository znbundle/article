<?php

namespace ZnBundle\Article\Domain\Repositories\Doctrine;

use Doctrine\DBAL\Connection;
use ZnBundle\Article\Domain\Entities\PostEntity;
use ZnBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use ZnBundle\Article\Domain\Repositories\Relations\PostRelation;
use ZnCore\Domain\Interfaces\Repository\RelationConfigInterface;
use ZnDatabase\Eloquent\Domain\Base\BaseDoctrineCrudRepository;

class PostRepository extends BaseDoctrineCrudRepository implements PostRepositoryInterface, RelationConfigInterface
{

    protected $tableName = 'article_post';
    private $categoryRepository;
    private $tagPostRepository;
    private $tagRepository;

    private $relation;

    public function __construct(Connection $capsule, PostRelation $postRelation)
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
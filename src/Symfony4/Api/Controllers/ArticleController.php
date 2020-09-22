<?php

namespace ZnBundle\Article\Symfony4\Api\Controllers;

use ZnBundle\Article\Domain\Interfaces\PostServiceInterface;
use ZnLib\Rest\Base\BaseCrudApiController;

class ArticleController extends BaseCrudApiController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->service = $postService;
    }

}

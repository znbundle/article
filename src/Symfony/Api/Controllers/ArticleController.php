<?php

namespace ZnBundle\Article\Symfony\Api\Controllers;

use ZnLib\Rest\Base\BaseCrudApiController;
use ZnBundle\Article\Domain\Interfaces\PostServiceInterface;

class ArticleController extends BaseCrudApiController
{

    public function __construct(PostServiceInterface $postService)
    {
        $this->service = $postService;
    }

}

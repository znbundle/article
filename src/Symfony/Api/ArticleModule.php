<?php

namespace ZnBundle\Article\Symfony\Api;

use Doctrine\DBAL\Connection;
use Illuminate\Database\Capsule\Manager as CapsuleManager;
use ZnBundle\Article\Domain\Interfaces\CategoryRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\PostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\PostServiceInterface;
use ZnBundle\Article\Domain\Interfaces\TagPostRepositoryInterface;
use ZnBundle\Article\Domain\Interfaces\TagRepositoryInterface;
use ZnBundle\Article\Domain\Repositories\Doctrine\PostRepository;
use ZnBundle\Article\Domain\Repositories\Eloquent\CategoryRepository;
use ZnBundle\Article\Domain\Repositories\Eloquent\TagPostRepository;
use ZnBundle\Article\Domain\Repositories\Eloquent\TagRepository;
use ZnBundle\Article\Domain\Services\PostService;
use ZnBundle\Article\Symfony\Api\Controllers\ArticleController;
use ZnCore\Db\Db\Helpers\DoctrineHelper;
use ZnCore\Db\Db\Helpers\Manager;
use ZnLib\Rest\Helpers\RestApiRouteHelper;
use Psr\Container\ContainerInterface;
use Symfony\Component\Routing\RouteCollection;

class ArticleModule
{

    public function getRouteCollection(RouteCollection $routeCollection)
    {
        RestApiRouteHelper::defineCrudRoutes('v1/article-post', ArticleController::class, $routeCollection);
    }

    public function bindContainer(ContainerInterface $container)
    {
        $container->bind(CapsuleManager::class, Manager::class);
        $container->bind(Connection::class, function () {
            return DoctrineHelper::createConnection();
        });
        $container->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $container->bind(TagRepositoryInterface::class, TagRepository::class, true);
        $container->bind(TagPostRepositoryInterface::class, TagPostRepository::class);
        $container->bind(PostRepositoryInterface::class, PostRepository::class);
        $container->bind(PostServiceInterface::class, PostService::class);
    }

}

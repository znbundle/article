<?php

namespace ZnBundle\Article\Symfony\Web\Controllers;

use ZnCore\Base\Domain\Entities\DataProviderEntity;
use ZnCore\Base\Domain\Helpers\QueryHelper;
use ZnCore\Base\Domain\Libs\DataProvider;
use ZnCore\Base\Domain\Libs\Query;
use ZnCore\Base\Legacy\Yii\Helpers\ArrayHelper;
use ZnLib\Rest\Web\Controller\BaseCrudWebController;
use ZnBundle\Article\Domain\Interfaces\PostServiceInterface;
use ZnBundle\Notify\Domain\Enums\FlashMessageTypeEnum;
use ZnBundle\Notify\Domain\Interfaces\Services\FlashServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{

    private $service;
    private $flashService;

    public function __construct(PostServiceInterface $postService, FlashServiceInterface $flashService)
    {
        $this->service = $postService;
        $this->flashService = $flashService;
    }

    public function index(Request $request): Response
    {
        $query = QueryHelper::getAllParams($request->query->all());
        $query->with('category');

        $page = $request->get("page", 1);
        $pageSize = $request->get("per-page", 10);
        $dataProvider = new DataProvider($this->service, $query, $page, $pageSize);

        return $this->render('@Article/post/index.html.twig', [
            'dataProviderEntity' => $dataProvider->getAll(),
        ]);
    }

    public function view($id, Request $request): Response
    {
        $query = new Query;
        $query->with('category');
        $entity = $this->service->oneById($id, $query);
        return $this->render('@Article/post/view.html.twig', [
            'post' => $entity,
        ]);
    }

    public function create(Request $request): Response
    {
        return $this->render('@Article/post/create.html.twig');
    }

    public function update($id, Request $request): Response
    {
        $query = new Query;
        $query->with('category');
        $entity = $this->service->oneById($id, $query);
        return $this->render('@Article/post/update.html.twig', [
            'post' => $entity,
        ]);
    }

    public function delete($id, Request $request): Response
    {
        $this->service->deleteById($id);
        $postListUrl = $this->generateUrl('web_article_post_index');
        $this->flashService->addSuccess('Post deleted!');
        return $this->redirect($postListUrl);
    }

}

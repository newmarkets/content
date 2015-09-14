<?php

namespace NewMarket\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use NewMarket\Content\Facades\Article;
use NewMarket\Content\Facades\Category;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

abstract class Controller extends BaseController
{
    use DispatchesJobs, ValidatesRequests;
    /**
     * @var \NewMarket\Content\Models\Category
     */
    protected $category;
    /**
     * @var \NewMarket\Content\Models\Article
     */
    protected $article;
    /**
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Instantiate a new instance.
     *
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Get the current category based on the URL
     *
     * @throws Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    protected function getCategory()
    {

        $path = $this->request->segment(1);
        $this->category = Category::findPublicCategory($path);

        if (!$this->category) {
            throw new NotFoundHttpException('Category not found.');
        }
        return $this->category;

    }

    protected function getArticle()
    {

        if ($this->category) {
            $art = $this->request->route('article');
            if (Auth::check()) {
                $this->article = Article::findAdminArticle($this->category->id, $art);
            } else {
                $this->article = Article::findPublicArticle($this->category->id, $art);
            }
        }

    }
}

<?php

namespace NewMarket\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use NewMarket\Content\Facades\Article;
use NewMarket\Content\Facades\Category;

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

    protected function getCategory()
    {

        $path = $this->request->segment(1);
        $this->category = Category::findPublicCategory($path);

    }

    protected function getArticle()
    {

        if ($this->category) {
            $art = $this->request->route('article');
            $this->article = Article::findPublicArticle($this->category->id, $art);
        }

    }
}

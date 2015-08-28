<?php

namespace NewMarket\Content\Http\Controllers;

use Illuminate\Http\Request;
use NewMarket\Content\Http\Controllers\Controller;
use NewMarket\Content\Facades\Article;
use NewMarket\Content\Facades\Category;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContentController extends Controller
{
    /**
     * @var \NewMarket\Content\Models\Category
     */
    protected $category;

    /**
     * @var \NewMarket\Content\Models\Article
     */
    protected $article;

    /**
     * List all the available categories.
     * @param Request $request
     * @return string
     */
    public function showCategories(Request $request)
    {

        $latest = Config('content.show_latest');
        if ($latest) {
            return $this->showLatest($request);
        }

        return 'List of categories';
    }

    /**
     * Preview the most recent articles from any category.
     * @param Request $request
     * @return string
     */
    public function showLatest(Request $request)
    {
        return 'Most recent articles';
    }

    /**
     * Display a list of articles in a category.
     * @param Request $request
     * @return string
     */
    public function showCategory(Request $request)
    {

        $view = 'newmarkets\content::index';

        if (Config('content.show_category_latest')) {
            $view = 'newmarkets\content::magazine';
        }

        $this->getCategory($request);
        if($this->category) {

            $articles = Article::listPublicFromCategory($this->category->id);
            return view($view, [
                'category' => $this->category,
                'articles' => $articles
            ]);
        }
        throw new NotFoundHttpException;

    }

    /**
     * Show the full text of a single article.
     * @param Request $request
     * @return string
     */
    public function showArticle(Request $request)
    {

        $this->getCategory($request);
        if ($this->category) {

            $this->getArticle($request, $this->category->id);
            if ($this->article) {

                return view('newmarkets\content::article', [
                    'category' => $this->category,
                    'article' => $this->article,
                    'tags' => []
                ]);
            }
        }
        throw new NotFoundHttpException;

    }

    protected function getCategory(Request $request)
    {

        $path = $request->segment(1);
        $this->category = Category::findPublicCategory($path);

    }

    protected function getArticle(Request $request)
    {

        if ($this->category) {
            $art = $request->route('article');
            $this->article = Article::findPublicArticle($this->category->id, $art);
        }

    }

    protected function validateCategory($category)
    {

    }
}

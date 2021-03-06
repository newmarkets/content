<?php

namespace NewMarket\Content\Http\Controllers;

use Article;
use Cms;
use Illuminate\Http\Request;
use NewMarket\Content\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContentController extends Controller
{

    /**
     * List all the available categories.
     * @return string
     */
    public function showCategories()
    {

        $latest = Config('content.show_latest');
        if ($latest) {
            return $this->showLatest();
        }

        // @todo: list categories
        return 'List of categories';
    }

    /**
     * Preview the most recent articles from any category.
     * @return string
     */
    public function showLatest()
    {
        // @todo: show recent articles from all categories
        return 'Most recent articles';
    }

    /**
     * Display a list of articles in a category.
     * @return string
     */
    public function showCategory()
    {

        $cms = Cms::newInstance();
        $view = 'newmarkets\content::index';

        if (Config('content.show_category_latest')) {
            $view = 'newmarkets\content::magazine';
        }

        $category = $this->getCategory();

        $articles = Article::listFromCategoryPublic($this->category->id);

        return view($view, compact('cms', 'category', 'articles'));

    }

    /**
     * Show the full text of a single article.
     * @return string
     */
    public function showArticle()
    {
        $cms = Cms::newInstance();

        $this->getCategory();

        $this->getArticle();

        if ($this->article) {

            return view('newmarkets\content::article', [
                'cms' => $cms,
                'category' => $this->category,
                'article' => $this->article,
                'tags' => []
            ]);
        }

        throw new NotFoundHttpException;

    }
}

<?php

namespace NewMarket\Content\Http\Controllers;

use Illuminate\Http\Request;

//use NewMarket\Http\Requests;
use NewMarket\Content\Http\Controllers\Controller;
use NewMarket\Content\Facades\Article;
use NewMarket\Content\Facades\Category;

class ContentController extends Controller
{
    /**
     * List all the available categories.
     * @param Request $request
     * @return string
     */
    public function showCategories(Request $request) {

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
    public function showLatest(Request $request) {
        return 'Most recent articles';
    }

    /**
     * Display a list of articles in a category.
     * @param Request $request
     * @return string
     */
    public function showCategory(Request $request) {

        $latest = Config('content.show_category_latest');
        if ($latest) {
            return $this->showCategoryLatest($request);
        }

        return 'List of articles';
    }

    /**
     * Preview the most recent articles in this category.
     * @param Request $request
     * @return string
     */
    public function showCategoryLatest(Request $request) {
        return 'Preview articles in category';
    }

    /**
     * Show the full text of a single article.
     * @param Request $request
     * @return string
     */
    public function showArticle(Request $request) {

        $path = $request->segment(1);
        $cat = $request->route('category');
        $art = $request->route('article');

        $article = $this->getArticle($cat, $art);

        return view('newmarkets\content::article', ['article' => $article, 'tags' => ['dis', 'dat', 'd uder ting']]);

    }

    protected function getArticle($cat, $art) {

        $catid = Category::getId($cat);
        return Article::findByCatidSlug($catid, $art);

    }

    protected function validateCategory($category) {

    }
}

<?php

namespace NewMarket\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use NewMarket\Content\Http\Controllers\Controller;
use NewMarket\Content\Facades\Article;
use NewMarket\Content\Facades\Category;
use NewMarket\Content\Requests\CategoryRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ArticleController extends Controller
{
    /**
     * Instantiate a new instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
//        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $this->getCategory();
        if($this->category) {

            $articles = Article::listFromCategoryAdmin($this->category->id);
            return view('newmarkets\content::admin.article.index', [
                'category' => $this->category,
                'articles' => $articles
            ]);
        }
        throw new NotFoundHttpException;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $control = 'create';
        $action = Lang::get('content::messages.add');
        $categories = Category::getPublicCategories();
        $this->getCategory();
        $category = $this->category;

        // try to pre-assign an author name
        $author = '';
        $user = \Auth::user()->getAttributes();
        if (isset($user['firstname']) && isset($user['lastname'])) {
            $author = $user['firstname'] . ' ' . $user['lastname'];
        } else if (isset($user['name'])) {
            $author = $user['name'];
        } else if (isset($user['username'])) {
            $author = $user['username'];
        }

        // create a more-or-less empty article template
        $article = Article::newInstance([
            'active' => true,
            'category_id' => $category->id,
            'author' => $author,
        ]);

        if ($category && $article) {
            return view('newmarkets\content::admin.article.edit',
                compact('article', 'category', 'categories', 'action', 'control'));
        }
        throw new NotFoundHttpException;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $this->request = $request;
        $this->getCategory();

        // everything was validated by ArticleRequest, ready to save
        $input = $request->except('_token');
        $article = Article::create($input);

        // this should be the url to the article
        $url = '/' . $this->category->path . '/' . $article->slug;

        if ($this->category && $article) {
            if ($request->ajax()) {
                return ['response' => 'success', 'next' => $url];
            }
            return redirect($url)->with('success', 'Article saved.');
        }
        return back()->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        throw new NotFoundHttpException;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $control = 'edit';
        $action = Lang::get('content::messages.edit');
        $categories = Category::getPublicCategories();
        $this->getCategory();
        $category = $this->category;
        $article = Article::find($id);

        if ($category && $article) {
            return view('newmarkets\content::admin.article.edit',
                compact('article', 'category', 'categories', 'action', 'control'));
        }
        throw new NotFoundHttpException;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(ArticleRequest $request, $id)
    {
        $this->request = $request;
        $this->getCategory();

        // everything was validated by ArticleRequest, ready to save
        $input = $request->except('_token');
        $article = Article::updateOrCreate(['id' => $id], $input);

        // this should be the url to the article
        $url = '/' . $this->category->path . '/' . $article->slug;

        if ($request->ajax()) {
            return ['response' => 'success', 'next' => $url];
        }

        if ($this->category && $article) {
            return redirect($url)->with('success', 'Article saved.');
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->getCategory();

        if ($this->category) {

            if (Article::destroy([$id])) {

                if ($this->request->ajax()) {
                    return ['response' => 'success'];
                }
                return redirectTo($this->category->path);
            }
        }
        throw new NotFoundHttpException;

    }

    public function getSlug() {
        $title = $this->request->input('title', '');
        return Article::makeSlug($title);
    }
}

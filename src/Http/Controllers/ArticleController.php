<?php

namespace NewMarket\Content\Http\Controllers;

use Illuminate\Http\Request;
use NewMarket\Content\Http\Controllers\Controller;
use NewMarket\Content\Facades\Article;
use NewMarket\Content\Facades\Category;
use NewMarket\Content\Requests\ArticleRequest;
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
        $categories = Category::getPublicCategories();
        $this->getCategory();
        $category = $this->category;

        // try to pre-assign an author name
        $author = '';
        $user = \Auth::user()->getAttributes();
        if (isset($user['firstname']) && isset($user['lastname'])) {
            $author = $user['firstname'] . ' ' . $user['lastname'];
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
            return view('newmarkets\content::admin.article.edit', compact('article', 'category', 'categories'));
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

        $input = $request->except('_token');
        $article = Article::create($input);

//        if ($request->ajax()) {
//            if ($article) {
//                return ['status' => 'success'];
//            } else {
//                return $request->
//            }
//        }

        if ($this->category && $article) {
            return redirect($this->category->path . '/' . $article->slug)
                ->with('success', 'Article saved.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $categories = Category::getPublicCategories();
        $this->getCategory();
        $category = $this->category;
        $article = Article::find($id);

        if ($category && $article) {
            return view('newmarkets\content::admin.article.edit', compact('article', 'category', 'categories'));
        }
        throw new NotFoundHttpException;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSlug() {
        $title = $this->request->input('title', '');
        return Article::makeSlug($title);
    }
}

<?php

namespace NewMarket\Content\Http\Controllers;

use Illuminate\Http\Request;
use NewMarket\Content\Http\Controllers\Controller;
use NewMarket\Content\Facades\Article;
use NewMarket\Content\Facades\Category;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
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
        return view('newmarkets\content::admin.article.edit');
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

    public function getSlug($title) {
        return Article::makeSlug($title);
    }
}

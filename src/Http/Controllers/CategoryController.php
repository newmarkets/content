<?php

namespace NewMarket\Content\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use NewMarket\Content\Http\Controllers\Controller;
use NewMarket\Content\Facades\Cms;
use NewMarket\Content\Facades\Category;
use NewMarket\Content\Requests\CategoryRequest;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends Controller
{
    /**
     * Instantiate a new instance.
     *
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $cms = Cms::newInstance();
        $categories = Category::getAdminCategories();
        return view('newmarkets\content::admin.category.index', compact('cms', 'categories'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $cms = Cms::newInstance([
            'control' => 'create',
            'action' => Lang::get('content::messages.add')
        ]);

        // create a more-or-less empty article template
        $category = Category::newInstance([
            'active' => true
        ]);

        if ($category) {
            return view('newmarkets\content::admin.category.edit',
                compact('category', 'cms'));
        }
        throw new NotFoundHttpException;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CategoryRequest  $request
     * @return Response
     */
    public function store(CategoryRequest $request)
    {
        // everything was validated by CategoryRequest, ready to save
        $input = $request->except('_token');
        $category = Category::create($input);

        // this should be the url to the category
        $url = '/' . $category->path . '/index';

        if ($category) {
            if ($request->ajax()) {
                return ['response' => 'success', 'next' => $url];
            }
            return redirect($url)->with('success', 'Category saved.');
        }
        return back()->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @throws Symfony\Component\HttpKernel\Exception\NotFoundHttpException
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
     * @throws Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return Response
     */
    public function edit($id)
    {
        $cms = Cms::newInstance([
            'control' => 'edit',
            'action' => Lang::get('content::messages.edit')
        ]);
        $category = Category::find($id);

        if ($category) {
            return view('newmarkets\content::admin.category.edit',
                compact('category', 'cms'));
        }
        throw new NotFoundHttpException;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  CategoryRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CategoryRequest $request, $id)
    {
        // everything was validated by ArticleRequest, ready to save
        $input = $request->except('_token');
        $category = Category::updateOrCreate(['id' => $id], $input);

        // this should be the url to the article
        $url = '/' . $category->path . '/index';

        if ($category) {
            if ($request->ajax()) {
                return ['response' => 'success', 'next' => $url];
            }
            return redirect($url)->with('success', 'Category saved.');
        }
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @throws Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     * @return Response
     */
    public function destroy($id)
    {

        if (Category::destroy([$id])) {

            if ($this->request->ajax()) {
                return ['response' => 'success'];
            }
            return redirectTo('/' . Config::get(content.category_base));
        }
        throw new NotFoundHttpException;

    }

}

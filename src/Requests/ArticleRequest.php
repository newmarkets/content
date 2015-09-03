<?php

namespace NewMarket\Content\Requests;

use NewMarket\Content\Requests\Request;
use NewMarket\Content\Facades\Article;
use NewMarket\Content\Facades\Category;

class ArticleRequest extends Request
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
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $this->getCategory();
        if ($this->category) {

            $this->getArticle();
            if ($this->article) {
                // only found if editing
                return true;
            }

            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'numeric',
            'title' => 'required|string|unique:article,id,active,1,deleted_at:NULL|max:255',
            'slug' => 'alpha_dash|unique:article,id,active,1,deleted_at:NULL|max:255', // is alpha_dash compatible with localization?
            'subtitle' => 'string|max:255',
            'author' => 'string|max:255',
            'source_name' => 'string|max:255',
            'source_url' => 'url',
            'description' => 'string|max:1000',
            'content' => 'required|string',
            'meta_title' => 'string|max:255',
            'meta_keywords' => 'string|max:255',
            'meta_description' => 'string|max:1000',
            'featured' => 'boolean',
            'active' => 'boolean',
            'filename' => 'required_with:filename_description|string|max:255',
            'filename_description' => 'string|max:255',
            'category_id' => 'required|numeric|exists:category,id,active,1,deleted_at,NULL',
            'live_at' => 'date',
            'down_at' => 'date|after:live_at',
        ];
    }

    protected function getCategory()
    {

        $path = $this->segment(1);
        $this->category = Category::findAdminCategory($path);

    }

    protected function getArticle()
    {

        if ($this->category) {
            $art = $this->route('id');
            if (!is_null($art)) {
                $this->article = Article::findArticle($this->category->id, $art);
            }
        }

    }
}

<?php

namespace NewMarket\Content\Requests;

use Illuminate\Http\Request as LaravelRequest;
use NewMarket\Content\Requests\Request;
use NewMarket\Content\Facades\Category;

class CategoryRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(LaravelRequest $request)
    {
        $id = $request->segment(2) ?: 'NULL';
        return [
            'id' => 'numeric',
            'sortorder' => 'numeric',
            'path' => "required|string|unique:category,path,$id,id|max:255",
            'title' => "required|string|unique:category,title,$id,id,active,1,deleted_at,NULL|max:255",
            'subtitle' => 'string|max:255',
            'description' => 'string|max:1000',
            'meta_title' => 'string|max:255',
            'meta_keywords' => 'string|max:255',
            'meta_description' => 'string|max:1000',
            'featured' => 'boolean',
            'active' => 'boolean',
        ];
    }
}

<a id="edit-command" class="btn btn-default pull-right"
   href="{{ Config::get('app.url') . '/'. Config::get('content.category_base') . '/' . $category->id . '/edit' }}">
    <span class="glyphicon glyphicon-pencil" title="{{ Lang::get('content::messages.edit_category') }}"></span>
</a>

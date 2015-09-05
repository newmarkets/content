<a id="edit-command" class="btn btn-default pull-right"
   href="{{ Config::get('app.url') . '/' . $category->path . '/article/' . $article->id . '/edit' }}">
    <span class="glyphicon glyphicon-pencil" title="{{ Lang::get('content::messages.edit_article') }}"></span>
</a>

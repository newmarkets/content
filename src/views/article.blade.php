@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_content">

        <div class="row cms cms_title">
            <h1 class="cms">{{ $article->title }}</h1>
            @if (strlen($article->subtitle))
                <h2 class="cms">{{ $article->subtitle }}</h2>
            @endif
        </div>
        @if (Auth::check())
            <div class="cms cms_controls">
                <a id="delete-command" class="btn btn-default pull-right"
                   href="{{ Config::get('app.url') . '/' . $category->path . '/article/' . $article->id . '/delete' }}">
                    <span class="glyphicon glyphicon-trash" title="{{ Lang::get('content::messages.delete_article') }}"></span>
                </a>
                <a id="edit-command" class="btn btn-default pull-right"
                   href="{{ Config::get('app.url') . '/' . $category->path . '/article/' . $article->id . '/edit' }}">
                    <span class="glyphicon glyphicon-pencil" title="{{ Lang::get('content::messages.edit_article') }}"></span>
                </a>
                <a id="addnew-command" class="btn btn-default pull-right"
                   href="{{ Config::get('app.url') . '/' . $category->path . '/article/create' }}">
                    <span class="glyphicon glyphicon-plus" title="{{ Lang::get('content::messages.add_article') }}"></span>
                </a>
                <a id="list-command" class="btn btn-default pull-right"
                   href="{{ Config::get('app.url') . '/' . $category->path . '/article' }}">
                    <span class="glyphicon glyphicon-list" title="{{ Lang::get('content::messages.list_articles') }}"></span>
                </a>
            </div>
        @endif

        <div class="row cms cms_byline">
            <p class="cms_author">
                <span class="sr-only">{{ Lang::get('content::messages.author') }}</span>
                {{ $article->author }}
            </p>
            <p class="cms_date">
                <span class="sr-only">{{ Lang::get('content::messages.created') }}</span>
                @shortdate($article->created_at)
            </p>
            @if (strlen($article->source_name))
                <p class="cms_source">
                    <span class="sr-only">{{ Lang::get('content::messages.sourcename') }}</span>
                    {{ $article->source_name }}
                </p>
            @endif
            @if (strlen($article->source_url))
                <p class="cms_source_link">
                    <span class="sr-only">{{ Lang::get('content::messages.sourceurl') }}</span>
                    <a href="{{ $article->source_url }}">{{ $article->source_url }}</a>
                </p>
            @endif
        </div>

        @if (count($tags))
            <div class="row cms cms_tags">
                <span class="sr-only">{{ Lang::get('content::messages.tagged_with') }}</span>
                @foreach($tags as $tag)
                    <button type="button" class="btn btn-info btn-xs">{{ $tag }}</button>
                @endforeach
            </div>
        @endif

        <div class="row cms cms_text">
            {!! $article->renderMarkdown($article->content) !!}
        </div>

    </div>

@endsection

@section(Config::get('content.title'))
    {{ $article->title }}
@endsection

@section(Config::get('content.meta_title'))
    {{ $article->meta_title }}
@endsection

@section(Config::get('content.meta_keywords'))
    {{ $article->meta_keywords }}
@endsection

@section(Config::get('content.meta_description'))
    {{ $article->meta_description }}
@endsection

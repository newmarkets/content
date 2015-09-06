@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
    @if (Auth::check())
        <script src="/vendor/newmarkets/content/delete.js"></script>
    @endif
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_content">

        @if (Auth::check())
            <div class="cms cms_controls">
                @include('newmarkets\content::admin.article.delete_button')
                @include('newmarkets\content::admin.article.edit_button')
                @include('newmarkets\content::admin.article.create_button')
                @include('newmarkets\content::admin.article.list_button')
            </div>
        @endif

        <div class="row cms cms_title">
            <h1 class="cms">{{ $article->title }}</h1>
            @if (strlen($article->subtitle))
                <h2 class="cms">{{ $article->subtitle }}</h2>
            @endif
        </div>

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
    @include('newmarkets\content::admin.article.delete_modal')

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

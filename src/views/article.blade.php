@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_content">

        <div class="row cms cms_title">
            <h2 class="cms">{{ $article->title }}</h2>
            @if (strlen($article->subtitle))
                <h3 class="cms">{{ $article->subtitle }}</h3>
            @endif
        </div>

        <div class="row cms cms_byline">
            <p class="cms_author">
                <span class="sr-only">Author: </span>
                {{ $article->author }}
            </p>
            <p class="cms_date">
                <span class="sr-only">Created: </span>
                {{ $article->created_at }}
            </p>
            @if (strlen($article->source_name))
                <p class="cms_source">
                    <span class="sr-only">Original source: </span>
                    {{ $article->source_name }}
                </p>
            @endif
            @if (strlen($article->source_url))
                <p class="cms_source_link">
                    <span class="sr-only">Link to source: </span>
                    <a href="{{ $article->source_url }}">{{ $article->source_url }}</a>
                </p>
            @endif
        </div>

        @if (count($tags))
            <div class="row cms cms_tags">
                <span class="sr-only">This article has been tagged for the following subjects.</span>
                @foreach($tags as $tag)
                    <button type="button" class="btn btn-info btn-xs">{{ $tag }}</button>
                @endforeach
            </div>
        @endif

        <div class="row cms cms_text">
            <p>{{ $article->content }}</p>
        </div>

    </div>

@endsection

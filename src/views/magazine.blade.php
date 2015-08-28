@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_magazine">

        <div class="row cms cms_category">
            @if (strlen($category->subtitle))
                <h1 class="cms cms_title_and_sub">{{ $category->title }}:</h1>
                <h2 class="cms cms_title_and_sub">{{ $category->subtitle }}</h2>
            @else
                <h1 class="cms">{{ $category->title }}</h1>
            @endif
            @if (strlen($category->description))
                <p class="cms cms_description">{{ $category->description }}</p>
            @endif
        </div>

        <?php $col = Config::get('content.col') ?>
        @foreach ($articles as $article)
            <div class="row cms cms_title">
                <div class="{{ $col }}-12">
                    <h1 class="cms">
                        <a href="{{ Config::get('app.url') . '/' . $category->path . '/' . $article->slug }}">
                            {{ $article->title }}
                        </a>
                    </h1>
                    @if (strlen($article->subtitle))
                        <h2 class="cms">{{ $article->subtitle }}</h2>
                    @endif
                </div>
            </div>

            <div class="row cms cms_byline">
                <div class="{{ $col }}-12 cms_detail">
                    <p class="cms_author">
                        <span class="sr-only">Author: </span>
                        {{ $article->author }}
                    </p>
                    <p class="cms_date">
                        <span class="sr-only">Created: </span>
                        @shortdate($article->created_at)
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
            </div>

            {{--@if (count($tags))--}}
                {{--<div class="row cms cms_tags">--}}
                    {{--<span class="sr-only">This article has been tagged for the following subjects.</span>--}}
                    {{--@foreach($article->tags as $tag)--}}
                        {{--<button type="button" class="btn btn-info btn-xs">{{ $tag }}</button>--}}
                    {{--@endforeach--}}
                {{--</div>--}}
            {{--@endif--}}

            <div class="row cms cms_text">
                <div class="{{ $col }}-12 cms_preview">
                    <p>@longPreview($article->content)</p>
                </div>
            </div>
        @endforeach

    </div>

@endsection

@section(Config::get('content.title'))
    {{ $category->title }}
@endsection

@section(Config::get('content.meta_title'))
    {{ $category->meta_title }}
@endsection

@section(Config::get('content.meta_keywords'))
    {{ $category->meta_keywords }}
@endsection

@section(Config::get('content.meta_description'))
    {{ $category->meta_description }}
@endsection

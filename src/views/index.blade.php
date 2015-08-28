@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_list">

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
            <div class="row cms cms_article_detail">
                <div class="{{ $col }}-6 cms_title">
                    <span class="sr-only">Title: </span>
                    <a href="{{ Config::get('app.url') . '/' . $category->path . '/' . $article->slug }}">
                        {{ $article->title }}
                    </a>
                </div>
                <div class="{{ $col }}-3 cms_author">
                    <span class="sr-only">Author: </span>
                    {{ $article->author or '' }}
                </div>
                <div class="{{ $col }}-3 cms_date">
                    <span class="sr-only">Created: </span>
                    @shortdate($article->created_at)
                </div>
            </div>
            <div class="row cms cms_text">
                <div class="{{ $col }}-12 cms_preview">
                    <p>@preview($article->content)</p>
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

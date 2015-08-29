@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_content">

        <?php $col = Config::get('content.col') ?>
        @foreach ($articles as $article)
            <div class="row cms cms_article_detail">
                <div class="{{ $col }}-1 cms_active">
                    <span class="sr-only">Active: </span>
                    @if ($article->active)
                        <span class="glyphicon glyphicon-plus-sign green"></span>
                    @else
                        <span class="glyphicon glyphicon-minus-sign red"></span>
                    @endif
                    <span class="sr-only">Featured: </span>
                    @if ($article->featured)
                        <span class="glyphicon glyphicon-circle-arrow-up green"></span>
                    @else
                        <span class="glyphicon glyphicon-minus-sign neutral"></span>
                    @endif
                </div>
                <div class="{{ $col }}-4 cms_title">
                    <span class="sr-only">Title (click to edit): </span>
                    <a href="{{ Config::get('app.url') . '/' . $category->path . '/article/' . $article->id . '/edit' }}">
                        {{ $article->title }}
                    </a>
                </div>
                <div class="{{ $col }}-2 cms_author">
                    <span class="sr-only">Author: </span>
                    {{ $article->author or '' }}
                </div>
                <div class="{{ $col }}-1 cms_date">
                    <span class="sr-only">Created: </span>
                    @shortdate($article->created_at)
                </div>
                <div class="{{ $col }}-1 cms_date">
                    <span class="sr-only">Updated: </span>
                    @shortdate($article->updated_at)
                </div>
                <div class="{{ $col }}-1 cms_date">
                    <span class="sr-only">Live: </span>
                    @shortdate($article->live_at)
                </div>
                <div class="{{ $col }}-1 cms_date">
                    <span class="sr-only">Down: </span>
                    @shortdate($article->down_at)
                </div>
                {{--@if (count($tags))--}}
                    {{--<div class="{{ $col }}-1 cms_tags">--}}
                        {{--<span class="sr-only">This article has been tagged for the following subjects.</span>--}}
                        {{--@foreach($tags as $tag)--}}
                            {{--{{ $tag }}--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--@endif--}}
            </div>
        @endforeach
    </div>

@endsection

@section(Config::get('content.title'))
    {{ $category->title }}
@endsection

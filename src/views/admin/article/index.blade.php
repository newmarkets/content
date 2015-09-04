@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_content">

        <?php $col = Config::get('content.col') ?>
        <div class="row cms">
            <div class="{{ $col }}-12">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>{{ Lang::get('content::messages.active') }}/{{ Lang::get('content::messages.featured') }}</th>
                            <th>{{ Lang::get('content::messages.title') }} ({{ Lang::get('content::messages.click_to_edit') }})</th>
                            <th>{{ Lang::get('content::messages.author') }}</th>
                            <th>{{ Lang::get('content::messages.created') }}</th>
                            <th>{{ Lang::get('content::messages.updated') }}</th>
                            <th>{{ Lang::get('content::messages.live_at') }}</th>
                            <th>{{ Lang::get('content::messages.down_at') }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <td class="cms_icons">
                                    @if ($article->active)
                                        <span class="cms_active glyphicon glyphicon-eye-open green"></span>
                                    @else
                                        <span class="cms_active glyphicon glyphicon-eye-close red"></span>
                                    @endif
                                    @if ($article->featured)
                                        <span class="cms_featured glyphicon glyphicon-thumbs-up green"></span>
                                    @else
                                        <span class="cms_featured glyphicon glyphicon-thumbs-up neutral"></span>
                                    @endif
                                </td>
                                <td class="cms_title">
                                    <a href="{{ Config::get('app.url') . '/' . $category->path . '/article/' . $article->id . '/edit' }}">
                                        {{ $article->title }}
                                    </a>
                                </td>
                                <td>{{ $article->author }}</td>
                                <td>@shortdate($article->created_at)</td>
                                <td>@shortdate($article->updated_at)</td>
                                <td>@shortdate($article->live_at)</td>
                                <td>@shortdate($article->down_at)</td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection

@section(Config::get('content.title'))
    {{ $category->title }}
@endsection

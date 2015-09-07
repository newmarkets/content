@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_content">

        @if (Auth::check())
            <div class="cms cms_controls">
                @include('newmarkets\content::admin.category.create_button')
            </div>
        @endif

        <div class="row cms cms_category">
            <h1 class="cms">Categories</h1>
        </div>

        <?php $col = Config::get('content.col') ?>
        <div class="row cms">
            <div class="{{ $col }}-12">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>{{ Lang::get('content::messages.active') }}/{{ Lang::get('content::messages.featured') }}</th>
                            <th>{{ Lang::get('content::messages.title') }} ({{ Lang::get('content::messages.click_to_edit') }})</th>
                            <th>{{ Lang::get('content::messages.path') }}</th>
                            <th>{{ Lang::get('content::messages.created') }}</th>
                            <th>{{ Lang::get('content::messages.updated') }}</th>
                            {{--<th>{{ Lang::get('content::messages.sortorder') }}</th>--}}
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td class="cms_icons">
                                    @if ($category->active)
                                        <span class="cms_active glyphicon glyphicon-eye-open green"></span>
                                    @else
                                        <span class="cms_active glyphicon glyphicon-eye-close red"></span>
                                    @endif
                                    @if ($category->featured)
                                        <span class="cms_featured glyphicon glyphicon-thumbs-up green"></span>
                                    @else
                                        <span class="cms_featured glyphicon glyphicon-thumbs-up neutral"></span>
                                    @endif
                                </td>
                                <td class="cms_title">
                                    <a href="{{ Config::get('app.url') . '/' . Config::get('content.category_base') . '/' . $category->id . '/edit' }}">
                                        {{ $category->title }}
                                    </a>
                                </td>
                                <td>{{ $category->path }}</td>
                                <td>@shortdate($category->created_at)</td>
                                <td>@shortdate($category->updated_at)</td>
                                {{--<td>{{ $category->sortorder }}</td>--}}
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>

@endsection

@section(Config::get('content.title'))
    {{ Lang::choice('content::messages.category', 2) }}
@endsection

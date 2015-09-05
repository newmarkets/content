@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/pen.css">
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
    <script src="/vendor/newmarkets/content/vendor/pen/src/pen.js"></script>
    <script src="/vendor/newmarkets/content/vendor/pen/src/markdown.js"></script>
    <script src="/vendor/newmarkets/content/edit.js"></script>
    <script src="/vendor/newmarkets/content/delete.js"></script>
@endsection

@section(Config::get('content.yields'))

    <?php $col = Config::get('content.col') ?>
    <script>
        var editorConfig = {
            col: '{{ $col }}',
            path: '{{ $category->path }}',
            urlBase: '{{ (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] }}',
            label: '{{ Lang::get('content::messages.content') }}',
            contentSaved: '{{ Lang::get('content::messages.content_saved') }}',
            stayMsg: '{{ Lang::get('content::messages.editor_stay_msg') }}',
            placeholder: '{{ Lang::get('content::messages.editor_placeholder') }}'
        };
        editorConfig.thisUrl = editorConfig.urlBase + '{{ $_SERVER['REQUEST_URI'] }}';
    </script>

    <div class="container cms cms_content_editor">
        <h1>{{ $action }} {{ Lang::choice('content::messages.article', 1) }}</h1>

        <form class="form-horizontal">

            <div class="form-group">
                <div class="{{ $col }}-2">
                    <button type="submit" class="btn btn-primary">{{ Lang::get('content::messages.save') }}</button>
                    <button type="button" class="btn btn-default">{{ Lang::get('content::messages.cancel') }}</button>
                    {{ csrf_field() }}
                </div>
                <div class="{{ $col }}-10">
                    <div class="alert alert-success" role="alert" style="display:none;width:80%">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span id="success_message"></span>
                    </div>
                    <div class="alert alert-danger" role="alert" style="display:none;width:80%">
                        <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span id="error_message"></span>
                    </div>
                </div>
            </div>
            @if (Auth::check())
                <div class="cms cms_controls">
                    @if ($control == 'edit')
                        @include('newmarkets\content::admin.article.delete_button')
                        @include('newmarkets\content::admin.article.create_button')
                    @endif
                    @include('newmarkets\content::admin.article.list_button')
                </div>
            @endif

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#editing" aria-controls="editing" role="tab" data-toggle="tab">
                        {{ Lang::get('content::messages.editing_tab') }}
                    </a>
                </li>
                <li role="presentation" id="cms_content_tab">
                    <a href="#content" aria-controls="content" role="tab" data-toggle="tab">
                        {{ Lang::get('content::messages.content_tab') }}
                    </a>
                </li>
                <li role="presentation">
                    <a href="#publishing" aria-controls="publishing" role="tab" data-toggle="tab">
                        {{ Lang::get('content::messages.publishing_tab') }}
                    </a>
                </li>
                <li role="presentation">
                    <a href="#searching" aria-controls="searching" role="tab" data-toggle="tab">
                        {{ Lang::get('content::messages.searching_tab') }}
                    </a>
                </li>
                <li role="presentation">
                    <a href="#source" aria-controls="source" role="tab" data-toggle="tab">
                        {{ Lang::get('content::messages.source_tab') }}
                    </a>
                </li>
                <li role="presentation">
                    <a href="#downloading" aria-controls="downloading" role="tab" data-toggle="tab">
                        {{ Lang::get('content::messages.downloading_tab') }}
                    </a>
                </li>
            </ul>

            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="editing">

                    <div class="divider">{{ Lang::get('content::messages.article_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="title">{{ Lang::get('content::messages.title') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="title" aria-describedby="title-error"
                                    placeholder="{{ Lang::get('content::messages.title') }}"
                                    value="{{ old('title', $article->title) }}">
                        </div>
                        <span id="title-error" class="sr-only"></span>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="subtitle">{{ Lang::get('content::messages.subtitle') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="subtitle" aria-describedby="subtitle-error"
                                   placeholder="{{ Lang::get('content::messages.subtitle') }}"
                                   value="{{ old('subtitle', $article->subtitle) }}">
                        </div>
                        <span id="subtitle-error" class="sr-only"></span>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="author">{{ Lang::get('content::messages.author') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="author" aria-describedby="author-error"
                                   placeholder="{{ Lang::get('content::messages.author') }}"
                                   value="{{ old('author', $article->author) }}">
                        </div>
                        <span id="author-error" class="sr-only"></span>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="description">{{ Lang::get('content::messages.description') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="description" aria-describedby="description-error"
                                   placeholder="{{ Lang::get('content::messages.description') }}"
                                   value="{{ old('description', $article->description) }}">
                        </div>
                        <span id="description-error" class="sr-only"></span>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="slug">{{ Lang::get('content::messages.slug') }}</label>
                        <div class="{{ $col }}-10">
                            <p class="form-control-static" id="slug">{{ old('slug', $article->slug) }}</p>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="content">{{ old('content', $article->content) }}</div>

                <div role="tabpanel" class="tab-pane" id="searching">

                    <div class="divider">{{ Lang::get('content::messages.search_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="meta_title">{{ Lang::get('content::messages.meta_title') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="meta_title" aria-describedby="meta_title-error"
                                   placeholder="{{ Lang::get('content::messages.meta_title') }}"
                                   value="{{ old('meta_title', $article->meta_title) }}">
                            <span id="meta_title-error" class="sr-only"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="meta_keywords">{{ Lang::get('content::messages.meta_keywords') }}</label>
                        <div class="{{ $col }}-10">
                            <textarea rows="6" class="form-control" id="meta_keywords"
                                    aria-describedby="meta_keywords-error">{{ old('meta_keywords', $article->meta_keywords) }}</textarea>
                        </div>
                        <span id="meta_keywords-error" class="sr-only"></span>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="meta_description">{{ Lang::get('content::messages.meta_description') }}</label>
                        <div class="{{ $col }}-10">
                            <textarea rows="6" class="form-control" id="meta_description"
                                    aria-describedby="meta_description-error">{{ old('meta_description', $article->meta_description) }}</textarea>
                        </div>
                        <span id="meta_description-error" class="sr-only"></span>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="source">

                    <div class="divider">{{ Lang::get('content::messages.source_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="source_name">{{ Lang::get('content::messages.sourcename') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="source_name" aria-describedby="source_name-error"
                                   placeholder="{{ Lang::get('content::messages.sourcename') }}"
                                   value="{{ old('source_name', $article->source_name) }}">
                            <span id="source_name-error" class="sr-only"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="source_url">{{ Lang::get('content::messages.sourceurl') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="source_url" aria-describedby="source_url-error"
                                   placeholder="{{ Lang::get('content::messages.sourceurl') }}"
                                   value="{{ old('source_url', $article->source_url) }}">
                            <span id="source_url-error" class="sr-only"></span>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="downloading">

                    <div class="divider">{{ Lang::get('content::messages.download_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="filename">{{ Lang::get('content::messages.filename') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="filename" aria-describedby="filename-error"
                                   placeholder="{{ Lang::get('content::messages.filename') }}"
                                   value="{{ old('filename', $article->filename) }}">
                            <span id="filename-error" class="sr-only"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="filename_description">{{ Lang::get('content::messages.filename_description') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="filename_description" aria-describedby="filename_description-error"
                                   placeholder="{{ Lang::get('content::messages.filename_description') }}"
                                   value="{{ old('filename_description', $article->filename_description) }}">
                            <span id="filename_description-error" class="sr-only"></span>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="publishing">

                    <div class="divider">{{ Lang::get('content::messages.publication_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="category_id">{{ Lang::choice('content::messages.category', 1) }}</label>
                        <div class="{{ $col }}-10">
                            <select class="form-control" id="category_id">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="live_at">{{ Lang::get('content::messages.live_at') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="live_at" aria-describedby="live_at-error"
                                   placeholder="{{ Lang::get('content::messages.live_at') }}"
                                   value="{{ old('live_at', $article->live_at) }}">
                            <span id="live_at-error" class="sr-only"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="down_at">{{ Lang::get('content::messages.down_at') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="down_at" aria-describedby="down_at-error"
                                   placeholder="{{ Lang::get('content::messages.down_at') }}"
                                   value="{{ old('down_at', $article->down_at) }}">
                            <span id="down_at-error" class="sr-only"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $col }}-offset-2 {{ $col }}-10">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input id="active" type="checkbox" @checked(old('active', $article->active))
                                            aria-describedby="active-error">
                                    {{ Lang::get('content::messages.active') }}
                                    <span id="active-error" class="sr-only"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $col }}-offset-2 {{ $col }}-10">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input id="featured" type="checkbox" @checked(old('featured', $article->featured))
                                            aria-describedby="featured-error">
                                    {{ Lang::get('content::messages.featured') }}
                                    <span id="featured-error" class="sr-only"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>
    @include('newmarkets\content::admin.article.delete_modal')

@endsection


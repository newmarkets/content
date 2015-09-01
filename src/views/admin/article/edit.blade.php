@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/pen.css">
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
    <script src="/vendor/newmarkets/content/vendor/pen/src/pen.js"></script>
    <script src="/vendor/newmarkets/content/vendor/pen/src/markdown.js"></script>
    <script src="/vendor/newmarkets/content/edit.js"></script>
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_content">
        <h1>{{ Lang::get('content::messages.edit') }} {{ Lang::choice('content::messages.article', 1) }}</h1>

        <?php $col = Config::get('content.col') ?>
        <form class="form-horizontal">

            <div class="form-group">
                <div class="{{ $col }}-12">
                    <button type="submit" class="btn btn-primary">{{ Lang::get('content::messages.save') }}</button>
                    <button type="button" class="btn btn-default">{{ Lang::get('content::messages.cancel') }}</button>
                </div>
            </div>

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#editing" aria-controls="editing" role="tab" data-toggle="tab">
                        {{ Lang::get('content::messages.editing_tab') }}
                    </a>
                </li>
                <li role="presentation">
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
                            <input type="text" class="form-control" id="title" placeholder="{{ Lang::get('content::messages.title') }}"
                                value="{{ old('title', $article->title) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="subtitle">{{ Lang::get('content::messages.subtitle') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="subtitle" placeholder="{{ Lang::get('content::messages.subtitle') }}"
                                   value="{{ old('subtitle', $article->subtitle) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="author">{{ Lang::get('content::messages.author') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="author" placeholder="{{ Lang::get('content::messages.author') }}"
                                   value="{{ old('author', $article->author) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="description">{{ Lang::get('content::messages.description') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="description" placeholder="{{ Lang::get('content::messages.description') }}"
                                   value="{{ old('description', $article->description) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="slug">{{ Lang::get('content::messages.slug') }}</label>
                        <div class="{{ $col }}-10">
                            <p class="form-control-static" id="slug">{{ old('slug', $article->slug) }}</p>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="content">
                    {{ old('content', $article->content) }}
                </div>
                <script>
                    var col = '{{ $col }}',
                        contentLabel = '{{ Lang::get('content::messages.content') }}',
                        editor_stay_msg = '{{ Lang::get('content::messages.editor_stay_msg') }}',
                        editor_placeholder = '{{ Lang::get('content::messages.editor_placeholder') }}';
                </script>

                <div role="tabpanel" class="tab-pane" id="searching">

                    <div class="divider">{{ Lang::get('content::messages.search_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="meta_title">{{ Lang::get('content::messages.meta_title') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="meta_title" placeholder="{{ Lang::get('content::messages.meta_title') }}"
                                   value="{{ old('meta_title', $article->meta_title) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="meta_keywords">{{ Lang::get('content::messages.meta_keywords') }}</label>
                        <div class="{{ $col }}-10">
                            <textarea rows="6" class="form-control" id="meta_keywords">{{ old('meta_keywords', $article->meta_keywords) }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="meta_description">{{ Lang::get('content::messages.meta_description') }}</label>
                        <div class="{{ $col }}-10">
                            <textarea rows="6" class="form-control" id="meta_description">{{ old('meta_description', $article->meta_description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="source">

                    <div class="divider">{{ Lang::get('content::messages.source_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="source_name">{{ Lang::get('content::messages.sourcename') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="source_name" placeholder="{{ Lang::get('content::messages.sourcename') }}"
                                   value="{{ old('source_name', $article->source_name) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="source_url">{{ Lang::get('content::messages.sourceurl') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="source_url" placeholder="{{ Lang::get('content::messages.sourceurl') }}"
                                   value="{{ old('source_url', $article->source_url) }}">
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="downloading">

                    <div class="divider">{{ Lang::get('content::messages.download_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="filename">{{ Lang::get('content::messages.filename') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="filename" placeholder="{{ Lang::get('content::messages.filename') }}"
                                   value="{{ old('filename', $article->filename) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="filename_description">{{ Lang::get('content::messages.filename_description') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="filename_description" placeholder="{{ Lang::get('content::messages.filename_description') }}"
                                   value="{{ old('filename_description', $article->filename_description) }}">
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
                            <input type="text" class="form-control" id="live_at" placeholder="{{ Lang::get('content::messages.live_at') }}"
                                   value="{{ old('live_at', $article->live_at) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="down_at">{{ Lang::get('content::messages.down_at') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="down_at" placeholder="{{ Lang::get('content::messages.down_at') }}"
                                   value="{{ old('down_at', $article->down_at) }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $col }}-offset-2 {{ $col }}-10">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input id="active" type="checkbox"> {{ Lang::get('content::messages.active') }}
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="{{ $col }}-offset-2 {{ $col }}-10">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input id="featured" type="checkbox"> {{ Lang::get('content::messages.featured') }}
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>

    </div>

@endsection


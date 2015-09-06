@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/pen.css">
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
    <script src="/vendor/newmarkets/content/vendor/pen/src/pen.js"></script>
    <script src="/vendor/newmarkets/content/vendor/pen/src/markdown.js"></script>
    <script src="/vendor/newmarkets/content/edit_category.js"></script>
    <script src="/vendor/newmarkets/content/delete_category.js"></script>
@endsection

@section(Config::get('content.yields'))

    <?php $col = Config::get('content.col') ?>
    <script>
        var editorConfig = {
            col: '{{ $col }}',
            urlBase: '{{ (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] }}',
            contentSaved: '{{ Lang::get('content::messages.content_saved') }}'
        };
        editorConfig.thisUrl = editorConfig.urlBase + '{{ $_SERVER['REQUEST_URI'] }}';
    </script>

    <div class="container cms cms_content_editor">

        @if (Auth::check())
            <div class="cms cms_controls">
                @if ($control == 'edit')
                    @include('newmarkets\content::admin.category.delete_button')
                    @include('newmarkets\content::admin.category.create_button')
                @endif
                @include('newmarkets\content::admin.category.list_button')
            </div>
        @endif

        <h1>{{ $action }} {{ Lang::choice('content::messages.category', 1) }}</h1>

        <form class="form-horizontal">

            <div class="form-group">
                <div class="{{ $col }}-2">
                    <button type="submit" class="btn btn-primary">{{ Lang::get('content::messages.save') }}</button>
                    <button type="button" class="btn btn-default cancel">{{ Lang::get('content::messages.cancel') }}</button>
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

            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#editing" aria-controls="editing" role="tab" data-toggle="tab">
                        {{ Lang::get('content::messages.editing_tab') }}
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
            </ul>

            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="editing">

                    <div class="divider">{{ Lang::get('content::messages.category_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="title">{{ Lang::get('content::messages.title') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="title" aria-describedby="title-error"
                                    placeholder="{{ Lang::get('content::messages.title') }}"
                                    value="{{ old('title', $category->title) }}">
                        </div>
                        <span id="title-error" class="sr-only"></span>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="subtitle">{{ Lang::get('content::messages.subtitle') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="subtitle" aria-describedby="subtitle-error"
                                   placeholder="{{ Lang::get('content::messages.subtitle') }}"
                                   value="{{ old('subtitle', $category->subtitle) }}">
                        </div>
                        <span id="subtitle-error" class="sr-only"></span>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="path">{{ Lang::get('content::messages.path') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="path" aria-describedby="title-error"
                                   placeholder="{{ Lang::get('content::messages.path') }}"
                                   value="{{ old('path', $category->path) }}">
                        </div>
                        <span id="path-error" class="sr-only"></span>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="description">{{ Lang::get('content::messages.description') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="description" aria-describedby="description-error"
                                   placeholder="{{ Lang::get('content::messages.description') }}"
                                   value="{{ old('description', $category->description) }}">
                        </div>
                        <span id="description-error" class="sr-only"></span>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="searching">

                    <div class="divider">{{ Lang::get('content::messages.search_information') }}</div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="meta_title">{{ Lang::get('content::messages.meta_title') }}</label>
                        <div class="{{ $col }}-10">
                            <input type="text" class="form-control" id="meta_title" aria-describedby="meta_title-error"
                                   placeholder="{{ Lang::get('content::messages.meta_title') }}"
                                   value="{{ old('meta_title', $category->meta_title) }}">
                            <span id="meta_title-error" class="sr-only"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="meta_keywords">{{ Lang::get('content::messages.meta_keywords') }}</label>
                        <div class="{{ $col }}-10">
                            <textarea rows="6" class="form-control" id="meta_keywords"
                                    aria-describedby="meta_keywords-error">{{ old('meta_keywords', $category->meta_keywords) }}</textarea>
                        </div>
                        <span id="meta_keywords-error" class="sr-only"></span>
                    </div>
                    <div class="form-group">
                        <label class="{{ $col }}-2 control-label" for="meta_description">{{ Lang::get('content::messages.meta_description') }}</label>
                        <div class="{{ $col }}-10">
                            <textarea rows="6" class="form-control" id="meta_description"
                                    aria-describedby="meta_description-error">{{ old('meta_description', $category->meta_description) }}</textarea>
                        </div>
                        <span id="meta_description-error" class="sr-only"></span>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane" id="publishing">

                    <div class="divider">{{ Lang::get('content::messages.publication_information') }}</div>
                    <div class="form-group">
                        <div class="{{ $col }}-offset-2 {{ $col }}-10">
                            <div class="checkbox">
                                <label class="control-label">
                                    <input id="active" type="checkbox" @checked(old('active', $category->active))
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
                                    <input id="featured" type="checkbox" @checked(old('featured', $category->featured))
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
    @include('newmarkets\content::admin.category.delete_modal')

@endsection


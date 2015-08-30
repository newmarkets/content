@extends(Config::get('content.extends'))

@section(Config::get('content.style'))
    <link rel="stylesheet" href="/vendor/newmarkets/content/content.css">
@endsection

@section(Config::get('content.script'))
@endsection

@section(Config::get('content.yields'))

    <div class="container cms cms_content">
        <h1>{{ Lang::get('content::messages.edit') }} {{ Lang::choice('content::messages.article', 1) }}</h1>

        <?php $col = Config::get('content.col') ?>
        <form class="form-horizontal">
            <div class="form-group">
                <label class="{{ $col }}-2 control-label" for="">{{ Lang::get('content::messages.title') }}</label>
                <div class="{{ $col }}-10">
                    <input type="text" class="form-control" id="titel" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <div class="{{ $col }}-offset-2 {{ $col }}-10">
                    <div class="checkbox">
                        <label class="control-label">
                            <input type="checkbox"> {{ Lang::get('content::messages.active') }}
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="{{ $col }}-offset-2 {{ $col }}-10">
                    <button type="submit" class="btn btn-default">{{ Lang::get('content::messages.save') }}</button>
                </div>
            </div>
        </form>

    </div>

@endsection


@foreach ($cms->getMenus() as $cat)

    <li>

        @if ($cms->hasMenuItems($cat->id))

            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                {{ $cat->title }} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">

                @foreach ($cms->getMenuItems($cat->id) as $art)
                    <li><a href="/{{ $cat->path }}/{{ $art->slug }}">{{ $art->title }}</a></li>
                @endforeach

            </ul>

        @else

            <a href="/{{ $cat->path }}">{{ $cat->title }}</a>

        @endif
    </li>

@endforeach

<nav>
    <!-- @foreach($menu as $item)

    <a href="{{ route($item['route']) }}" class="@if($item['active']) active @endif">
        <span>{{ $item['title'] }}</span>
    </a>
    @endforeach -->
    <ul>
        @foreach($menu as $item)
        <li class="@if($item['active']) active @endif">
            <a href="{{ route($item['route']) }}"><b>{{ $item['title'] }}</b></a>
        </li>
        @endforeach
    </ul>
</nav>
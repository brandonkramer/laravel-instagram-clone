<div {{ $attributes->merge(['class' => 'card-body']) }}>
    <h2>{{ $title }}</h2>
    <h3>{{$subtitle}}</h3>
    {{ $content }}
    <ul>
        @foreach ($list('tandwiel') as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>

    {{ $slot }}
</div>

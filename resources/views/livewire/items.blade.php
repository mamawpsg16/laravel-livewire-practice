<div>
    @foreach($items as $item)
        <div wire:key="item-{{ $item['id'] }}">
            {{ $item['name'] }}
        </div>
    @endforeach
</div>

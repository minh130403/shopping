 <div class="border border-gray-200 bg-base-100 flex-1 relative h-fit">
    @if ($type == "products")
        <span class="block absolute -top-2 right-0 bg-red-500 rounded-xl px-2 text-white"> {{$item->status == 'out_of_stock' ? 'Out of Stock'  : ucfirst($item->status )}} </span>
    @endif
    <figure class="px-10 pt-10">
        {{-- <x-badge value="7" class="badge-secondary badge-sm indicator-item" /> --}}
        <a href="/{{ $type }}/{{ $item->slug }}">
            <img class="hover:scale-110 transition duration-500 ease-in-out"
            src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1'  ?? Storage::url($item->avatar->path ?? '' ) }}"
            alt="Shoes" />
        </a>
    </figure>
    <div class="card-body">
        <span class="card-title block text-center truncate"><a href="">{{ $item->name }}</a></span>
        <div class="card-actions block text-center">
        <a navigate href="/{{ $type }}/{{ $item->slug }}" class="btn border border-black bg-white hover:bg-black hover:text-white">Xem chi tiết</a>
        </div>
    </div>
</div>

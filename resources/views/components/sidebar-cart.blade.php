<div class="flex-1/4 mt-3 order-2">
    <h3 class="text-lg font-semibold block mb-3">{{ $title ?? 'Danh mục đề xuất'}}</h3>
    <ul class="list-inside list-none">
        @forelse ($root ?? [] as $item)
            <li class="block mb-5 cursor-pointer hover:border-blue-500 hover:border-2 relative hover:text-white hover:text-shadow-black ">
                <a href="/categories/{{ $item->slug }}">
                    <img class="h-36 w-100 hover:opacity-75" src="{{ 'https://cdn.pixabay.com/photo/2017/05/09/03/46/bc-2297205_960_720.jpg' ?? Storage::url($item->avatar->path ?? '') }}" alt="{{ $item->avatar->alt ?? '' }}">
                </a>
                <span class="absolute px-2 py-1  top-[10%] uppercase italic font-bold truncate max-w-[80%] decoration-solid underline text-shadow-md "> {{ $item->name }} </span>
            </li>
        @empty

        @endforelse

    </ul>
</div>

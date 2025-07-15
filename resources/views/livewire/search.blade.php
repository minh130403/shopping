
    <div class="search-box hidden md:inline-flex grow flex justify-end gap-4" >
                <label class="input">
                <svg class="h-[1em] opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <g
                    stroke-linejoin="round"
                    stroke-linecap="round"
                    stroke-width="2.5"
                    fill="none"
                    stroke="currentColor"
                    >
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                    </g>
                </svg>
                <input type="search" class="w-80" placeholder="Search" wire:model.live="keyword" />
                @if($results)
                    <ul class="absolute bottom-0 translate-y-full m-0 left-0 bg-white w-80 rounded max-h-[400px] border border-gray-500">
                        @foreach ($results as $item)
                            <li><a  class="block p-4 flex gap-3 items-center hover:bg-gray-500 hover:text-white"  href="/products/{{ $item->slug }}"> <img class="w-12 rounded" src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=' ?? Storage::url($item->avatar->path ?? 'photos/sample_product.webp') }}" alt="">  <span class="grow block truncate"> {{ $item->name }}</span> </a> </li>
                        @endforeach
                    </ul>
                @endif
        </label>
    </div>


<div>
    <div class="" >
        <img class="w-full h-80 object-cover" src="{{ Storage::url($category->avatar->path ?? '' )}}" alt="">
    </div>
    <div class="border border-gray-200">
            <div class="container">
            <div class="breadcrumbs text-sm">
            <ul>
                <li><a href="/" navigate>Trang chủ</a></li>
                @if ($category->parent_category)
                    @if ($category->parent->parent_category)

                        <li><a href="/categories/{{ $category->parent->parent->slug }}" navigate>{{ $category->parent->parent->name }}</a></li>

                    @endif

                    <li><a href="/categories/{{ $category->parent->slug }}" navigate>{{ $category->parent->name }}</a></li>

                @endif
                <li> {{ $category->name }} </li>
            </ul>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <div class="container pt-4 flex flex-row">
            <div class="sidebar flex-1/4 order-1 mr-3">
                <div class="nav mb-3">
                    {{-- <ul class="list-none"> --}}
                        <x-menu class="border border-base-content/10">
                             @foreach ($root ?? [] as $item)
                                @if (!empty($item->children) && count($item->children) > 0)
                                    <x-menu-sub title="{{ $item->name ?? '' }}">
                                        @foreach ($item->children as $itemChild)
                                            <x-menu-item
                                                title="{{ $itemChild->name ?? '' }}"
                                                link="/categories/{{ $itemChild->slug ?? '' }}"
                                            />
                                        @endforeach
                                    </x-menu-sub>
                                @else
                                    <x-menu-item
                                        title="{{ $item->name ?? '' }}"
                                        link="/categories/{{ $item->slug ?? '' }}"
                                        class="!w-50"
                                    />
                                @endif
                            @endforeach
                         </x-menu>
                    {{-- </ul> --}}
                </div>
            {{-- <div class="categories-recommend ">
                <ul class="list-inside list-none">
                    @foreach ($category->children as $child)
                       <a class="block relative border border-gray-200 rounded hover:scale-110 cursor-pointer" href="/categories/{{ $child->slug ?? "" }}" navigate>
                            <img class="h-32 w-100 object-none rounded" src="{{ Storage::url($child->avatar->path ?? "") }}" alt="">
                            <p class="block absolute text-black-500 font-bold top-[50%] bg-green-500 px-2 rounded-r-sm -translate-y-1/2">{{ $child->name ?? "" }}</p>
                       </a>
                    @endforeach
                </ul>
            </div> --}}
            </div>
            <div class="main-content flex-3/4 order-2 min-h-[400px]">
                <h2 class="font-semibold text-2xl mb-3">{{ $category->name }}</h2>
                    <div class="grid grid-cols-4 gap-2 ">
                    @forelse ($products  as $item)
                       <x-my-card :$item type="products" />
                    @empty
                         <p class="text-lg italic col-span-4">Chưa có sản phẩm nào trong danh mục</p>
                    @endforelse
                    <div class="col-span-4"> {{ $products?->links()  ?? ''}} </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

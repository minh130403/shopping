<div x-data x-init="setTimeout(() => $wire.recordView(), 30000)">
   <div class="border border-gray-200">
        <div class="container">
        <div class="breadcrumbs text-sm">
        <ul>
            <li><a href="/" navigate>Trang chủ</a></li>
            @if ( $product->category)
                <li><a> {{ $product->category->name ?? ''}} </a></li>
            @endif
            <li>{{ $product->name ?? '' }}</li>
        </ul>
        </div>
    </div>
   </div>
   <div class="bg-gray-100 mt-8 pb-4 mb-4">
        <div class="container flex flex-row pt-12 gap-4 max-h-[440px] overflow-y-hidden">
            {{-- Anh san pham --}}
            <div class="gallery flex flex-col gap-4 overflow-y-scroll cursor-pointer">

                    <img class="w-24 rounded" src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($product->avatar->path ?? ''  ) }}" alt="{{ $product->avatar->alt ?? ''  }}" wire:click="updateSelectedPhoto({{ $product->avatar->id ?? '' }})">
                @foreach ($product->gallery as $item)
                    <img class="w-24 rounded" src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($item->path) }}" alt="{{ $item->alt ?? '' }}" wire:click="updateSelectedPhoto({{ $item->id ?? ''}})">
                @endforeach

            </div>
            <div class="relative">
                {{-- <x-avatar :image="$user->avatar" :title="$user->username" :subtitle="$user->name" class="!w-10" /> --}}
                <span class="block absolute -top-2 right-0 bg-red-500 rounded-xl px-2 text-white"> {{ $product->status == 'out_of_stock' ? 'Out of Stock'  : ucfirst( $product->status) }} </span>
                <img class="w-[400px] h-full border border-gray-300 object-cover rounded" alt="{{ $selectedPhoto->alt ?? ''  }}" src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=1' ?? Storage::url($selectedPhoto->path ?? 'photos/sample_product.webp') }}" alt="">

            </div>

            {{-- Thong tin nhanh --}}
            <div class="flex-3/5">
               <h1 class="text-4xl font-medium mb-3">{{ $product?->name ?? ''}}</h1>
               <span class="block mb-3">Mã: {{ $product?->id  ?? ''}}</span>
               <span class="block mb-3">Giá: <span class="text-red-600 font-bold">{{ $product->price   ? number_format($product->price, 0, '.', ',') . ' VNĐ': 'Liên hệ' }}</span></span>
               <div class="text-left flex flex-row mb-3">
                    <button class="btn flex-1/2 h-20 rounded-none"><div>
                        <span class="block " >Miền Bắc </span> <span class="block text-2xl text-red-500">0869xxxxxx</span> </div></button>
                    <button class="btn flex-1/2 h-20 rounded-none"><div>
                        <span class="block">Miền Nam </span> <span class="block text-2xl text-red-500">0869xxxxxx</span></div></button>
                </div>
                <div class="text-left flex flex-row mb-3">
                    <a class="btn flex-1/2 h-20 rounded-none" navigate href="/check-out"><div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                        </svg>
                    </div></a>
                    <button class="btn flex-1/2 h-20 rounded-none bg-green-500 text-white uppercase" wire:click="addToCart"><div>
                        <span class="block">Mua ngay</span></div> </button>
                    </div>
                     @if (session()->has('success'))
                        <div x-data="{ show: true }" x-show="show"
                            class="p-3 mt-4 mb-4 text-green-800 bg-green-100 rounded-lg transition-opacity duration-500">
                            {{ session('success') }} <a class="text-blue-500" href="/check-out">Xem giỏ hàng</a>
                        </div>
                    @endif
                  <div class="text-left flex flex-row mb-3 short-description">
                    <article class="prose prose-sm !text-black-900 !opacity-100">{!! Str::markdown($product->short_description ?? '') !!}</article>
                </div>
            </div>
        </div>

    {{-- Moo ta  --}}
   </div>
   <div class="bg-white mb-4 ">
        <div class="container flex flex-row ">
             <x-sidebar-cart  :$root title="Danh mục" />
{{-- Mo ta --}}
             <div class="description flex-3/4 mr-8 order-1 ">
                <h3 class="uppercase block font-bold py-4 mb-3 border-b-2 border-gray-200 ">Chi tiết sản phẩm {{ $product->name }} </h3>
                <article class="prose prose-lg mb-4 max-w-[100%]">{!! Str::markdown($product->description ?? '') !!}</article>
                 @if (session()->has('createdCmt'))
                        <div x-data="{ show: true }" x-show="show"
                            class="p-3 mt-4 mb-4 text-green-800 bg-green-100 rounded-lg transition-opacity duration-500">
                            {{ session('createdCmt') }}
                        </div>
                    @endif
                <div class="form-comment mb-3 mt-[40px] pb-2 border-b border-gray-200">
                    <form action="" wire:submit="createCmt" >
                    <div class="form-heading relative p-4 border border-gray-300 mb-3">
                        {{-- <span>Chất lượng sản phẩm</span> --}}
                        <span class="block absolute -top-4 left-4 z-index-5 bg-white px-2">Đánh giá của bạn: </span>
                    </div>
                    <x-textarea class="mb-3" wire:model="contentCmt" placeholder="Viết bình luận ..." rows="5" />
                    <div class="flex w-full gap-2">
                            <x-input class="min-w-[400px]" wire:model="titleCmt" placeholder="Tiêu đề"  />
                            <x-input class="flex-1/2" wire:model="authorCmt" placeholder="Họ và tên"  />
                            <input type="submit" class="btn bg-green-400 text-white" value="Gửi"/>

                    </div>
                      </form>
                </div>

                <div class="comments">
                    <h3 class="mb-1 text-md font-semibold">Bình luận </h3>
                   @forelse ($comments as $comment)
                    <x-list-item :item="$comment" class="!h-fit">
                        <x-slot:avatar>
                            <x-badge  value="{{ $comment->name }}" class="badge-primary badge-soft w-40" />
                        </x-slot:avatar>
                        <x-slot:value>
                            {{ $comment->title }}
                        </x-slot:value>
                        <x-slot:sub-value>
                           <span class="block h-fit w-full text-wrap"> {{ $comment->content }}</span>
                        </x-slot:sub-value>
                        {{-- <x-slot:actions>
                            <x-button icon="o-trash" class="btn-sm" wire:click="delete(1)" spinner />
                        </x-slot:actions> --}}
                    </x-list-item>
                   @empty

                   @endforelse
                </div>
            </div>

        </div>
   </div>


   {{-- San pham tuong tu --}}
   <div class="mb-6">
        @if ($productSame)
       <div class="container">
            <div class="heading">
                <h3 class="uppercase block font-bold py-4 mb-3">Sản phẩm cùng loại</h3>
            </div>
            <div class="grid grid-cols-4 gap-2">
                    @foreach ($productSame as $item )
                            <x-my-card  :$item type="products" />
                    @endforeach
            </div>
       </div>
       @endif
   </div>

</div>

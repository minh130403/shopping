<div>
    <div class="mt-3 mb-3">
        <div class="container flex flex-row">
            <x-sidebar-cart :root="$categories" title="Danh mục đề xuất" />

           <div class="post flex-3/4 pr-8 order-1">
                <h1 class="text-2xl font-bold mb-3 block text-center"> {{$selectedPost->title ?? ''}}</h1>
                <p class="short-description italic text-justify">
                   {{ $selectedPost->description ?? ''}}
                </p>
                <div class="flex justify-center mb-2">
                    <img class="w-64 rounded" src="{{ 'https://i0.wp.com/thewordwarrior.com/wp-content/uploads/woocommerce-placeholder.png?fit=655,655&ssl=' ?? Storage::url($selectedPost->avatar->path ?? '') }}" alt="{{ $selectedPost->avatar->alt  ?? ''}}">
                </div>


                <div class="main-content mb-3">
                    <article class="prose !max-w-[100%]"> {!! Str::markdown($selectedPost->content ?? '') !!} </article>
                </div>
                {{-- <div class="author-cpn flex flex-row bg-gray-100 mb-3 rounded-lg items-center">
                    <div class="avatar flex-1/6 justify-center">
                        <img class="rounded-full" style="height:100px; width:100px" src="https://hanhtinhxanh.com.vn/pub/media/abit/user/a/v/avatar.jpg" alt="">
                    </div>
                    <div class="flex-5/6 py-4">
                        <div class="author-info">
                            <div class="author-name"><a href="/author/show"><span class="font-medium">Lê Viết Hoè</span></a></div>
                            <div class="author-desc"><p>Tôi là Lê Viết Hòe - trưởng phòng Marketing công ty cổ phần thương mại và dịch vụ Hành Tinh Xanh,
                                là người chịu trách nhiệm về nội dung trên các kênh bán hàng của công ty Hành Tinh Xanh.
                                Sở thích nghiên cứu thị trường và phân tích dữ liệu trải nghiệm người dùng qua các kênh marketing trực tuyến,
                                đặc biệt là thông qua chỉ số trên nền tảng trực tuyến để mang lại trải nghiệm tốt nhất tới người dùng khi truy
                                cập các kênh bán hàng của doanh nghiệp.</p></div>
                        </div>
                    </div>
                </div> --}}
           </div>

        </div>
    </div>
    <div class="mb-3">
        <div class="container">
            <div class="post-recommend">
                <h3 class="font-semibold text-lg mb-3"> Sản phẩm đề xuất  </h3>
                 <div class="flex-3/4 blog-list grid grid-cols-5 gap-4">
                    @foreach ($products as $item)
                        <x-my-card :$item type="products"/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

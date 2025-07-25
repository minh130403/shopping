<!DOCTYPE html>
<html lang="en">
<head>
    @include("partials.head")

    <link rel="stylesheet" href="https://unpkg.com/easymde/dist/easymde.min.css">
    <script src="https://unpkg.com/easymde/dist/easymde.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.39.1/ace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.39.1/ext-language_tools.min.js"></script>

</head>
<body class="min-h-screen font-sans antialiased bg-base-200">
    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <div class="ml-5 pt-5">Trang quản trị</div>
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit " >

            {{-- BRAND --}}


            {{-- MENU --}}
            <x-menu activate-by-route icon="">

                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <livewire:auth.logout/>
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                <x-menu-item title="Khám phá" icon="o-chart-pie" link="/admin/dashbroad" />
                <x-menu-sub title="Sản phẩm" icon="o-cube">
                    <x-menu-item title="Thêm sản phẩm" icon="o-plus-circle" link="/admin/products/create" navigate />
                    <x-menu-item title="Tất cả sản phẩm" icon="o-archive-box" link="/admin/products/all" navigate/>
                    <x-menu-item title="Danh mục sản phẩm" icon="o-square-3-stack-3d" link="/admin/categories/products" navigate/>
                    <x-menu-item title="Bình luận" icon="o-chat-bubble-bottom-center-text" link="/admin/comments/all" navigate/>
                </x-menu-sub>
                 <x-menu-item title="Ảnh" icon="o-photo" link="/admin/photos" navigate />
                 <x-menu-item title="Đơn hàng" icon="o-document-currency-dollar" link="/admin/orders" navigate />
                {{-- <x-menu-item title="Posts" icon="o-book-open" link="/admin/posts" navigate /> --}}
                <x-menu-sub title="Bài viết" icon="o-pencil-square">
                    <x-menu-item title="Thêm bài viết" icon="o-plus-circle" link="/admin/posts/create" navigate />
                    <x-menu-item title="Tất cả bài viết" icon="o-archive-box" link="/admin/posts/all" navigate/>
                    {{-- <x-menu-item title="Categories" icon="o-square-3-stack-3d" link="/admin/categories/products" navigate/> --}}
                </x-menu-sub>
                 <x-menu-sub title="Trang" icon="o-document">
                    <x-menu-item title="Thêm trang" icon="o-plus-circle" link="/admin/pages/create" navigate />
                    <x-menu-item title="Tất cả trang" icon="o-archive-box" link="/admin/pages/all" navigate/>
                    {{-- <x-menu-item title="Categories" icon="o-square-3-stack-3d" link="/admin/categories/products" navigate/> --}}
                </x-menu-sub>
                <x-menu-item title="Cấu hình" icon="o-cog-6-tooth" link="/admin/settings" navigate />
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
           <x-header :$title  separator />
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{-- Toast --}}
    <x-toast />


</body>
</html>

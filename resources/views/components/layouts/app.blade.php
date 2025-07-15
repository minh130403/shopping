<!DOCTYPE html>
<html lang="en">
<head>
    @include("partials.head")
    {{-- <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/umd/photoswipe-lightbox.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/photoswipe@5.4.3/dist/photoswipe.min.css" rel="stylesheet"> --}}
</head>
<body>
    @include("components.layouts.app.header")
    {{ $slot }}
    <footer class="footer w-full bg-base-200 text-base-content p-10">
    {{-- <aside>
    </aside> --}}
   <div class="md:mx-48 flex justify-between w-full">
        <nav class="flex-1/2 flex flex-col gap-3">
            <h6 class="footer-title">{{ setting("site_name") }}</h6>
            <a class="link link-hover">Địa chỉ: {{ setting("site_address") }}</a>
            <a class="link link-hover">Hotline: {{ setting("site_phone1") }}</a>
            <a class="link link-hover">Zalo: {{ setting("site_phone2") }}</a>
            {{-- <a class="link link-hover">Advertisement</a> --}}
        </nav>
        <nav class="flex-1/2 flex flex-col gap-3">
            <h6 class="footer-title">Thông tin</h6>
            <a href="/" class="link link-hover">Trang chủ</a>
            <a href="/about-us" class="link link-hover">Giới thiệu</a>
            <a href="/contact" class="link link-hover">Liên hệ</a>
            <a href="/posts/all" class="link link-hover">Tin tức</a>
        </nav>
   </div>
    {{-- <nav>
        <h6 class="footer-title">Legal</h6>
        <a class="link link-hover">Terms of use</a>
        <a class="link link-hover">Privacy policy</a>
        <a class="link link-hover">Cookie policy</a>
    </nav> --}}
    </footer>
</body>
</html>

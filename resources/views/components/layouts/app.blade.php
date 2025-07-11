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
    <footer class="footer sm:footer-horizontal bg-base-200 text-base-content p-10">
    <aside>
    </aside>
    <nav>
        <h6 class="footer-title">{{ setting("site_name") }}</h6>
        <a class="link link-hover">Address: {{ setting("site_address") }}</a>
        <a class="link link-hover">Hotline 1: {{ setting("site_phone1") }}</a>
        <a class="link link-hover">Hotline 2: {{ setting("site_phone2") }}</a>
        {{-- <a class="link link-hover">Advertisement</a> --}}
    </nav>
    <nav>
        <h6 class="footer-title">Thông tin</h6>
        <a href="/" class="link link-hover">Trang chủ</a>
        <a href="/about-us" class="link link-hover">About us</a>
        <a href="/contact" class="link link-hover">Contact</a>
        <a href="/posts/all" class="link link-hover">News</a>
    </nav>
    {{-- <nav>
        <h6 class="footer-title">Legal</h6>
        <a class="link link-hover">Terms of use</a>
        <a class="link link-hover">Privacy policy</a>
        <a class="link link-hover">Cookie policy</a>
    </nav> --}}
    </footer>
</body>
</html>

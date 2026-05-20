<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Title -->
    <title>{{ $seo?->meta_title ?? ($settings?->site_name ?? 'RisingStarChows') . ' | Champion Dog Training & Breeding' }}</title>

    <!-- Favicon -->
    @if($settings?->favicon)
        <link rel="icon" type="image/x-icon" href="{{ asset($settings->favicon) }}">
    @endif

    <!-- Meta Tags -->
    @if($seo?->meta_description)
        <meta name="description" content="{{ $seo->meta_description }}">
    @endif

    @if($seo?->meta_keywords)
        <meta name="keywords" content="{{ $seo->meta_keywords }}">
    @endif

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $seo?->og_title ?? $seo?->meta_title ?? ($settings?->site_name ?? 'RisingStarChows') }}">
    @if($seo?->og_description)
        <meta property="og:description" content="{{ $seo->og_description }}">
    @endif
    @if($seo?->og_image)
        <meta property="og:image" content="{{ asset($seo->og_image) }}">
    @endif

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="{{ $seo?->og_title ?? $seo?->meta_title ?? ($settings?->site_name ?? 'RisingStarChows') }}">
    @if($seo?->og_description)
        <meta property="twitter:description" content="{{ $seo->og_description }}">
    @endif
    @if($seo?->og_image)
        <meta property="twitter:image" content="{{ asset($seo->og_image) }}">
    @endif

    <!-- Google Tag Manager -->
    @if($seo?->google_tag_manager)
        {!! $seo->google_tag_manager !!}
    @endif

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset("css/styles.css") }}">

    @stack('styles')
</head>
<body>
    @include("frontend.partial.header")

    @yield("content")

    @include("frontend.partial.footer")

    <!-- Back to Top Button -->
    <a href="#home" class="back-to-top" id="backToTop">
        <i class="bi bi-arrow-up"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset("js/script.js") }}"></script>

    <!-- Google Analytics -->
    @if($seo?->google_analytics)
        {!! $seo->google_analytics !!}
    @endif

    <!-- Facebook Pixel -->
    @if($seo?->facebook_pixel)
        {!! $seo->facebook_pixel !!}
    @endif

    @stack('scripts')
</body>
</html>

<!-- Footer -->
    <footer class="footer py-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                    <p class="mb-0">
                        {!! $settings->footer_text ?? '&copy; ' . date('Y') . ' ' . ($settings->site_name ?? 'RisingStarChows') . '. All Rights Reserved.' !!}
                    </p>
                </div>
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    @if($settings->facebook || $settings->twitter || $settings->instagram || $settings->linkedin || $settings->youtube)
                        <div class="social-links">
                            @if($settings->facebook)
                                <a href="{{ $settings->facebook }}" target="_blank" class="footer-link me-3" title="Facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            @endif
                            @if($settings->twitter)
                                <a href="{{ $settings->twitter }}" target="_blank" class="footer-link me-3" title="Twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>
                            @endif
                            @if($settings->instagram)
                                <a href="{{ $settings->instagram }}" target="_blank" class="footer-link me-3" title="Instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            @endif
                            @if($settings->linkedin)
                                <a href="{{ $settings->linkedin }}" target="_blank" class="footer-link me-3" title="LinkedIn">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            @endif
                            @if($settings->youtube)
                                <a href="{{ $settings->youtube }}" target="_blank" class="footer-link" title="YouTube">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-md-4 text-center text-md-end">
                    @if($settings->email || $settings->phone)
                        <div class="contact-info">
                            @if($settings->email)
                                <a href="mailto:{{ $settings->email }}" class="footer-link d-block mb-1">
                                    <i class="bi bi-envelope"></i> {{ $settings->email }}
                                </a>
                            @endif
                            @if($settings->phone)
                                <a href="tel:{{ $settings->phone }}" class="footer-link d-block">
                                    <i class="bi bi-telephone"></i> {{ $settings->phone }}
                                </a>
                            @endif
                        </div>
                    @else
                        <a href="#" class="footer-link">Privacy Policy</a>
                        <a href="#" class="footer-link ms-3">Terms of Service</a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

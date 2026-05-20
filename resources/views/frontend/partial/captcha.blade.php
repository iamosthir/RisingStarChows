@php
    $captcha = \App\Support\CaptchaGenerator::make();
    $captchaKey = $key ?? 'default';
    $captchaBag = $bag ?? 'default';
    $captchaInputId = 'captcha_' . $captchaKey;
@endphp
<div class="col-md-12">
    <div class="captcha-box d-flex align-items-center gap-2 mb-2">
        <img src="{{ $captcha['image'] }}" alt="Captcha image" data-captcha-image
             class="captcha-image border rounded" style="height: 70px;">
        <button type="button" class="btn btn-outline-secondary" data-captcha-refresh
                title="Get a new image" aria-label="Refresh captcha">
            <i class="bi bi-arrow-clockwise"></i>
        </button>
    </div>
    <input type="text" class="form-control @error('captcha', $captchaBag) is-invalid @enderror"
           id="{{ $captchaInputId }}" name="captcha" autocomplete="off" spellcheck="false"
           placeholder="Enter the characters from the image" required>
    <input type="hidden" name="captcha_token" value="{{ $captcha['token'] }}" data-captcha-token>
    @error('captcha', $captchaBag)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@once
    @push('scripts')
    <script>
        document.addEventListener('click', function (e) {
            const btn = e.target.closest('[data-captcha-refresh]');
            if (!btn) return;

            const wrapper = btn.closest('.col-md-12');
            const image = wrapper.querySelector('[data-captcha-image]');
            const token = wrapper.querySelector('[data-captcha-token]');

            btn.disabled = true;
            fetch('{{ route('captcha.refresh') }}', { headers: { 'Accept': 'application/json' } })
                .then(response => response.json())
                .then(data => {
                    image.src = data.image;
                    token.value = data.token;
                })
                .catch(() => {})
                .finally(() => { btn.disabled = false; });
        });
    </script>
    @endpush
@endonce

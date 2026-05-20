@php
    $captchaNumA = random_int(1, 9);
    $captchaNumB = random_int(1, 9);
    $captchaKey = $key ?? 'default';
    $captchaInputId = 'captcha_' . $captchaKey;
    $captchaBag = $bag ?? 'default';
@endphp
<div class="col-md-12">
    <label for="{{ $captchaInputId }}" class="form-label">
        Spam Check &mdash; What is {{ $captchaNumA }} + {{ $captchaNumB }}? *
    </label>
    <input type="number"
           class="form-control @error('captcha', $captchaBag) is-invalid @enderror"
           id="{{ $captchaInputId }}"
           name="captcha"
           placeholder="Type the answer to the sum above"
           required>
    <input type="hidden" name="captcha_token"
           value="{{ \Illuminate\Support\Facades\Crypt::encryptString((string) ($captchaNumA + $captchaNumB)) }}">
    @error('captcha', $captchaBag)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

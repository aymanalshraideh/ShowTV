@push('styles')
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

@endpush
<section class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Profile Information') }}</h5>
            <small class="text-muted">{{ __("Update your account's profile information, email address, and profile image.") }}</small>
        </div>

        <div class="card-body">
            <!-- إرسال إعادة التحقق -->
            <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                @csrf
            </form>

            <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('patch')


                <div class="mb-3">
                    <label for="profile_image" class="form-label">{{ __('Profile Image') }}</label>
                    <input type="file" class="form-control sign__input" id="profile_image" name="profile_image" accept="image/*">
                    @error('profile_image')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    <div class="mt-3 text-center">
                        <img id="previewImage"
                             src="{{ $user->profile_image ? asset('storage/'.$user->profile_image) : asset('frontend-asset/img/default-avatar.jpg') }}"
                             alt="Profile Preview"
                             class="rounded-circle border"
                             style="width: 100px; height: 100px; object-fit: cover;">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('Name') }}</label>
                    <input type="text" class="form-control" id="name" name="name"
                           value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>


                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input type="email" class="form-control" id="email" name="email"
                           value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror

                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="mt-2">
                            <p class="text-warning mb-1">{{ __('Your email address is unverified.') }}</p>
                            <button form="send-verification" class="btn btn-link p-0">{{ __('Click here to re-send the verification email.') }}</button>

                            @if (session('status') === 'verification-link-sent')
                                <p class="text-success mt-1">{{ __('A new verification link has been sent to your email address.') }}</p>
                            @endif
                        </div>
                    @endif
                </div>


                <div class="d-flex align-items-center gap-3">
                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                    @if (session('status') === 'profile-updated')
                        <span class="text-success">{{ __('Saved.') }}</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</section>

@push('scripts')
<!-- Bootstrap Bundle JS (with Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('profile_image').addEventListener('change', function(event) {
    let reader = new FileReader();
    let file = event.target.files[0];
    let preview = document.getElementById('previewImage');

    if (file) {
        reader.onload = function(e) {
            preview.src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>
@endpush

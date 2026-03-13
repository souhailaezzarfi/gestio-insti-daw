<x-guest-layout>

    <div class="text-center mb-4">
        <img src="{{ asset('img/logo.png') }}" style="height:80px;" class="mb-2">
        <h3 class="fw-bold">Institut Carles Vallbona</h3>
        <p class="text-muted">Una aposta de futur</p>
    </div>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email</label>
                    <input id="email" type="email" name="email"
                        class="form-control rounded-3 @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-danger small" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Password</label>
                    <input id="password" type="password" name="password"
                        class="form-control rounded-3 @error('password') is-invalid @enderror"
                        required>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-danger small" />
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input id="remember_me" type="checkbox" name="remember" class="form-check-input">
                    <label for="remember_me" class="form-check-label">Remember me</label>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-between align-items-center">
                    @if (Route::has('password.request'))
                    <a class="small text-decoration-none text-primary"
                        href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                    @endif

                    <button class="btn btn-primary px-4 rounded-3">
                        Log in
                    </button>
                </div>

            </form>

        </div>
    </div>

</x-guest-layout>
<x-guest-layout>

    <div class="text-center mb-4">
        <img src="{{ asset('img/logo.png') }}" style="height:80px;" class="mb-5">
        <h3 class="fw-bold">Institut Carles Vallbona</h3>
        <p class="text-muted">Una aposta de futur</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label fw-semibold">Name</label>
            <input id="name" type="text" name="name"
                class="form-control rounded-3 @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required autofocus>
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-danger small" />
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-semibold">Email</label>
            <input id="email" type="email" name="email"
                class="form-control rounded-3 @error('email') is-invalid @enderror"
                value="{{ old('email') }}" required>
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

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                class="form-control rounded-3 @error('password_confirmation') is-invalid @enderror"
                required>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-danger small" />
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <a href="{{ route('login') }}" class="small text-decoration-none text-primary">
                Already registered?
            </a>

            <button class="btn btn-primary px-4 rounded-3">
                Register
            </button>
        </div>

    </form>

</x-guest-layout>
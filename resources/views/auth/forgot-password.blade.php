<x-guest-layout>
    @section('title')
        <title>Lupa Password | Baso Builder</title>
    @endsection
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <img src="{{ asset('assets/img/baso.svg')}}" class="fill-current text-gray-500" style="max-height: 220px; max-width: 220px"/>
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Lupa password? Jangan khawatir, kita akan kirim password baru yang bisa kamu pilih ke email kamu.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

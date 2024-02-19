<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('getcardinfo') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="customer" :value="__('Card Number')" />
            <x-text-input id="customer" class="block mt-1 w-full" type="text" name="customer_card_number"  required autofocus autocomplete="username" />
            
        </div>

       

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Search Information') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>

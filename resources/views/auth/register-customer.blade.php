<x-guest-layout>
    <h2 class="text-lg font-semibold mb-4">Customer Registration</h2>

    <form method="POST" action="{{ route('register.customer') }}">
        @csrf

        <!-- First Name -->
        <div class="mb-4">
            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
            <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}"
                required autofocus
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('first_name')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="mb-4">
            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
            <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}"
                required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('last_name')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}"
                required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('email')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input id="password" type="password" name="password" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('password')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Submit -->
        <div class="flex justify-end">
           <button type="submit" style="background:red;color:white;padding:10px;border:none;border-radius:5px;">
    Register
</button>
        </div>
    </form>
</x-guest-layout>

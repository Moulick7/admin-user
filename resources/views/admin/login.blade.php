<x-guest-layout>
    <h2 class="text-lg font-semibold mb-4">Admin Login</h2>

    <form method="POST" action="{{ route('admin.login.submit') }}">
        @csrf

        <!-- Email -->
        <div class="mb-4">
            <label for="email">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('email')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('password')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit -->
        <div>
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Login
            </button>
        </div>
    </form>
</x-guest-layout>

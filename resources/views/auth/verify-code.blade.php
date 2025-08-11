<x-guest-layout>
    <h2 class="text-lg font-semibold mb-4">Verify Code</h2>

    <form method="POST" action="{{ route('verification.code.verify') }}">
        @csrf
        <div class="mb-4">
            <input type="hidden" name="email" value="{{ $email }}">

            <label for="code" class="block text-sm font-medium text-gray-700">Enter Verification Code</label>
            <input id="code" type="text" name="code" required
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @error('code')
                <div class="text-red-600 text-sm">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" style="background:red;color:white;padding:10px;border:none;border-radius:5px;">
    Register
</button>
        </div>
    </form>
</x-guest-layout>

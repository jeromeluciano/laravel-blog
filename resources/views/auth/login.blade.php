<x-layout>
    <div class="max-w-lg mx-auto bg-gray-100 p-8 rounded-xl border border-gray-200 my-8">
        <h1 class="text-center font-bold text-gray-700">Login</h1>
        <form method="post" action="/sessions" class="space-y-4">
            @csrf

            <div class="mb-2">
                <label for="email" class="block text-xs font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="block w-full p-2 border border-gray-200 rounded-xl">
                @error('email')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-2">
                <label for="password" class="block text-xs font-semibold text-gray-700 mb-2">Password</label>
                <input type="password" id="password" name="password" value="{{ old('password') }}" class="block w-full p-2 border border-gray-200 rounded-xl">
                @error('password')
                    <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button class="bg-blue-500 font-bold text-sm text-white py-2 px-4 rounded-md hover:bg-blue-600">
                Submit
            </button>
        </form>
    </div>
</x-layout>

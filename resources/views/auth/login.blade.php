<x-layout>
    <div class="max-w-lg mx-auto p-8 rounded-xl my-8">
        <x-panel>
            <h1 class="text-center font-bold text-gray-700">Login</h1>
            <form method="post" action="/sessions" class="space-y-4">
                @csrf

                <x-form.input name="email" type="email" autocomplete="username"/>

                <x-form.input name="password" type="password" autocomplete="current-password"/>

                <x-form.button>Submit</x-form.button>
            </form>
        </x-panel>
    </div>
</x-layout>

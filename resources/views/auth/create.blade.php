<x-layout>
    <div class="max-w-lg mx-auto p-8 rounded-xl">
        <x-panel>
            <h1 class="text-center font-bold text-gray-700">Register</h1>

            <form method="post" action="/register" class="space-y-4">
                @csrf

                <x-form.input name="name"/>

                <x-form.input name="email" type="email"/>

                <x-form.input name="password" type="password"/>

                <x-form.button>Submit</x-form.button>
            </form>
        </x-panel>
    </div>
</x-layout>

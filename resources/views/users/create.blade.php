<x-app-layout>
    <div class="max-w-xl mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Add User</h2>

        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <label>Name</label>
            <input type="text" name="name" class="w-full p-2 border">
            @error('name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label class="mt-3 block">Email</label>
            <input type="email" name="email" class="w-full p-2 border">
            @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <label class="mt-3 block">Password</label>
            <input type="password" name="password" class="w-full p-2 border">
            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror

            <button class="mt-4 px-4 py-2 bg-red-600 text-white rounded">
                Save
            </button>
        </form>
    </div>
</x-app-layout>

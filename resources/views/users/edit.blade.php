<x-app-layout>
    <div class="max-w-xl mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Edit User</h2>

        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <label>Name</label>
            <input type="text" name="name" class="w-full p-2 border" value="{{ $user->name }}">

            <label class="mt-3 block">Email</label>
            <input type="email" name="email" class="w-full p-2 border" value="{{ $user->email }}">

            <label class="mt-3 block">Password (optional)</label>
            <input type="password" name="password" class="w-full p-2 border">

            <button class="mt-4 px-4 py-2 bg-yellow-600 text-white rounded">
                Update
            </button>
        </form>
    </div>
</x-app-layout>

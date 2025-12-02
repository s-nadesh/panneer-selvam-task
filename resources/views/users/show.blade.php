<x-app-layout>
    <div class="max-w-xl mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">User Details</h2>

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p class="mt-2"><strong>Email:</strong> {{ $user->email }}</p>

        <a href="{{ route('users.index') }}" 
           class="mt-4 inline-block px-4 py-2 bg-gray-500 text-white rounded">
            Back
        </a>
    </div>
</x-app-layout>

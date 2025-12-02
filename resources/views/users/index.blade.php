<x-app-layout>
    <div class="max-w-7xl mx-auto py-6">
        <h2 class="text-2xl font-bold mb-4">Users List</h2>

        <a href="{{ route('users.create') }}" 
           class="px-4 py-2 bg-red-600 text-white rounded">
            Add User
        </a>

        @if(session('success'))
            <p class="mt-3 text-green-600">{{ session('success') }}</p>
        @endif

        <table class="w-full mt-6 border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">ID</th>
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Email</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->id }}</td>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">
                            <a href="{{ route('users.show', $user) }}" class="text-blue-600">View</a>
                            <a href="{{ route('users.edit', $user) }}" class="text-yellow-600 ml-2">Edit</a>
                            <form action="{{ route('users.destroy', $user) }}" 
                                  method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-2"
                                        onclick="return confirm('Delete user?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    </div>
</x-app-layout>

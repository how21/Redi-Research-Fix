<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" bg-white shadow-md rounded-lg p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">List Users</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse border border-gray-300 text-sm sm:text-base">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="border border-gray-300 px-4 py-2">nama</th>
                                    <th class="border border-gray-300 px-4 py-2">email</th>
                                    <th class="border border-gray-300 px-4 py-2">role</th>
                                    <th class="border border-gray-300 px-4 py-2">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="text-center">
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->role}}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            <!-- Tombol Hapus (Hanya muncul jika bukan super_admin) -->
                                            @if ($user->role !== 'super_admin')
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" 
                                                    onsubmit="return confirm('Hapus user ini?')" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="px-3 py-1 bg-red-500 text-white rounded">Hapus</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

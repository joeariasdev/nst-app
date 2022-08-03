<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users List') }}
        </h2>
    </x-slot>

    @include('partials.alert')

    <div class="py-8">
        <div class="flex justify-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="w-full">
                    <label for="user-table-search" class="sr-only">Search</label>
                    <div class="flex flex-wrap justify-between items-center">
                        <form method="GET">
                            <input value="{{request()->get('filter')}}"
                                   type="text"
                                   name="filter"
                                   id="user-table-search"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5"
                                   placeholder="Search for users">
                        </form>
                        <a href="{{ route('user.create') }}" class="text-white bg-indigo-600 hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Add User</a>
                    </div>
                    <div class="border-b border-gray-200 shadow mt-4">
                        <table>
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    ID
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Name
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Rol
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Email
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Created At
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Edit
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Delete
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @foreach ($users as $user)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $user->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <a class="text-indigo-800 underline cursor-pointer" href="{{ route('user.show', $user->id) }}">
                                                {{ $user->name}}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            @isset( $user->roles[0]->name )
                                                {{ $user->roles[0]->name}}
                                            @endisset
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">
                                            {{ $user->email}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $user->created_at->format('j \o\f F, Y g:i:s a') }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @can('have_access','user.edit')
                                            <a href="{{ route('user.edit', $user->id)}}" class="px-4 py-1 text-sm text-white bg-indigo-600 rounded">Edit</a>
                                        @endcan
                                    </td>
                                    <td class="px-6 py-4">
                                        @can('have_access','user.destroy')
                                            <button
                                                data-url="{!! route('user.destroy', $user->id) !!}"
                                                data-entity="User"
                                                data-item="{{ $user->name }}"
                                                type="button"
                                                class="px-4 py-1 text-sm text-white bg-red-700 rounded open-delete-modal"
                                            >Delete</button>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.delete_modal')
</x-app-layout>

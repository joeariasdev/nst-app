<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Device List') }}
        </h2>
    </x-slot>

    @include('partials.alert')

    <div class="py-8">
        <div class="flex justify-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="w-full">
                    <label for="device-table-search" class="sr-only">Search</label>
                    <div class="flex flex-wrap justify-between items-center">
                        <form method="GET">
                            <input value="{{request()->get('filter')}}"
                                   type="text"
                                   name="filter"
                                   id="device-table-search"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5"
                                   placeholder="Search for devices">
                        </form>
                        <a href="{{ route('device.create') }}" class="text-white bg-indigo-600 hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Add Device</a>
                    </div>
                    <div class="border-b border-gray-200 shadow mt-4">
                        <table class="text-center">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    ID
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Serial
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Type
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Description
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Client
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
                            @forelse ($devices as $device)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $device->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <a class="text-indigo-800 underline cursor-pointer" href="{{ route('device.show', $device->id) }}">
                                                {{ $device->serial}}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{ $device->type }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">
                                            {{ Str::limit($device->description, 15)  }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $device->client->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('device.edit', $device->id)}}" class="px-4 py-1 text-sm text-white bg-indigo-600 rounded">Edit</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <button
                                            data-url="{!! route('device.destroy', $device->id) !!}"
                                            data-entity="Device"
                                            data-item="{{ $device->serial }}"
                                            type="button"
                                            class="px-4 py-1 text-sm text-white bg-red-700 rounded open-delete-modal"
                                        >Delete</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="px-6 py-4 text-sm">
                                        <p class="text-gray-900 text-center whitespace-no-wrap">
                                            No Devices found
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $devices->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.delete_modal')
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Orders List') }}
        </h2>
    </x-slot>

    @include('partials.alert')

    <div class="py-8">
        <div class="flex justify-center max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="w-full">
                    <label for="order-table-search" class="sr-only">Search</label>
                    <div class="flex flex-wrap justify-between items-center">
                        <form method="GET">
                            <input value="{{request()->get('filter')}}"
                                   type="text"
                                   name="filter"
                                   id="order-table-search"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-80 pl-10 p-2.5"
                                   placeholder="Search for orders">
                        </form>
{{--                        <a href="{{ route('device.create') }}" class="text-white bg-indigo-600 hover:bg-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 font-medium rounded-full text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-800">Create Order</a>--}}
                    </div>
                    <div class="border-b border-gray-200 shadow mt-4">
                        <table class="text-center">
                            <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Code
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Client
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Subsidiary
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Created At
                                </th>
                                <th class="px-6 py-2 text-xs text-gray-500">
                                    Manage
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white">
                            @forelse ($orders as $order)
                                <tr class="whitespace-nowrap">
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <a class="text-indigo-800 underline cursor-pointer" href="{{ route('order.show', $order->id) }}">
                                                {{ $order->code}}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $order->client->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            {{ $order->subsidiary->name }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-500">
                                            {{ $order->created_at->format('j \o\f F, Y g:i:s a') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('order.edit', $order->id)}}" class="px-4 py-1 text-sm text-white bg-indigo-600 rounded">Manage</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="100%" class="px-6 py-4 text-sm">
                                        <p class="text-gray-900 text-center whitespace-no-wrap">
                                            No Orders found
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.delete_modal')
</x-app-layout>

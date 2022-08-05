<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details: ') . $order->client->name }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">{{ __('Order Number: ') . $order->code }}</p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Order Information</h3>
                        <p class="mt-1 text-sm text-gray-600">Check Order details</p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-3 sm:col-span-3">
                                    <label for="identification" class="block text-sm font-medium text-gray-700">Order Code</label>
                                    <p>{{ $order->code }}</p>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <label for="identification" class="block text-sm font-medium text-gray-700">Device Serial</label>
                                    <p>{{ $orderDetails[0]->device->serial }}</p>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Created At</label>
                                    {{ $order->created_at->format('j \o\f F, Y g:i:s a') }}
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Device Type</label>
                                    <p>{{ $orderDetails[0]->device->type }}</p>
                                </div>
                                <div class="overflow-x-auto relative col-span-6 sm:col-span-6">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="py-3 px-6">
                                                    Status
                                                </th>
                                                <th scope="col" class="py-3 px-6">
                                                    Date
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse ($orderDetails as $orderDetail)
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td class="py-4 px-6">
                                                    {{ $orderDetail->status }}
                                                </td>
                                                <td class="py-4 px-6">
                                                    {{ $orderDetail->created_at->format('j \o\f F, Y g:i:s a') }}
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%" class="px-6 py-4 text-sm">
                                                    <p class="text-gray-900 text-center whitespace-no-wrap">
                                                        No Details for this Order
                                                    </p>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6 flex justify-end">
                            <a href="{{ route('order.edit', $order->id)}}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Manage</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

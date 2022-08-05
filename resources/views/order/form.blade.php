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
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Manage Order</h3>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ $orderDetail->status != "complete" ? route('order.update', $order->id) : ''}}"
                          autocomplete="off"
                          method="POST">
                        @csrf
                        @if ($order->id)
                            @method('PUT')
                        @endif
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-6">
                                        <h3 class="text-lg font-medium leading-6 text-gray-900">Last Update</h3>
                                    </div>

                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="identification" class="block text-sm font-medium text-gray-700">Order Code</label>
                                        <p>{{ $order->code }}</p>
                                    </div>

                                    <div class="col-span-3 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Order Last Status</label>
                                        {{ Str::upper($orderDetail->status) }}
                                    </div>

                                    <div class="col-span-3 sm:col-span-3">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Date</label>
                                        {{ $orderDetail->created_at->format('j \o\f F, Y g:i:s a') }}
                                    </div>

                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                        <p class="text-xs italic">
                                            @if(is_null($orderDetail->description))
                                                No description
                                            @else
                                                {{$orderDetail->description}}
                                            @endif
                                        </p>
                                    </div>
                                    @if($orderDetail->status != "complete")
                                        <div class="col-span-6 sm:col-span-3">
                                            <label for="status" class="block text-sm font-medium text-gray-700">New Status</label>
                                            <select
                                                id="status"
                                                name="status"
                                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('status') border-red-500 @enderror"
                                            >
                                                <option value="inspection">
                                                    {{ Str::upper("inspection") }}
                                                </option>
                                                <option value="diagnosis">
                                                    {{ Str::upper("diagnosis") }}
                                                </option>
                                                <option value="recovery">
                                                    {{ Str::upper("recovery") }}
                                                </option>
                                                <option value="complete">
                                                    {{ Str::upper("complete") }}
                                                </option>
                                            </select>
                                            @error('status')
                                            <p class="text-red-500 text-xs italic">
                                                {{ $message }}
                                            </p>
                                            @enderror
                                        </div>
                                        <div class="col-span-6 sm:col-span-6">
                                            <label for="description" class="block text-sm font-medium text-gray-700">New Description</label>
                                            <textarea
                                                type="text"
                                                rows="3"
                                                name="description" id="description"
                                                class="mt-1 block w-full py-2 px-3 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                @if($orderDetail->status != "complete")
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

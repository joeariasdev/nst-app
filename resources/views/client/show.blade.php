<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Client Details: ') . $client->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Client Information</h3>
                        <p class="mt-1 text-sm text-gray-600">Check Client details</p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-6">
                                    <label for="identification" class="block text-sm font-medium text-gray-700">Identification</label>
                                    <p>{{ $client->identification }}</p>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                                    <p>{{ $client->name }}</p>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                    <p>{{ $client->address }}</p>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <p>{{ $client->phone_number }}</p>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <p>{{ $client->email }}</p>
                                </div>

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <a href="{{ route('client.edit', $client->id) }}" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Edit</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

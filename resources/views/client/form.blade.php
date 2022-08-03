<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ! $client->id ? __('Create Client') : 'Client: ' .  $client->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Client Information</h3>
                        <p class="mt-1 text-sm text-gray-600">Manage the system clients</p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ ! $client->id ? route('client.store') : route('client.update', $client->id)}}"
                          autocomplete="off"
                          method="POST">
                        @csrf
                        @if ($client->id)
                            @method('PUT')
                        @endif
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="identification" class="block text-sm font-medium text-gray-700">Identification</label>
                                        <input type="text"
                                               name="identification"
                                               id="identification"
                                               value="{{ old('identification', $client->identification)}}"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('identification') border-red-500 @enderror"
                                        >
                                        @error('identification')
                                        <p class="text-red-500 text-xs italic">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               value="{{ old('name', $client->name)}}"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror"
                                        >
                                        @error('name')
                                        <p class="text-red-500 text-xs italic">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                                        <input type="text"
                                               name="address"
                                               id="address"
                                               value="{{ old('address', $client->address)}}"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('address') border-red-500 @enderror"
                                        >
                                        @error('address')
                                        <p class="text-red-500 text-xs italic">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                        <input
                                            type="text"
                                            name="phone_number" id="phone_number"
                                            value="{{ old('phone_number', $client->phone_number)}}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('phone_number') border-red-500 @enderror"
                                        >
                                        @error('phone_number')
                                        <p class="text-red-500 text-xs italic">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                        <input
                                            type="text"
                                            name="email" id="email"
                                            value="{{ old('email', $client->email)}}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror"
                                        >
                                        @error('email')
                                        <p class="text-red-500 text-xs italic">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    {{--<div class="col-span-6">
                                        <label for="street-address" class="block text-sm font-medium text-gray-700">Street address</label>
                                        <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                        <input type="text" name="city" id="city" autocomplete="address-level2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="region" class="block text-sm font-medium text-gray-700">State / Province</label>
                                        <input type="text" name="region" id="region" autocomplete="address-level1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>

                                    <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                        <label for="postal-code" class="block text-sm font-medium text-gray-700">ZIP / Postal code</label>
                                        <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    </div>--}}
                                </div>
                            </div>
                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

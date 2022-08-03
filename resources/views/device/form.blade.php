<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ! $device->id ? __('Create Device') : 'Device: ' .  $device->serial}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Device Information</h3>
                        <p class="mt-1 text-sm text-gray-600">Manage the system devices</p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ ! $device->id ? route('device.store') : route('device.update', $device->id)}}"
                          autocomplete="off"
                          method="POST">
                        @csrf
                        @if ($device->id)
                            @method('PUT')
                        @endif
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="type" class="block text-sm font-medium text-gray-700">Device Type</label>
                                        <select
                                            id="type"
                                            name="type"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('type') border-red-500 @enderror">
                                            @foreach(["SSD" => "SSD", "HDD" => "HDD"] as $type => $label)
                                                <option value="{{ $type }}" {{ old("type", $device->type) == $type ? "selected" : "" }}>
                                                    {{ $label }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <p class="text-red-500 text-xs italic">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="serial" class="block text-sm font-medium text-gray-700">Serial</label>
                                        <input type="text"
                                               name="serial"
                                               id="serial"
                                               value="{{ old('serial', $device->serial)}}"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('serial') border-red-500 @enderror"
                                        >
                                        @error('serial')
                                        <p class="text-red-500 text-xs italic">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="client_id" class="block text-sm font-medium text-gray-700">Client</label>
                                        <select
                                            id="client_id"
                                            name="client_id"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('client_id') border-red-500 @enderror"
                                        >
                                            @foreach($clients as $id => $client)
                                                <option value="{{ $id }}" {{ old("client_id", $device->client_id) == $id ? "selected" : "" }}>
                                                    {{ $client }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
                                        <p class="text-red-500 text-xs italic">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="description" class="block text-sm font-medium text-gray-700">Device Description</label>
                                        <textarea
                                            type="text"
                                            rows="3"
                                            name="description" id="description"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('description') border-red-500 @enderror"
                                        >
                                            {{ old('description') ?: $device->description }}
                                        </textarea>
                                        @error('description')
                                        <p class="text-red-500 text-xs italic">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                    </div>
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

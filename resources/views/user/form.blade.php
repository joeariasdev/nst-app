<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ ! $user->id ? __('Create User') : 'User: ' .  $user->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">User Information</h3>
                        <p class="mt-1 text-sm text-gray-600">Manage the system users</p>
                    </div>
                </div>
                <div class="mt-5 md:mt-0 md:col-span-2">
                    <form action="{{ ! $user->id ? route('user.store') : route('user.update', $user->id)}}"
                          autocomplete="off"
                          method="POST">
                        @csrf
                        @if ($user->id)
                            @method('PUT')
                        @endif
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-6">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Full name</label>
                                        <input type="text"
                                               name="name"
                                               id="name"
                                               value="{{ old('name', $user->name)}}"
                                               class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('name') border-red-500 @enderror"
                                        >
                                        @error('name')
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
                                            value="{{ old('email', $user->email)}}"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('email') border-red-500 @enderror"
                                        >
                                        @error('email')
                                            <p class="text-red-500 text-xs italic">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        <input
                                            type="text"
                                            name="password" id="password"
                                            class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md @error('password') border-red-500 @enderror"
                                        >
                                        @error('password')
                                            <p class="text-red-500 text-xs italic">
                                                {{ $message }}
                                            </p>
                                        @enderror
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                        <select
                                            id="role"
                                            name="role"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('role') border-red-500 @enderror"
                                        >
                                            @foreach($roles as $id => $role)
                                                <option value="{{ $id }}"
                                                    @if(isset($user->roles[0]->name))
                                                        {{ $user->roles[0]->id || (int) old('role') === $id ? 'selected' : ''}}
                                                    @else(! $user->id)
                                                        {{ (int) old('role') === $id ? 'selected' : ''}}
                                                    @endif
                                                >
                                                    {{ $role }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('role')
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

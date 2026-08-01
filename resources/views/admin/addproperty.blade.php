<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Property') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Add a New Property') }}</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Fill in the details below to publish a new property.') }}</p>
                </div>
                <a href="{{ route('admin.properties') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-gray-600 transition hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
                    </svg>
                    {{ __('Back to Properties') }}
                </a>
            </div>

            @if ($errors->any())
                <div class="mb-6 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700 dark:border-red-900 dark:bg-red-900/30 dark:text-red-300">
                    <p class="font-medium">{{ __('Please fix the following errors:') }}</p>
                    <ul class="mt-2 list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.properties.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ __('Basic Information') }}</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" class="mt-1 block w-full" type="text" name="title" :value="old('title')" required autofocus />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="5" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-600">{{ old('description') }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="category_id" :value="__('Category')" />
                            <select id="category_id" name="category_id" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="">{{ __('Select a category') }}</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="price" :value="__('Price (DZD)')" />
                            <x-text-input id="price" class="mt-1 block w-full" type="number" step="0.01" min="0" name="price" :value="old('price')" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="city" :value="__('City')" />
                            <x-text-input id="city" class="mt-1 block w-full" type="text" name="city" :value="old('city')" />
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="state" :value="__('State / Province')" />
                            <x-text-input id="state" class="mt-1 block w-full" type="text" name="state" :value="old('state')" />
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="area" :value="__('Area (m²)')" />
                            <x-text-input id="area" class="mt-1 block w-full" type="number" step="0.01" min="0" name="area" :value="old('area')" />
                            <x-input-error :messages="$errors->get('area')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="bedrooms" :value="__('Bedrooms')" />
                            <x-text-input id="bedrooms" class="mt-1 block w-full" type="number" min="0" name="bedrooms" :value="old('bedrooms')" />
                            <x-input-error :messages="$errors->get('bedrooms')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="bathrooms" :value="__('Bathrooms')" />
                            <x-text-input id="bathrooms" class="mt-1 block w-full" type="number" min="0" name="bathrooms" :value="old('bathrooms')" />
                            <x-input-error :messages="$errors->get('bathrooms')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ __('Listing Details') }}</h3>
                    </div>
                    <div class="p-6 space-y-6">
                        <div>
                            <x-input-label :value="__('Status')" />
                            <div class="mt-2 flex items-center gap-6">
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="for sale" {{ old('status', 'for sale') === 'for sale' ? 'checked' : '' }} class="rounded-full border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-900">
                                    <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">{{ __('For Sale') }}</span>
                                </label>
                                <label class="inline-flex items-center">
                                    <input type="radio" name="status" value="for rent" {{ old('status') === 'for rent' ? 'checked' : '' }} class="rounded-full border-gray-300 text-sky-600 shadow-sm focus:ring-sky-500 dark:border-gray-700 dark:bg-gray-900">
                                    <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">{{ __('For Rent') }}</span>
                                </label>
                            </div>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-8">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded border-gray-300 text-amber-500 shadow-sm focus:ring-amber-500 dark:border-gray-700 dark:bg-gray-900">
                                <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Featured') }}</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }} class="rounded border-gray-300 text-emerald-500 shadow-sm focus:ring-emerald-500 dark:border-gray-700 dark:bg-gray-900">
                                <span class="ms-2 text-sm text-gray-700 dark:text-gray-300">{{ __('Active') }}</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ __('Images') }}</h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="main_image" :value="__('Main Image')" />
                            <input id="main_image" type="file" name="main_image" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/40 dark:file:text-blue-300">
                            <x-input-error :messages="$errors->get('main_image')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="additional_images" :value="__('Additional Images')" />
                            <input id="additional_images" type="file" name="additional_images[]" multiple accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" class="mt-1 block w-full text-sm text-gray-700 dark:text-gray-300 file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-medium file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-blue-900/40 dark:file:text-blue-300">
                            <x-input-error :messages="$errors->get('additional_images')" class="mt-2" />
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4">
                    <a href="{{ route('admin.properties') }}" class="inline-flex items-center rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-200 dark:hover:bg-gray-600">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-blue-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        {{ __('Add Property') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

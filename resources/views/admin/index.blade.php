<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">
                    {{ __('Welcome back,') }} {{ Auth::user()->name }}!
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ now()->translatedFormat('l j F Y') }}
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-gradient-to-br from-blue-500 to-indigo-600 dark:from-blue-600 dark:to-indigo-700 rounded-xl shadow-md p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-blue-100">{{ __('Properties') }}</p>
                        <p class="mt-2 text-4xl font-extrabold text-white">{{ $nombreProperty }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-violet-500 to-purple-600 dark:from-violet-600 dark:to-purple-700 rounded-xl shadow-md p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-violet-100">{{ __('Users') }}</p>
                        <p class="mt-2 text-4xl font-extrabold text-white">{{ $nombreUser }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-amber-400 to-orange-500 dark:from-amber-500 dark:to-orange-600 rounded-xl shadow-md p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-amber-100">{{ __('Categories') }}</p>
                        <p class="mt-2 text-4xl font-extrabold text-white">{{ $nombreCategory }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                        </svg>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-emerald-500 to-teal-600 dark:from-emerald-600 dark:to-teal-700 rounded-xl shadow-md p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-emerald-100">{{ __('Messages') }}</p>
                        <p class="mt-2 text-4xl font-extrabold text-white">{{ $nombreContact }}</p>
                        @if ($unreadMessages > 0)
                            <p class="mt-1 text-xs font-medium text-emerald-100">{{ __(':count unread', ['count' => $unreadMessages]) }}</p>
                        @endif
                    </div>
                    <div class="w-14 h-14 rounded-full bg-white/20 flex items-center justify-center">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ __('Latest Properties') }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700 dark:bg-blue-900/50 dark:text-blue-300">
                            {{ $nombreProperty }}
                        </span>
                    </div>
                    <div class="p-6">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($lastProperties as $property)
                            <li class="py-4 flex items-center gap-4">
                                <img
                                    src="{{ $property->main_image ? asset('storage/' . $property->main_image) : 'https://placehold.co/600x400/1e3a8a/ffffff?text=Dream+Nest' }}"
                                    alt="{{ $property->title }}"
                                    class="w-14 h-14 rounded-lg object-cover shrink-0"
                                >
                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-medium text-gray-900 dark:text-gray-100">{{ $property->title }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $property->city }}</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">{{ number_format($property->price, 0, ',', ' ') }} DZD</p>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $property->status === 'for sale' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/50 dark:text-emerald-300' : 'bg-sky-100 text-sky-700 dark:bg-sky-900/50 dark:text-sky-300' }}">
                                        {{ $property->status === 'for sale' ? __('For Sale') : __('For Rent') }}
                                    </span>
                                </div>
                            </li>
                        @empty
                            <li class="py-4 text-gray-500 dark:text-gray-400">{{ __('No properties yet.') }}</li>
                        @endforelse
                    </ul>
                    <!-- Add a link to view all properties -->
                    <div class="mt-4 text-right">
                        <a href="{{ route('admin.properties') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                            {{ __('View All Properties') }}
                        </a>
                    </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ __('Latest Users') }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-violet-100 text-violet-700 dark:bg-violet-900/50 dark:text-violet-300">
                            {{ $nombreUser }}
                        </span>
                    </div>
                    <div class="p-6">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($lastusers as $user)
                            <li class="py-4 flex items-center gap-4">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-500 to-purple-600 flex items-center justify-center text-white text-sm font-semibold shrink-0">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-medium text-gray-900 dark:text-gray-100">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $user->email }}</p>
                                </div>
                                <p class="text-xs text-gray-400 dark:text-gray-500 shrink-0">{{ $user->created_at->diffForHumans() }}</p>
                            </li>
                        @empty
                            <li class="py-4 text-gray-500 dark:text-gray-400">{{ __('No users yet.') }}</li>
                        @endforelse
                    </ul>

                    
                    <!-- Add a link to view all users -->
                    <div class="mt-4 text-right px-6 pb-6">
                        <a href="{{ route('admin.users') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500 dark:text-blue-400 dark:hover:text-blue-300">
                            {{ __('View all users') }}
                        </a>
                    </div>
                </div>
                </div>

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-md rounded-xl">
                    <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                        <h3 class="font-semibold text-gray-900 dark:text-gray-100">{{ __('Latest Categories') }}</h3>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-700 dark:bg-amber-900/50 dark:text-amber-300">
                            {{ $nombreCategory }}
                        </span>
                    </div>
                    <div class="p-6">
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($lastcategories as $category)
                            <li class="py-4 flex items-center gap-4">
                                <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center shrink-0">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-medium text-gray-900 dark:text-gray-100">{{ $category->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $category->description }}</p>
                                </div>
                                <p class="text-xs text-gray-400 dark:text-gray-500 shrink-0">{{ $category->properties_count }} {{ Str::plural(__('property'), $category->properties_count) }}</p>
                            </li>
                        @empty
                            <li class="py-4 text-gray-500 dark:text-gray-400">{{ __('No categories yet.') }}</li>
                        @endforelse
                    </ul>
                   
                    <!-- Add a link to view all categories -->
                    <div class="mt-4 text-right px-6 pb-6">
                        <a href="{{ route('admin.categories') }}" class="text-sm font-medium text-amber-600 hover:text-amber-500 dark:text-amber-400 dark:hover:text-amber-300">
                            {{ __('View all categories') }}
                        </a>
                    </div> 
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

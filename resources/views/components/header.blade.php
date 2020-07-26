<header class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto py-3 sm:py-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <h1 class="text-xl sm:text-3xl font-bold leading-tight text-gray-900 ">
                {{ $slot }}
                @isset($subtitle)
                {{ $subtitle }}
                @endisset
            </h1>
            @isset($button)
            {{ $button }}
            @endisset
        </div>
    </div>
</header>
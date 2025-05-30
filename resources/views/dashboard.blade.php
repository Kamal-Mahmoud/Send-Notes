<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="p-6 text-gray-900">
                {{-- {{ __("You're logged in!") }} <br/>
                    <div class="mt-4">
                        <livewire:dashboardstats />
                    </div> --}}
                <livewire:dashboardstats />
            </div>

        </div>
    </div>
</x-app-layout>

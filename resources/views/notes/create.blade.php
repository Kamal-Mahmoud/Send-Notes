<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Create a Note') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-2xl mx-auto space-x-3 space-y-4 sm:px-6 lg:px-8">
            <x-button primary icon='arrow-left' class="mb-8 ml-3" href="{{ route('notes.index') }}">All Notes</x-button>
            <livewire:notes.create-note />
        </div>
    </div>
</x-app-layout>

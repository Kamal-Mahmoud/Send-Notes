<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public $search = '';

    public function with()
    {
        $results = [];
        if (strlen($this->search) > 3) {
            $results = Auth::user()
                ->notes()
                ->where('title', 'like', '%' . $this->search . '%')
                ->get();
        }
        return ['results' => $results];
    }
}; ?>

<div>

    {{-- <div class="relative max-w-lg px-1 pt-1 w-96">
        <input wire:model.live.throttle.150ms='search' placeholder="Search By Note Title .." type="text"
            class="flex-1 block w-full px-3 py-2 mt-2 rounded-md outline-none border-inherit bg-slate-100" />

        <div class="absolute w-full mt-2 mb-12 overflow-hidden rounded-md">

            @foreach ($results as $result)
            
                <div class="px-3 py-2 bg-gray-200 cursor-pointer hover:bg-slate-100" wire:key="{{ $result->id }}">
                    <a href="{{ route('notes.view', $result) }}" wire:navigate interaction="positive"
                        class="">{{ $result->title }} </a>
                </div>
            @endforeach

        </div>
    </div> --}}

    <div class="flex items-center justify-center px-2 flex-1p-5 lg:ml-6 lg:justify-end">
        <div class="w-full max-w-lg lg:max-w-xs">
            <label for="search" class="sr-only">Search for Notes</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input wire:model.live.throttle.150ms='search' id="search"
                    class="block w-full py-2 pl-10 pr-3 leading-5 placeholder-gray-500 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md focus:outline-none focus:placeholder-gray-400 focus:border-blue-300 focus:shadow-outline-blue sm:text-sm"
                    placeholder="Search for Notes..." type="search" autocomplete="off">
                @if (strlen($search) > 2)
                    <ul
                        class="absolute z-50 w-full mt-2 text-sm text-gray-700 bg-white border border-gray-300 divide-y divide-gray-200 rounded-md">
                        @forelse ($results as $result)
                            <li>
                                <div class="px-3 py-2 space-y-2 bg-gray-200 cursor-pointer hover:bg-slate-100"
                                    wire:key="{{ $result->id }}">
                                    <a href="{{ route('notes.view', $result) }}" wire:navigate
                                        class="flex items-center px-4 py-4 font-semibold transition duration-150 ease-in-out">
                                        {{ $result->title }}
                                    </a>
                                </div>
                            </li>
                        @empty
                            <li class="px-4 py-4">No results found for "{{ $search }}"</li>
                        @endforelse
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>

<?php

use Livewire\WithPagination;
use Livewire\Volt\Component;
use App\Models\Note;
new class extends Component {
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
    }
    use WithPagination;
    public function with()
    {
        // with = render = every time you call
        return [
            'notes' => Auth::user()->notes()->latest()->paginate(12),
        ];
    }
    public function placeholder()
    {
        return <<<'HTML'
                <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
        HTML;
    }
}; ?>
<div>
    <div class="space-y-7 ">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bold ">No Notes Yet</p>
                <p class="mt-2 text-sm">Let's Create Your First Note To Send ..</p>
                <x-button class="" rose icon-right="plus" class="" href="{{ route('notes.create') }}"
                    wire:navigate>
                    Create Note</x-button>
            </div>
        @else
            <div class="flex justify-between">
                <div class="">
                    <x-button rose icon-right="plus" href="{{ route('notes.create') }}" wire:navigate>
                        Create Note </x-button>
                </div>

                <livewire:searchnotes class= />
            </div>

            <div class="grid grid-cols-3 gap-4 mt-16">
                @foreach ($notes as $note)
                    <x-card wire:key="{{ $note->id }}">
                        <div class="flex justify-between">
                            <div>
                                @can('update', $note)
                                    <a href="{{ route('notes.edit', $note) }}" wire:navigate
                                        class="text-xl font-bold hover:underline hover:text-blue-500">
                                        {{ $note->title }}
                                    </a>
                                @else
                                    <p class="text-xl font-bold text-gray-500">{{ $note->title }}</p>
                                @endcan
                                <p class="mt-2 text-xs">{{ Str::limit($note->body, 80) }}</p>
                            </div>
                            <div class="mt-2 text-xs text-gray-500 single-line">
                                {{ \Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}
                            </div>
                        </div>
                        <div class="flex items-end justify-between mt-4 space-x-1">
                            <p class="text-xs ">Reciptionist: <span class="font-semibold ">{{ $note->recipient }}</span>
                            </p>
                            <div>
                                <x-mini-button href="{{ route('notes.view', $note) }}" rounded icon="eye" gray
                                    interaction="positive" class="p-3" />
                                <x-mini-button rounded icon="trash" gray interaction="negative"
                                    wire:click="delete('{{ $note->id }}')" />
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @endif
        <div class="mt-8">
            {{ $notes->links() }}
        </div>

    </div>
</div>

<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note; // انا باعت النوت كلها فانا بعملها ككوووول هنا
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $note_is_published;

    public function mount(Note $note)
    {
        // mount = constructor.. accepting things // collect infomation sent & set the state.
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date;
        $this->note_is_published = $note->is_published;
    }
    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => 'required|string|min:5',
            'noteBody' => 'required|string|min:10',
            'noteRecipient' => 'required|email',
            'noteSendDate' => 'required|date',
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->note_is_published,
        ]);
        $this->dispatch('note-saved');
    }
}; ?>


<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Notes') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="max-w-2xl mx-auto space-x-3 space-y-4 sm:px-6 lg:px-8">
        <form wire:submit='saveNote' class="space-y-3 ">
            <x-input wire:model='noteTitle' label='Note Title' placeholder="It's A Great Day" />
            <x-textarea wire:model='noteBody' label='Your Note' placeholder="Share Sll Your Thoughts" />
            <x-input icon="user" wire:model='noteRecipient' label='Recipient' type='email'
                placeholder="yourfriend@emailcom" />
            <x-input wire:model='noteSendDate' label='Send Date' type='date' />
            <x-checkbox label='Note Published' wire:model='note_is_published' />
            <div class="flex justify-between pt-4">
                <x-button primary type='submit' class="mt-3" spinner='saveNote'>Save Note</x-button>
                <x-button type='submit' class="mt-3" negative flat href="{{ route('notes.index') }}">Back To
                    Note</x-button>
            </div>
            <x-action-message on='note-saved' />
            <x-errors />
        </form>
    </div>
</div>

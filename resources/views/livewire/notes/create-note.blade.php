<?php

use Livewire\Volt\Component;
use Carbon\Carbon;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        
        $validated = $this->validate([
            'noteTitle' => 'required|string|min:5',
            'noteBody' => 'required|string|min:10',
            'noteRecipient' => 'required|email',
            'noteSendDate' => 'required|date',
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $this->noteTitle,
                'body' => $this->noteBody,
                'recipient' => $this->noteRecipient,
                'send_date' => $this->noteSendDate,
                'is_published' => true,
            ]);
        redirect(route("notes.index"))  ;
    }
}; ?>

<div>
    <form wire:submit='submit' class="space-y-3 ">
        <x-input wire:model='noteTitle' label='Note Title' placeholder="It's A Great Day" />
        <x-textarea wire:model='noteBody' label='Your Note' placeholder="Share Sll Your Thoughts" />
        <x-input icon="user" wire:model='noteRecipient' label='Recipient' type='email'
            placeholder="yourfriend@emailcom" />
        <x-input wire:model='noteSendDate' label='Send Date' type='date' />
        <div class="pt-3">
            <x-button right-icon="check" positive type='submit' class="mt-3" spinner>Schedule Note</x-button>
        </div>
        <x-errors/>
       
    </form>

    
</div>

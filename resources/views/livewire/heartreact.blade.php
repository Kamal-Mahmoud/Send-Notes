<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;
    public $heartCount;

    public function mount(Note $note)
    {
        // take the state that passed in to this component
        $this->note = $note;
        $this->heartCount = $note->heart_count; // assign the variable to model ;
    }
    public function increaseHeartCount()
    {
        // $this->note->update(['heart_count'=> $this->heartCount +1 ]);
        
        $this->note->heart_count++;
        $this->note->save();
        $this->heartCount = $this->note->heart_count;
    }
}; ?>

<div>
    <x-button rose icon='heart' wire:click='increaseHeartCount' spinner>{{ $heartCount }}</x-button>
</div>

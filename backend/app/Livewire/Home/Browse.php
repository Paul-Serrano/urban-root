<?php

namespace App\Livewire\Home;

use App\Models\Event;
use App\Models\Garden;
use Livewire\Component;

class Browse extends Component
{
    public $gardens;
    public $gardensWithoutLoc;
    public $events;
    public $eventsWithoutLoc;

    public function render()
    {
        return view('livewire.home.browse');
    }

    public function mount() {
        foreach($this->getGardens() as $garden) {
            if($garden['longitude'] != 0 && $garden['latitude'] != 0) {
                $this->gardens[] = $garden;
            }
            else {
                $this->gardensWithoutLoc[] = $garden;
            }
        }

        foreach($this->getEvents() as $event) {
            if($event['longitude'] != 0 && $event['latitude'] != 0) {
                $this->events[] = $event;
            }
            else {
                $this->eventsWithoutLoc[] = $event;
            }
        } 
        
    }

    public function getGardens() {
        return Garden::all();
    }

    public function getEvents() {
        return Event::all();
    }
}

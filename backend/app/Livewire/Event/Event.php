<?php

namespace App\Livewire\Event;

use App\Models\Address;
use App\Models\Event as ModelsEvent;
use App\Models\User;
use Livewire\Component;
use Mary\Traits\Toast;

class Event extends Component
{
    use Toast;
    
    public $events;

    public function mount() {
        $events = ModelsEvent::all();
        foreach($events as $event) {
            $event['author'] = User::find($event['user_id'])->first();
            $event['date_created_at'] = explode(' ', $event['created_at'])[0];
            $event['address'] = Address::find($event['address_id'])->first();
            $this->events[] = $event;
        }
    }

    public function updateEvent($id) {
        header('Location: /createEvent?eventId='.$id);
        exit();
    }

    public function removeEvent($id) {
        $event = ModelsEvent::find($id)->first();

        if (!$event) {
            $this->notificationToast("Jardin introuvable.", "error");
            return;
        }

        $event->delete();

        $address = Address::where('id', $event->address_id)->first();
        $address->delete();

        $events = ModelsEvent::where('user_id', 1)->get();
        $this->events = $this->manageEvents($events);

        header('Location: /event');
        exit();

    }

    public function manageEvents($events) {
        foreach($events as $event) {
            $event['author'] = User::find($event['user_id'])->first();
            $event['date_created_at'] = explode(' ', $event['created_at'])[0];
        }
        return $events;
    }


    public function render()
    {
        return view('livewire.event.event');
    }
}

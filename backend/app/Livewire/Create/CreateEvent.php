<?php

namespace App\Livewire\Create;

use App\Models\Address;
use App\Models\Event;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Mary\Traits\Toast;

class CreateEvent extends Component
{
    use Toast;

    public $event;
    public $address;

    public $title;
    public $description;
    public $date;

    public $streetNumber;
    public $streetName;
    public $postalCode;
    public $city;
    public $country;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'date' => 'required|date',
        'streetNumber' => 'required|string|max:255',
        'streetName' => 'required|string|max:255',
        'postalCode' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
    ];

    public function mount() {
        $eventId = request()->query('eventId');
        if ($eventId) {
            $this->event = Event::find($eventId);
            $this->address = $this->event->address;
            
            // Initialiser les champs de l'événement
            $this->title = $this->event->title;
            $this->description = $this->event->description;
            $this->date = $this->event->date;
    
            // Initialiser les champs de l'adresse
            if ($this->address) {
                $this->streetNumber = $this->address->street_number;
                $this->streetName = $this->address->street_name;
                $this->postalCode = $this->address->postal_code;
                $this->city = $this->address->city;
                $this->country = $this->address->country;
            }
        }
    }

    public function submit()
    {
        $this->validate();

        $coordinates = $this->getCoordinates();

        // Logique de mise à jour ou de création de l'adresse
        if ($this->address) {
            // Mettre à jour l'adresse existante
            $this->address->update([
                'street_number' => $this->streetNumber,
                'street_name' => $this->streetName,
                'postal_code' => $this->postalCode,
                'city' => $this->city,
                'country' => $this->country,
                'latitude' => $coordinates['lat'] ?? 0,
                'longitude' => $coordinates['lon'] ?? 0,
            ]);
        } else {
            // Créer une nouvelle adresse
            $this->address = Address::create([
                'street_number' => $this->streetNumber,
                'street_name' => $this->streetName,
                'postal_code' => $this->postalCode,
                'city' => $this->city,
                'country' => $this->country,
                'latitude' => $coordinates['lat'] ?? 0,
                'longitude' => $coordinates['lon'] ?? 0,
            ]);
        }

        // Logique de mise à jour ou de création de l'événement
        if ($this->event) {
            // Mettre à jour l'événement existant
            $this->event->update([
                'user_id' => 1, // Assumes a static user ID for demonstration
                'address_id' => $this->address->id,
                'title' => $this->title,
                'description' => $this->description,
                'date' => $this->date,
                'latitude' => $coordinates['lat'] ?? 0,
                'longitude' => $coordinates['lon'] ?? 0,
            ]);
            $message = 'Événement mis à jour avec succès.';
        } else {
        // Créer un nouvel événement
        $this->event = Event::create([
            'user_id' => 1, // Assumes a static user ID for demonstration
            'address_id' => $this->address->id,
            'title' => $this->title,
            'description' => $this->description,
            'date' => $this->date,
            'latitude' => $coordinates['lat'] ?? 0,
            'longitude' => $coordinates['lon'] ?? 0,
        ]);
        $message = 'Événement créé avec succès.';
    }

    // Redirection et message de succès
    session()->flash('message', 'Événement créé avec succès.');

    // Réinitialiser les champs du formulaire après la soumission
    $this->reset();

    header('Location: /event');
    exit();

    }

    private function getCoordinates()
    {
        $response = Http::get('https://nominatim.openstreetmap.org/search', [
            'q' => "{$this->streetNumber} {$this->streetName}, {$this->city}, {$this->country} {$this->postalCode}",
            'format' => 'json',
            'limit' => 1
        ]);

        if ($response->successful() && count($response->json()) > 0) {
            $data = $response->json()[0];
            return ['lat' => $data['lat'], 'lon' => $data['lon']];
        } else {
            return null;
        }
    }

    public function notificationToast($title, $type): void
    {
        $this->toast(
            type: $type,
            title: $title,
            description: null,
            position: 'toast-top toast-end',
            icon: 'o-information-circle',
            css: 'alert-' . $type . ' text-black',
            timeout: 10000,
            redirectTo: null,
        );
    }

    public function render()
    {
        return view('livewire.create.create-event');
    }
}

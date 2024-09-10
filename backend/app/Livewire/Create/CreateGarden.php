<?php

namespace App\Livewire\Create;

use App\Models\Address;
use App\Models\Garden;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Mary\Traits\Toast;

class CreateGarden extends Component
{
    use Toast;

    public $garden;
    public $address;

    public $name;
    public $description;

    public $streetNumber;
    public $streetName;
    public $postalCode;
    public $city;
    public $country;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'streetNumber' => 'required|string|max:255',
        'streetName' => 'required|string|max:255',
        'postalCode' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'country' => 'required|string|max:255',
    ];

    public function mount()
    {
        $gardenId = request()->query('gardenId');
        if ($gardenId) {
            $this->garden = Garden::find($gardenId);
            if ($this->garden) {
                $this->address = $this->garden->address;

                // Initialiser les champs du jardin
                $this->name = $this->garden->name;
                $this->description = $this->garden->description;

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

        // Logique de mise à jour ou de création du jardin
        if ($this->garden) {
            // Mettre à jour le jardin existant
            $this->garden->update([
                'name' => $this->name,
                'description' => $this->description,
                'address_id' => $this->address->id,
                'latitude' => $coordinates['lat'] ?? 0,
                'longitude' => $coordinates['lon'] ?? 0,
            ]);
            $message = 'Jardin mis à jour avec succès.';
        } else {
            // Créer un nouveau jardin
            $this->garden = Garden::create([
                'name' => $this->name,
                'description' => $this->description,
                'address_id' => $this->address->id,
                'user_id' => 1, // Assumes a static user ID for demonstration
                'latitude' => $coordinates['lat'] ?? 0,
                'longitude' => $coordinates['lon'] ?? 0,
            ]);
            $message = 'Jardin créé avec succès.';
        }

        session()->flash('message', $message);

        // Redirection après la soumission
        header('Location: /garden');
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
        }
        else {
            $this->notificationToast('Adresse non trouvée', 'error');
            return;
        }

        return null; // Si l'adresse n'est pas trouvée
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
        return view('livewire.create.create-garden');
    }
}

<?php

namespace App\Livewire\Garden;

use App\Models\Address;
use App\Models\Garden as ModelsGarden;
use App\Models\User;
use Livewire\Component;

class Garden extends Component
{
    public $gardens;
    public $user;

    protected $listeners = [
        'user' => 'handleUser',
    ];

    public function handleUser($data) {
        $this->user = $data;
    }

    public function mount() {
        $gardens = ModelsGarden::where('user_id', 1)->get();
        $this->gardens = $this->manageGardens($gardens);

    }

    public function updateGarden($id) {
        header('Location: /createGarden?gardenId='.$id);
        exit();
    }

    public function removeGarden($id) {
        $garden = ModelsGarden::find($id)->first();

        if (!$garden) {
            $this->notificationToast("Jardin introuvable.", "error");
            return;
        }

        $garden->delete();

        $address = Address::where('id', $garden->address_id)->first();
        $address->delete();

        $gardens = ModelsGarden::where('user_id', 1)->get();
        $this->gardens = $this->manageGardens($gardens);

        header('Location: /garden');
        exit();

    }

    public function manageGardens($gardens) {
        foreach($gardens as $garden) {
            $garden['author'] = $garden->user();
            $garden['date_created_at'] = explode(' ', $garden['created_at'])[0];
        }
        return $gardens;
    }

    public function render()
    {
        return view('livewire.garden.garden');
    }
}

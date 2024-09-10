<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Models\Address;
use App\Models\Role; // Ajoutez cette ligne pour inclure le modèle Role
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Mary\Traits\Toast;

class Register extends Component
{
    use Toast;

    public $user;

    public $firstname;
    public $lastname;
    public $mail;
    public $password;
    public $password_confirmation;
    public $street_number;
    public $street_name;
    public $city;
    public $postal_code;
    public $country;

    protected $rules = [
        'firstname' => 'required|string|max:255',
        'lastname' => 'required|string|max:255',
        'mail' => 'required|email|unique:users,mail',
        'password' => 'required|string|min:8|confirmed',
        'street_number' => 'required|string|max:10',
        'street_name' => 'required|string|max:255',
        'city' => 'required|string|max:255',
        'postal_code' => 'required|string|max:20',
        'country' => 'required|string|max:255',
    ];

    public function register()
    {
        $this->validate();

        if($this->password !== $this->password_confirmation) {
            $this->notificationToast('Les mots de passe de correspondent pas', 'error');
            return;
        }

        // Créer l'adresse
        $address = Address::create([
            'street_number' => $this->street_number,
            'street_name' => $this->street_name,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
        ]);

        // Vérifiez l'existence du rôle "user"
        $role = Role::where('name', 'user')->first();

        // Créer un nouvel utilisateur avec l'ID de l'adresse
        $this->user = User::create([
            'role_id' => $role->id,
            'address_id' => $address->id,
            'mail' => $this->mail,
            'pass' => Hash::make($this->password),
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
        ]);


        header('Location: /');
        exit();
    }

    public function render()
    {
        return view('livewire.auth.register');
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
}

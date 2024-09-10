<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Mary\Traits\Toast;

class Login extends Component
{
    use Toast;

    public $mail;
    public $pass;
    public $user;

    protected $rules = [
        'mail' => 'required|email',
        'pass' => 'required|string|min:8',
    ];

    public function login()
    {
        $this->validate();

        // Rechercher l'utilisateur par email
        $this->user = User::where('mail', $this->mail)->first();

        // Vérifier si l'utilisateur existe
        if (!$this->user) {
            $this->notificationToast("Email : " . $this->mail . " non trouvé.", "error");
            return;
        }

        // Vérifier si le mot de passe est correct
        if (!Hash::check($this->pass, $this->user->pass)) {
            $this->notificationToast("Mot de passe incorrect.", "error");
            return;
        }

        $this->dispatch('user', $this->user);

        header('Location: /');
        exit();
    }

    public function render()
    {
        return view('livewire.auth.login');
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

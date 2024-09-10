<?php

namespace App\Livewire\Create;

use App\Models\Category;
use App\Models\Forum;
use Livewire\Component;
use Mary\Traits\Toast;

class CreateForum extends Component
{
    use Toast;

    public $title;
    public $categories;
    public $user;

    public $selectedCartegoryId;

    protected $rules = [
        'title' => 'required|string|max:255',
    ];

    public function mount() {
        $this->categories = Category::all();
    }

    public function submit()
    {
        $this->validate();

        // Création du forum
        $forum = Forum::create([
            'title' => $this->title,
            'user_id' => 1,
        ]);

        $category = Category::find($this->selectedCartegoryId);
        $forum->category()->attach($category);

        header('Location: /forum');
        exit();

        session()->flash('message', 'Forum créé avec succès.');

        // Réinitialiser les champs du formulaire après la soumission
        $this->reset();
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
        return view('livewire.create.create-forum');
    }
}

<?php

namespace App\Livewire\Create;

use App\Models\Forum;
use App\Models\ForumPost;
use App\Models\User;
use Livewire\Component;
use Mary\Traits\Toast;

class CreatePost extends Component
{
    use Toast;

    public $content;
    public $forum;
    public $posts;

    public $user;

    public $category;

    protected $rules = [
        'content' => 'required|string|max:255',
    ];

    public function mount() {
        $forumId = request()->query('forumId');
        $this->forum = Forum::find($forumId);
        $this->forum['author'] = User::find($this->forum['user_id'])->first();
        $this->forum['date_created_at'] = explode('T', $this->forum['created_at'])[0];
        $this->forum['category'] = $this->forum->category()->first();
        $posts = ForumPost::where('forum_id', $forumId)->get();
        foreach($posts as $post) {
            $post['author'] = User::find($post['user_id'])->first();
            $post['date_created_at'] = explode('T', $post['created_at'])[0];
            $this->posts[] = $post;
        }

    }

    public function setUserId($id)
    {
        $this->user = User::find($id)->first();
    }

    public function submit()
    {
        $this->validate();

        $post = ForumPost::create([
            'user_id' => 1,
            'forum_id' => $this->forum['id'],
            'content' => $this->content,
        ]);

        $post->save();

        session()->flash('message', 'Post créé avec succès.');

        exit();

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
        return view('livewire.create.create-post');
    }
}

<?php

namespace App\Livewire\Forum;

use App\Models\Forum as ModelsForum;
use Livewire\Component;
use Mary\Traits\Toast;

class Forum extends Component
{
    use Toast;

    public $forums;
    public $posts;
    public $author;
    public $selectedForumContent;

    public $show;

    public function mount()
    {
        $forums =  ModelsForum::all();
        foreach($forums as $forum) {
            $forum['author'] = $forum->user()->first();
            $forum['date_created_at'] = explode(' ', $forum['created_at'])[0];
            $forum['category'] = $forum->category[0];
            $this->forums[] = $forum;
        }
        $this->selectedForumContent = [];

    }

    public function showContent($forumId)
    {
        header('Location: /createPost?forumId='.$forumId);
        exit();
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
        return view('livewire.forum.forum');
    }
}

<?php

use Livewire\Volt\Volt;

Volt::route('/', 'home.browse')->name('home');
Volt::route('/forum', 'forum.forum')->name('forum');
Volt::route('/event', 'event.event')->name('events');
Volt::route('/garden', 'garden.garden')->name('gardens');
Volt::route('/register', 'auth.register');
Volt::route('/login', 'auth.login');
Volt::route('/createGarden', 'create.create-garden')->name('createGarden');
Volt::route('/createEvent', 'create.create-event')->name('createEvent');
Volt::route('/createForum', 'create.create-forum')->name('createForum');
Volt::route('/createPost', 'create.create-post')->name('createPost');



// Route::get('/', Register::class);



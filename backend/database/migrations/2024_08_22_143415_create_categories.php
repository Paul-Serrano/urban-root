<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description');
            $table->timestamps();
        });

        $catgories = [
            [
                'name' => 'Jardin',
                'description' => 'Tout sur le jardin'
            ],
            [
                'name' => 'Potager',
                'description' => 'Tout sur le potager'
            ],
            [
                'name' => 'Event',
                'description' => 'Tout sur les events'
            ],
            [
                'name' => 'Urban Root',
                'description' => 'Tout sur le urban root'
            ],
        ];

        foreach($catgories as $data)
        {
            Category::create($data);
        }    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

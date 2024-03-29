<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/blog')->name('blog.')->group(function () {
    Route::get('/', function (Request $request) {

        //Creation d'un article puis enregistrement dans la base de donnees 

        // $post = new Post();
        // $post->title = 'Juste pour le test';
        // $post->slug = 'Juste pour le test';
        // $post->content = 'Juste pour le test';
        // $post->save();
        // return $post;
        $post = Post::create([
            'title' => 'Mon super titre',
            'slug' => 'Mon slug',
            'content' => 'Mon contenue'
        ]);
       
        return $post;

        return [
            "link" => \route('blog.show', ['slug' => 'article', 'id' => 13]),
        ];
    })->name('index');

    Route::get('/{slug}/{id}', function (string $slug, string $id, Request $request) {
        return [
            "slug" => $slug,
            'id' => $id,
            "name" => $request->input('name')
        ];
    })->where([
        'id' => '[0-9]+',
        'slug' => '[a-z0-9\-]+'
    ])->name('show');
});

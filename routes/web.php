<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

App::bind('App\Billing\Stripe', function(){ 
    return new \App\Billing\Stripe(config('services.stripe.secret'));
});

$stripe = App::make('App\Billing\Stripe');

//echo $stripe->getClientKey();

//dd($stripe);

use App\User;
use App\Post;
use App\Profile;
use App\Category;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/create_user', function() {
       
    $user = User::create([
        'name' => 'Hakim',
        'email' => 'ranga@gmail.in',
        'password' => bcrypt('123456')
    ]); 

    return $user;

});

Route::get('/create_profile', function() {
       
    $profile = Profile::create([
        'user_id' => 1,
        'phone' => '9638527410',
        'address' => 'gandhipuram'
    ]); 

    return $profile;

});

Route::get('/create_user_profile', function() {
    
    $user = User::find(2);
    
    $profile = new Profile([
        'phone' => '9638527411',
        'address' => 'Mettuppalayam'
    ]); 

    $user->profile()->save($profile);

    return $user;

});

Route::get('/read_user', function() {
    
    $user = User::find(2);
    
    $data = [
        'name' => $user->name,
        'email' => $user->email,
        'address' => $user->profile->address,
    ]; 

    return $data;

});

Route::get('/read_profile', function() {
    
    $profile = Profile::where('phone', '9638527410')->first();
    
    //dd($profile->user); exit;
    //echo $profile->user->name; exit;
 
    $data = [
        'name'    => $profile->user->name,
        'email'   => $profile->user->email,
        'phone'   => $profile->phone,
        'address' => $profile->address,
    ]; 

    return $data;

});

Route::get('/update_profile', function() {
    
    $user = User::find(2);
 
    $user->profile()->update([
        'phone' =>'9789108965',
        'address' => 'coimbatore',
    ]);
 
    return $user;

});

Route::get('/delete_profile', function() {
    
    $user = User::find(2);
    $user->profile()->delete();
 
    return $user;

});

/* Has Many */

Route::get('/create_post', function() {
       
   /*  $user = User::create([
        'name' => 'Zaheer',
        'email' => 'rangasamy123@gmail.com',
        'password' => bcrypt('123456')
    ]);  */

    $user = User::findOrFail(1);
    
    $post = new Post([
        'title' => 'What is Lorem Ipsum?',
        'body' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.'
    ]); 

    $user->posts()->save($post);

    return $user;

});

Route::get('/read_posts', function() {
    
    $user = User::find(1);    
    
    //dd($user->posts()->first());

    //dd($user->posts()->get());

     $posts = $user->posts()->get();

    foreach($posts as $post) {
        $data[] =  [
            'name' => $post->user->name,
            'title' => $post->title,
            'body' => $post->body,
        ];
    }

    return $data;

});

Route::get('/update_posts', function() {
    
    $user = User::findOrFail(1);    
 
    $user->posts()->update([
         'title' => 'hi',
         'body' => 'hellow how r u'
     ]);
        
    return $user;

});

Route::get('/delete_post', function() {
    
    $user = User::find(1);    
    
    //dd( $user->posts());

    $user->posts()->whereId(1)->delete();
        
    return $user;

});

/* Belongs to Many */

Route::get('/create_categories', function() {
 
   /* $post = Post::findOrFail(2);
     
    $post->categories()->create([
         'slug' => str_slug('PHP', '-'),
         'category' => 'php'
     ]); 
  
     return $post; */

     $user = User::create([
        'name' => 'Hakim kumar',
        'email' => 'ranga124@gmail.in',
        'password' => bcrypt('123456')
    ]); 

    $user->posts()->create([
        'title' => 'New Title',
        'body' => 'New Body Content',
    ])->categories()->create([
        'slug' => str_slug('Laravel', '-'),
        'category' => 'Laravel' 
    ]);

    return $user;   
 
 });

 Route::get('/read_category', function() {
 
     $category = Category::findOrFail(2);
      
     $posts = $category->posts; 
   
      foreach($posts as $post){
         echo $post->title . "<br/>";
      } 
 
     //return $user;   
  
  });















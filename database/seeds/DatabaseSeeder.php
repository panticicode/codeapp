<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB :: statement('SET FOREIGN_KEY_CHECKS=0');
		DB :: table('users')->truncate();
		DB :: table('posts')->truncate();
		DB :: table('photos')->truncate();
		DB :: table('roles')->truncate();
		DB :: table('categories')->truncate();
		DB :: table('comments')->truncate();
		DB :: table('comment_replies')->truncate();
		/************************FACTORY*****************************/
		factory(App\User :: class, 5)->create()->each(function($user){
			$user->posts()->save(factory(App\Post :: class)->make());
		});
		factory(App\Role :: class, 3)->create();
		factory(App\Category :: class, 4)->create();
		//factory(App\Photo :: class, 5)->create();
		factory(App\Comment :: class, 5)->create()->each(function($c){
			$c->replies()->save(factory(App\CommentReply :: class)->make());
		});
		/**************DEFAULT**************/	
         // $this->call(UsersTableSeeder::class);
    }
}

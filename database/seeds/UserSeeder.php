<?php
use  \App\User;
use  \App\Profession;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // $prefesions = DB::select('SELECT id FROM professions WHERE title =  ? LIMIT 0,1',[ 'Desarrollador back-end']);
        $professionId = Profession::where('title','Desarrollador back-end')->value('id');
       
        factory(User::class)->create([
            'name'=>'Alan Jesús',
            'email'=>'alan02n@gmail.com',
            'password'=>bcrypt('laravel'),     
            'profession_id'=>$professionId,
            'isAdmin'=> true,
        ]);
        factory(User::class)->create([
            'profession_id'=>$professionId
        ]);
        factory(User::class,48)->create();
        
    }
}

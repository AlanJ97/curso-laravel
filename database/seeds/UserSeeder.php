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
       
        User::create([
            'name'=>'Alan Jesús',
            'email'=>'alan02n@gmail.com',
            'password'=>bcrypt('laravel'),     
            'profession_id'=>$professionId,
            'isAdmin'=> true,
        ]);
        User::create([
            'name'=>'Alan Jesús Nava',
            'email'=>'alan0297n@gmail.com',
            'password'=>bcrypt('laravel'),     
            'profession_id'=>$professionId
        ]);
        User::create([
            'name'=>'Alan Jesús Segundo',
            'email'=>'alan029797n@gmail.com',
            'password'=>bcrypt('laravel'),     
            'profession_id'=>null
        ]);
    }
}

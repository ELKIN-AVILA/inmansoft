<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class EmpleadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    for($i=0;$i<50;$i++){
	    DB::table('empleados')->insert([
	    'priape'=> Str::random(15),
	    'segape'=> Str::random(15),
	    'prinom'=> Str::random(15),
	    'segnom'=> Str::random(15),
	    'correo'=> Str::random(10).'@gmail.com',
	    'celular'=>'1234567789',
	    'cargo_id'=>'1',]);
	    }
    }

}

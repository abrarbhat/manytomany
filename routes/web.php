<?php
use App\User;
use App\Role;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/create',function (){

    $user=User::find(1);
    $role =new Role(['name'=>'administrator']);

    $user->roles()->save($role);
});

Route::get('/read',function(){

    $user=User::findOrFail(1);

    $role = $user->roles;//->name;
    echo $role->name;


});


Route::get('/update',function(){

    $user = User::findOrFail(1);

    if ($user->has('roles')){
        foreach ($user->roles as $role){

            if($role->name=='administrator')
            {
                $role->name='admin';
                $role->save();
            }

        }


    }
dd($user);
});
Route::get('/delete',function(){

    $user =User::findOrFail(1);
if($user->roles()->where('name','==','admin')) {
    $user->roles()->delete();
}



});
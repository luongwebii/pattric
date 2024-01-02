<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function users() 
    {
        $users = User::latest()->paginate(10);
        
       
        return view('users.index',  [
            'users' => $users
        ]);
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function create() 
    {

        $roleArray = User::getRoleArray();
        return view('users.create', [
            'roleArray' => $roleArray
        ]);
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, StoreUserRequest $request) 
    {
        //For demo purposes only. When creating user or inviting a user
        // you should create a generated random password and email it to the user
        $input = $request->all();
        $userData = $request->validated();
        $userData['password'] = bcrypt($input['password']);
        $userData['role'] = 'admin';
        $user->create( $userData);

        return redirect()->route('admin.users')
            ->withSuccess(__('User created successfully.'));
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) 
    {
        return view('users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) 
    {
        $roleArray = User::getRoleArray();
        return view('users.edit', [
            'user' => $user,
            'roleArray' => $roleArray
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UpdateUserRequest $request) 
    {

        $input = $request->all();
        $userData = $request->validated();
        if(!empty($input['password'])){
            $userData['password'] = bcrypt($input['password']);
        } else {
            unset($userData['password']);
        }
        $userData['role'] = 'admin';
       

        $user->update($userData);

       

        return redirect()->route('admin.users')
            ->withSuccess(__('User updated successfully.'));//_partials.messages
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) 
    {
        $user->delete();

        return redirect()->route('users.index')
            ->withSuccess(__('User deleted successfully.'));
    }

    public function deleteUser(Request $request)
    {

        $data = $request->all();
        $id = $data['id'];

        $model = User::find($id);
        
        $model->delete();

        // toastr()->success('Product deleted successfully');
        return redirect()->back()->withSuccess(__('User deleted successfully.'));
    }

}


/*

git clone https://github.com/codeanddeploy/laravel8-authentication-example.git

if your using my previous tutorial navigate your project folder and run composer update



install packages

composer require spatie/laravel-permission
composer require laravelcollective/html

then run php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

php artisan migrate

php artisan make:migration create_posts_table

php artisan migrate

models
php artisan make:model Post

middleware
- create custom middleware
php artisan make:middleware PermissionMiddleware

register middleware
- 

routes

controllers

- php artisan make:controller UsersController
- php artisan make:controller PostsController
- php artisan make:controller RolesController
- php artisan make:controller PermissionsController

requests
- php artisan make:request StoreUserRequest
- php artisan make:request UpdateUserRequest

blade files

create command to lookup all routes
- php artisan make:command CreateRoutePermissionsCommand
- php artisan permission:create-permission-routes

seeder for default roles and create admin user
php artisan make:seeder CreateAdminUserSeeder
php artisan db:seed --class=CreateAdminUserSeeder


php artisan make:middleware Admin
php artisan make:controller AdminController

*/
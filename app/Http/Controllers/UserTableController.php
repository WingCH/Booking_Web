<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as UserEloquent;


use App\Http\Requests;

class UserTableController extends Controller
{
    public function index()
    {
        return view('admin/userTable');
    }

    public function getAllUser()
    {
        $users = UserEloquent::All();
        return $users->toJson();
    }
    

    public function deleteUser(Request $request)
    {
        $user = UserEloquent::find($request->input('user_id'));
        $user -> delete();
    }




}

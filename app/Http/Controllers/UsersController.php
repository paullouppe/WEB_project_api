<?php

namespace App\Http\Controllers;

use App\Users;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
    public function showAllUsers()
    {
        return response()->json(Users::all());
    }

    public function showOneUser($id)
    {
        return response()->json(Users::find($id));
    }

    public function create(Request $request)
    {
        $user = Users::create($request->all());

        return response()->json($user, 201);
    }

    public function update($id, Request $request)
    {
        $user = Users::findOrFail($id);
        $user->update($request->all());

        return response()->json($user, 200);
    }

    public function delete($id)
    {
        Users::findOrFail($id)->delete();
        return response('Deleted Successfully', 200);
    }
}
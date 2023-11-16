<?php

namespace Adminlte3\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{

    public function getEdit($id)
    {
        $user = User::find($id);

        return view('adminlte::users.edit', compact('user'));
    }

    public function postSave(Request $request)
    {
        $id = $request->only(['id']);
        $data = $request->except(['id']);

        $data['is_admin'] = !Arr::get($data, 'is_admin') ? 0 : 1;
        $data['is_active'] = !Arr::get($data, 'is_active') ? 0 : 1;


        $validator = Validator::make(
            $data,
            [
                'name' => 'required|max:255',
                'email' => 'required|email',
            ]
        );

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->messages()];
        }

        $user = User::where('id', $id)->first();

        if (!$user) {
            return ['errors' => 'User not found'];
        }

        $user->update($data);
        return ['success' => true, 'msg' => 'Успешно сохранено.'];
    }

    public function postDelete($id)
    {
        $res = User::find($id)->delete();

        if($res) return ['success' => true];
    }
}

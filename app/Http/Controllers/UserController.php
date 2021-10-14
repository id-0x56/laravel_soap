<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function getUser($id)
    {
        $user = User::query()
            ->where('id', $id)
            ->select([
                'id',
                'name',
                'email',
            ])
            ->first();

        $postList = $user
            ->posts()
            ->select([
                'id',
                'title',
                'body',
            ])
            ->get();

        $response = [];
        $response['user'] = $user->toArray();
        foreach ($postList->toArray() as $i => $post) {
            $response['user']['postList']['post'][$i] = $post;
        }

        return $response;
    }
}

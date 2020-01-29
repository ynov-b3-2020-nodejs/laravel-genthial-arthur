<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class UserController extends Controller
{

    public function edit(User $user)
    {
        $settings = json_decode($user->settings);
        return view ('users.edit', compact('user', 'settings'));
    }

    /**

     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);
        $user->update([
            'email' => $request->email
        ]);
        return back()->with(['ok' => __('Le profil a bien été mis à jour')]);
    }
}

Route::middleware('auth')->group(function () {
    Route::resource('profile', 'UserController', [
        'only' => ['edit', 'update']
    ]);
});

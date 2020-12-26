<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ChangeUserPasswordController extends Controller
{
    public function edit(Request $request, User $user) {
        $this->validate($request, [
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'confirmed', 'min:8'],
        ]);
        
        $user->update(['password' => Hash::make($request->new_password)]);

        return back()->with('status', 'Password change successfully');
    }
}


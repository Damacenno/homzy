<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;

class UserController extends Controller
{

    public function login(Request $request)
    {
        // FUNCTION PRA LOGAR 
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home');
        } else {
            $message = 'Credenciais inválidas. Tente novamente.';
        }

        return response()->json([
            'message' => $message
        ]);

    }

    public function register()
    {

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

    public function findCleaners()
    {
        $cleaners = User::whereHas('userType', function ($query) {
            $query->where('KEY', 'PROFESSIONAL_CLEANER');
        })
            ->where('can_be_found', true)
            ->get();

        return view('find-cleaners', compact('cleaners'));
    }

    public function getCleanerDetails($id)
    {
        $cleaner = User::findOrFail($id);
        return view('cleaner-details', compact('cleaner'));
    }

}

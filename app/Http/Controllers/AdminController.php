<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginHandler(Request $request)
    {
        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:admins,email',
                'password' => 'required|min:5|max:45'
            ], [
                'login_id.required' => 'L\'email ou le nom d\'utilisateur est obligatoire',
                'login_id.email' => 'L\'addresse email est invalide !',
                'login_id.exists' => 'L\'email n\'existe pas dans notre système !',
                'password.required' => 'Le mot de passe est obligatoire'
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:admins,username',
                'password' => 'required|min:5|max:45',
            ], [
                'login_id.required' => 'L\'email ou le nom d\'utilisateur est obligatoire',
                'login_id.exists' => 'Le nom d\'utilisateur n\'existe pas dans notre système',
                'password.required' => 'Le mot de passe est obligatoire'
            ]);
        }
    }
}

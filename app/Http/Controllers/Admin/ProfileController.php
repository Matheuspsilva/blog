<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index(){
        $user = auth()->user();

        if(!$user->profile()->count()){
            $user->profile()->create();
        }

        return view('profile.index', compact('user'));

    }

    public function update(Request $request){
        $user = auth()->user();
        $userData = $request->get('user');
        $profileData = $request->get('profile');

        try{

            if($userData['password']){
                $userData['password'] = bcrypt($userData['password']);
            }else{
                unset($userData['password']);
            }

            if($request->hasFile('avatar')) {
                Storage::disk('public')->delete($user->avatar);
                $profileData['avatar'] = $request->file('avatar')->store('avatars', 'public');
            }else {
                unset($profileData['avatar']);
            }

            $user = auth()->user();

            $user->profile()->update($profileData);

            flash('Perfil atualizado com sucesso!')->success();

            return redirect()->route('profile.index');

        }catch(\Exception $e){
            $message = 'Erro ao remover categoria!';

            if(env('APP_DEBUG')){
                $message = $e->getMessage();
            }
            flash($message)->warning();
            return redirect()->back();
        }

    }

}

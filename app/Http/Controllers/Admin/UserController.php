<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function destroy(User $user)
  {
    // adicionar autorização
    $user->delete();

    return back()->with('message', 'Usuário removido');
  }

  public function updateRole(Request $request, User $user)
  {
    $request->validate(['role' => ['required', 'in:admin,moderator,author']]);

    if($request->user()->id === $user->id){
      return back()->with('message', 'Você não pode alterar seu próprio cargo.');
    }

    $user->update(['role' => $request->role]);

    return back()->with('message', 'Cargo atualizado com sucesso.');
  }
}
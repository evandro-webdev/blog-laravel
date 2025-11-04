<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'name' =>['required', 'unique:tags,name']
    ]);

    Tag::create(['name' => $request->name]);

    return back()->with('message', 'Tag adicionada');
  }

  public function update(Request $request, Tag $tag)
  {
    $request->validate([
      'name' =>['required', 'unique:tags,name']
    ]);

    $tag->update(['name' => $request->name]);

    return back()->with('message', 'Tag atualizada');
  }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'name' => ['required', 'unique:categories,name']
    ]);

    Category::create(['name' => $request->name]);

    return back()->with('message', 'Categoria adicionada');
  }
}

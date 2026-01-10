<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;

class CategoryController extends Controller
{
  public function index()
  {
    return view('backend.categories.index', [
      'categories' => category::all()
    ]);
   $categories = auth()->user()->categories()->latest()->paginate(10);

    return view('frontend.users.index', [
      'categories' => category::all()
    ]);
  }
  public function create()
  {
    return view('backend.categories.create');
  }
  public function store(request $request)
  {
    $validate = $request->validate([
      'name' => 'required|max:10',
    ]);

    Category::create($validate);
    return redirect('/categories');
  }

  public function edit(Category $category)
  {
    return view('backend.categories.edit', [
      'category' => $category
    ]);
  }

  public function update(request $request, Category $category)
  {
    $validate = $request->validate([
      'name' => 'required|max:10',
    ]);

    $category->update($validate);
    return redirect('/categories');
  }
  public function destroy(Category $category)
  {
    $category->delete();
    return redirect('/categories');
  }
}

<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $category = Category::all();
        $contact = Contact::all();
        return view('admin.categories', compact('category', 'contact'));
    }
    public function showLeastCategory()
    {
        $categories = Category::latest()->take(3)->get();
        $beverages = Beverage::all();
        $specialItems = Beverage::where('special', 'yes')->get();
        return view('index', ['categories' => $categories, 'beverages' => $beverages, 'specialItems' => $specialItems]);
    }
    public function create()
    {
        $contact = Contact::all();
        return view('admin.addCategory', compact('contact'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_name' => 'required|max:50|unique:category'
        ], [
            'required' => 'The :attribute Field Is Require',
            'category_name.size' => 'The :attribute must be exactly :size'
        ]);
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->save();
        $contact = Contact::all();
        return view('admin.addCategory', compact('contact'));
    }
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $contact = Contact::all();
        return view('admin.editCategory', compact('category', 'contact'));
    }
    public function update(Request $request, string $id)
    {
        Category::where('id', $id)->update(['category_name' => $request->category_name]);
        $category = Category::all();
        $contact = Contact::all();
        return redirect('/all_categories')->with(compact('category', 'contact'));
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $hasBeverages = Beverage::where('category_id', $id)->exists();
        if ($hasBeverages) {
            return redirect('/all_categories')->with('error', 'Cannot delete category with associated beverages.');
        }

        Category::where('id', $id)->delete();

        return redirect('/all_categories')->with('success', 'Category deleted successfully.');
    }
    public function delete(string $id)
    {
        $hasBeverages = Beverage::where('category_id', $id)->exists();

        if ($hasBeverages) {
            return redirect('/all_categories')->with('error', 'Cannot delete category with associated beverages.');
        }

        Category::findOrFail($id)->delete();

        return redirect('/all_categories')->with('success', 'Category deleted successfully.');

    }
}

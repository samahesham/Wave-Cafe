<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;

class BeverageController extends Controller
{
    //
    public function index()
    {
        $beverage = Beverage::all();
        $contact = Contact::all();
        return view('admin.beverages', compact('beverage', 'contact'));
    }
    public function create()
    {
        $categories = Category::all();
        $contact = Contact::all();
        return view('admin.addBeverage', compact('categories', 'contact'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'beverage_title' => 'required|max:50',
            'beverage_content' => 'required|max:50'
        ], [
            'required' => 'The :attribute Field Is Require',
            'beverage_title.size' => 'The :attribute must be exactly :size'
        ]);
        $beverage = new Beverage();
        $beverage->beverage_title = $request->beverage_title;
        $beverage->beverage_content = $request->beverage_content;
        $beverage->beverage_price = $request->beverage_price;
        $isPublished = $request->has('published') ? 'yes' : 'no';
        $beverage->published = $isPublished;
        $isSpecial = $request->has('special') ? 'yes' : 'no';
        $beverage->special = $isSpecial;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('images', 'public');
            $beverage->image = $path;
        }
        $beverage->category_id = $request->category_id;
        $beverage->save();
        $categories = Category::all();
        $contact = Contact::all();
        return view('admin.addBeverage', compact('categories', 'contact'));
    }
    public function edit(string $id)
    {
        $beverage = Beverage::findOrFail($id);
        $categories = Category::all();
        $contact = Contact::all();
        return view('admin.editBeverage', compact('beverage', 'categories', 'contact'));
    }
    public function update(Request $request, string $id)
    {
        $isPublished = $request->has('published') ? 'yes' : 'no';
        $isSpecial = $request->has('special') ? 'yes' : 'no';

        Beverage::where('id', $id)->update([
            'beverage_title' => $request->beverage_title,
            'beverage_content' => $request->beverage_content,
            'beverage_price' => $request->beverage_price,
            'published' => $isPublished,
            'special' => $isSpecial,
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : null,
            'category_id' => $request->category_id,
        ]);

        $beverage = Beverage::findOrFail($id);
        $categories = Category::all();

        $contact = Contact::all();
        return redirect('/all_beverages')->with(compact('beverage', 'categories', 'contact'));
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        Beverage::where('id', $id)->delete();
        return redirect('/all_beverages');
    }
    public function delete(string $id)
    {
        Beverage::findOrFail($id)->delete();
        return redirect('/all_beverages');
    }
}

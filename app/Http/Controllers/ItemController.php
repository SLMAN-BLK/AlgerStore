<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        // Create a new item with the validated data
        // Assuming you have an Item model
        $item = new Item();
        $item->idven = Auth::user()->id ;
        $item->title = $request->title;
        $item->price = $request->price;
        $item->description = $request->description;
        $item->image = $imagePath ?? null;
        $item->save();

        // Redirect to a specific route or page
        return view('test.saved');
        sleep(5);
        return redirect('/acheter');
    }
}


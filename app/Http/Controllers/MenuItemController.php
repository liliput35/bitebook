<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuItemController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.add_item', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('menu', 'public'); // 
        }

        MenuItem::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
            'category_id' => $request->category_id,
            'is_active'   => true,
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu item added.');
    }

    public function destroy(MenuItem $menuItem)
    {
        // ❌ DO NOT delete image here anymore

        $menuItem->delete(); // soft delete

        return redirect()->route('admin.menu')->with('success', 'Menu item archived.');
    }
    public function edit(MenuItem $menuItem)
    {
        $categories = Category::all();
        return view('admin.edit', compact('menuItem', 'categories'));
    }

    public function update(Request $request, MenuItem $menuItem)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        $imagePath = $menuItem->image;

        if ($request->hasFile('image')) {

            //  DELETE OLD IMAGE
            if ($menuItem->image && Storage::disk('public')->exists($menuItem->image)) {
                Storage::disk('public')->delete($menuItem->image);
            }

            // SAVE NEW IMAGE
            $imagePath = $request->file('image')->store('menu', 'public');
        }

        $menuItem->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image'       => $imagePath,
            'category_id' => $request->category_id,
            'is_active'   => $request->has('is_active'),
        ]);

        return redirect()->route('admin.menu')->with('success', 'Menu item updated.');
    }
}
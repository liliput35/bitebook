<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\BundleRequirement;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BundleController extends Controller
{
   // SHOW CREATE FORM
    public function create()
    {
        $categories = Category::all();
        return view('admin.add_bundle', compact('categories'));
    }

    // STORE NEW BUNDLE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price_per_head' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'requirements' => 'required|array'
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bundles', 'public'); // 
        }

        // Create bundle
        $bundle = Bundle::create([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_head' => $request->price_per_head,
            'image' => $imagePath,
        ]);

        // Save requirements
        foreach ($request->requirements as $index => $categoryId) {
            BundleRequirement::create([
                'bundle_id' => $bundle->id,
                'category_id' => $categoryId,
                'required_quantity' => $request->quantities[$index],
            ]);
        }

        return redirect()->route('admin.bundles')->with('success', 'Bundle created successfully');
    }

    // SHOW EDIT FORM
    public function edit(Bundle $bundle)
    {
        $bundle->load('requirements');
        $categories = Category::all();

        return view('admin.edit_bundle', compact('bundle', 'categories'));
    }

    // UPDATE BUNDLE
    public function update(Request $request, Bundle $bundle)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price_per_head' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'requirements' => 'required|array'
        ]);

        $imagePath = $bundle->image;

        if ($request->hasFile('image')) {

            //  DELETE OLD IMAGE
            if ($bundle->image && Storage::disk('public')->exists($bundle->image)) {
                Storage::disk('public')->delete($bundle->image);
            }

            // SAVE NEW IMAGE
            $imagePath = $request->file('image')->store('bundles', 'public');
        }

        // Update bundle
        $bundle->update([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_head' => $request->price_per_head,
            'image' => $imagePath,
        ]);

        // Reset old requirements
        $bundle->requirements()->delete();
        
        // Save new requirements
        foreach ($request->requirements as $index => $categoryId) {
            BundleRequirement::create([
                'bundle_id' => $bundle->id,
                'category_id' => $categoryId,
                'required_quantity' => $request->quantities[$index],
            ]);
        }

        return redirect()->route('admin.bundles')->with('success', 'Bundle updated successfully');
    }

    // DELETE BUNDLE
    public function destroy(Bundle $bundle)
    {
        $bundle->delete();
        return redirect()->route('admin.bundles')->with('success', 'Bundle archived');
    }
}
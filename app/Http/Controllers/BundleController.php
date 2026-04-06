<?php

namespace App\Http\Controllers;

use App\Models\Bundle;
use App\Models\BundleRequirement;
use App\Models\Category;
use Illuminate\Http\Request;

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
            'requirements' => 'required|array'
        ]);

        // Create bundle
        $bundle = Bundle::create([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_head' => $request->price_per_head,
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
            'requirements' => 'required|array'
        ]);

        // Update bundle
        $bundle->update([
            'name' => $request->name,
            'description' => $request->description,
            'price_per_head' => $request->price_per_head,
        ]);

        // Reset old requirements
        $bundle->requirements()->delete();

        // Save new requirements
        foreach ($request->requirements as $req) {
            BundleRequirement::create([
                'bundle_id' => $bundle->id,
                'category_id' => $req['category_id'],
                'required_quantity' => $req['quantity'],
            ]);
        }

        return redirect()->route('admin.bundles')->with('success', 'Bundle updated successfully');
    }

    // DELETE BUNDLE
    public function destroy(Bundle $bundle)
    {
        $bundle->requirements()->delete(); // delete child records
        $bundle->delete();

        return redirect()->route('admin.bundles')->with('success', 'Bundle deleted');
    }
}
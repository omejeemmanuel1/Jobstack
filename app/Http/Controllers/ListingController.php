<?php

namespace App\Http\Controllers;

use id;
use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //All listing
    public function index() {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    //Single listing
    public function show(Listing $listing) {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    //Show create form
    public function create() {
        return view('listings.create');
    }

     //Store listing data
     public function store(Request $request)
     {
             $formFields = $request->validate([
                 'title' => 'required',
                 'company' => ['required', Rule::unique('listing', 'company')],
                 'location' => 'required',
                 'website' => 'required',
                 'email' => ['required', 'email'],
                 'tags' => 'required',
                 'description' => 'required',
             ]);

             if($request->hasFile('logo')) {
                 $formFields['logo'] = $request->file('logo')->store('logos', 'public');
             }
             
             $formFields['user_id'] = auth()->id();

             Listing::create($formFields);
 
             return redirect('/')->with('success', 'Listing created successfully');
}

    // Show edit form
    public function edit(Listing $listing) {
        return view('listings.edit', [
            'listing' => $listing
        ]);
    }

    // Update listing
    public function update(Request $request, Listing $listing)
    {
        //Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized user'); 
        }

            $formFields = $request->validate([
                'title' => 'required',
                'company' => ['required'],
                'location' => 'required',
                'website' => 'required',
                'email' => ['required', 'email'],
                'tags' => 'required',
                'description' => 'required',
            ]);

            if($request->hasFile('logo')) {
                $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            }

            $listing->update($formFields);

            return back()->with('success', 'Listing updated successfully');
}

    // Delete listing
    public function destroy(Listing $listing)
    {
        //Make sure logged in user is owner
        if($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized user'); 
        }

        $listing->delete();

        return redirect('/')->with('success', 'Listing deleted successfully');
    }

    //Manage function
    public function manage() {
        
        return view('listings.manage', [
            'listings' => auth()->user()->listings()->get()
        ]);
    }

}
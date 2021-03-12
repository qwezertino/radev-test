<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $schools = School::latest()->paginate(3);

        return view('schools.index', compact('schools'))
            ->with('i', (request()->input('page', 1) - 1) * 3);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('schools.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'website' => 'required',
            'email' => 'required|email',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:100000'
        ]);

        $school = new School;


        if ($image = $request->file('logo')) {

            $extension = $image->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            Storage::disk('schools')->put($filename, File::get($image));

            $school->logo = $filename;
        }

        $school->name = $request->get('name');
        $school->website = $request->get('website');
        $school->email = $request->get('email');

        $school->save();

        return redirect()->route('schools.index')
            ->with('success', 'School create successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Contracts\View\View
     */
    public function show(School $school)
    {
        return view('schools.show', compact('school'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Contracts\View\View
     */
    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required',
            'website' => 'required',
            'email' => 'required|email:rfc,dns',
            'logo' => 'required'
        ]);
        $school->update($request->all());

        return redirect()->route('schools.index')->with('success', 'School successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(School $school)
    {
        $school->delete();

        return redirect()->route('schools.index')->with('success', 'School deleted successfully !');
    }
}

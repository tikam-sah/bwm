<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TestContacts;
use App\Models\Groups;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class TestcontactsController extends Controller
{
    public function index(): Renderable
    {
       $this->checkAuthorization(auth()->user(), ['testcontacts.view']);
        $testcontacts = TestContacts::all();
        return view('backend.pages.testcontacts.index', compact('testcontacts'));
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['testcontacts.create']);
        $groups = Groups::where('status', 'active')->select(['name', 'id'])->get();
        return view('backend.pages.testcontacts.create', compact('groups'));  
    }

    public function store(Request $request): RedirectResponse
    {
       $this->checkAuthorization(auth()->user(), ['testcontacts.create']);

        // Validation Data.
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:4' ,
            'phone' => 'required|max:10', 
        ],[ 'name.requried' => 'Please give a name'
         ]);
        TestContacts::create($request->all());

        session()->flash('success', 'Test Contacts been created.');
        return redirect()->route('admin.testcontacts.index');
    }

    public function edit(int $id): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['testcontacts.edit']);
        $groups = Groups::where('status', 'active')->select(['name', 'id'])->get();
        return view('backend.pages.testcontacts.edit', [ 'admin' => TestContacts::find($id) , 'groups' => $groups]);  
    }

    public function update(Request $request, int $id): RedirectResponse
    {
       $this->checkAuthorization(auth()->user(), ['testcontacts.edit']);

        $testcontacts = TestContacts::find($id);
        $request->validate([
            'name' => 'required|max:50',
            'code' => 'required|max:4' ,
            'phone' => 'required|max:10', 
        ]);

        $testcontacts->name = $request->name;
        $testcontacts->code = $request->code;
        $testcontacts->phone = $request->phone;
        $testcontacts->whatsapp = $request->whatsapp;
        $testcontacts->groups = $request->groups;
        
        $testcontacts->save();
        session()->flash('success', 'Test Contacts has been updated.');
        return back();
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['testcontacts.delete']);
        TestContacts::findOrFail($id)->delete();
        session()->flash('success', 'Test Contact has been deleted.');
        return redirect()->route('admin.testcontacts.index');

       
    }
}

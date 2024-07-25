<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contacts;
use App\Models\Groups;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class ContactsController extends Controller
{
    public function index(): Renderable
    {
       $this->checkAuthorization(auth()->user(), ['contacts.view']);
        $contacts = Contacts::all();
        return view('backend.pages.contacts.index', compact('contacts'));
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['contacts.create']);
        $groups = Groups::where('status', 'active')->select(['name', 'id'])->get();
        return view('backend.pages.contacts.create', compact('groups'));  
    }

    public function store(Request $request): RedirectResponse
    {
       $this->checkAuthorization(auth()->user(), ['contacts.create']);

        // Validation Data.
        $request->validate([
            'name' => 'required|max:100',
            'code' => 'required|max:4' ,
            'phone' => 'required|max:10', 
        ],[ 'name.requried' => 'Please give a name'
         ]);
        Contacts::create($request->all());

        session()->flash('success', 'Contacts been created.');
        return redirect()->route('admin.contacts.index');
    }

    public function edit(int $id): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['contacts.edit']);
        $groups = Groups::where('status', 'active')->select(['name', 'id'])->get();
        return view('backend.pages.contacts.edit', [ 'admin' => Contacts::find($id) , 'groups' => $groups]);  
    }

    public function update(Request $request, int $id): RedirectResponse
    {
       $this->checkAuthorization(auth()->user(), ['contacts.edit']);

        // Create New Admin.
        $contacts = Contacts::find($id);

        // Validation Data.
        $request->validate([
            'name' => 'required|max:50',
            'code' => 'required|max:4' ,
            'phone' => 'required|max:10', 
        ]);

        $contacts->name = $request->name;
        $contacts->code = $request->code;
        $contacts->phone = $request->phone;
        $contacts->whatsapp = $request->whatsapp;
        $contacts->group = $request->group;
        
        $contacts->save();
        session()->flash('success', 'Contacts has been updated.');
        return back();
    }

    public function destroy(int $id): RedirectResponse
    {

        $this->checkAuthorization(auth()->user(), ['contacts.delete']);
        Contacts::findOrFail($id)->delete();
        session()->flash('success', 'Contact has been deleted.');
        return redirect()->route('admin.contacts.index');

       
    }
}

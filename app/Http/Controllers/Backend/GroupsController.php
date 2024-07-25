<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Groups;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class GroupsController extends Controller
{
    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['groups.view']);
        $message = Groups::all();
        return view('backend.pages.groups.index', compact('message'));
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['groups.create']);
        $status = ['active' => 'Active' , 'inactive' => 'Inactive'];
        return view('backend.pages.groups.create', ['status' => $status]);  
    }

    public function store(Request $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['groups.create']);

        $request->validate([
            'name' => 'required|max:150',
            'comments' => 'required' ,
            'status' => 'required', 
        ]);
        Groups::create($request->all());

        session()->flash('success', 'Groups been created.');
        return redirect()->route('admin.groups.index');
    }

    public function edit(int $id): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['groups.edit']);
        $status = ['active' => 'Active' , 'inactive' => 'Inactive'];
        return view('backend.pages.groups.edit', [ 'admin' => Groups::find($id) , 'status' => $status]);  
    }

    public function update(Request $request, int $id): RedirectResponse
    {
       $this->checkAuthorization(auth()->user(), ['groups.edit']);
        $messages = Groups::find($id);

        // Validation Data.
        $request->validate([
            'name' => 'required|max:150',
            'comments' => 'required' ,
            'status' => 'required', 
        ]);

        $messages->name = $request->name;
        $messages->comments = $request->comments;
        $messages->status = $request->status;
        
        $messages->save();
        session()->flash('success', 'Groups has been updated.');
        return back();
    }

    public function destroy(int $id): RedirectResponse
    {

        $this->checkAuthorization(auth()->user(), ['groups.delete']);
        Groups::findOrFail($id)->delete();
        session()->flash('success', 'Groups been deleted.');
        return redirect()->route('admin.groups.index');

       
    }
}

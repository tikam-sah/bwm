<?php

declare(strict_types=1);

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppMessage;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;


class WhatsappmessageController extends Controller
{
    public function index(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['whatsappmessage.view']);
        $message = WhatsAppMessage::all();
        return view('backend.pages.whatsappmessage.index', compact('message'));
    }

    public function create(): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['whatsappmessage.create']);
        $status = ['active' => 'Active' , 'inactive' => 'Inactive'];
        return view('backend.pages.whatsappmessage.create', ['status' => $status]);  
    }

    public function store(Request $request): RedirectResponse
    {
        $this->checkAuthorization(auth()->user(), ['whatsappmessage.create']);

        $request->validate([
            'title' => 'required|max:150',
            'message' => 'required' ,
            'status' => 'required', 
        ]);
        WhatsAppMessage::create($request->all());

        session()->flash('success', 'Whatsapp Message been created.');
        return redirect()->route('admin.whatsappmessage.index');
    }

    public function edit(int $id): Renderable
    {
        $this->checkAuthorization(auth()->user(), ['whatsappmessage.edit']);
        $status = ['active' => 'Active' , 'inactive' => 'Inactive'];
        return view('backend.pages.whatsappmessage.edit', [ 'admin' => WhatsAppMessage::find($id) , 'status' => $status]);  
    }

    public function update(Request $request, int $id): RedirectResponse
    {
       $this->checkAuthorization(auth()->user(), ['whatsappmessage.edit']);
        $messages = WhatsAppMessage::find($id);

        // Validation Data.
        $request->validate([
            'title' => 'required|max:150',
            'message' => 'required' ,
            'status' => 'required', 
        ]);

        $messages->title = $request->title;
        $messages->message = $request->message;
        $messages->status = $request->status;
        
        $messages->save();
        session()->flash('success', 'Message has been updated.');
        return back();
    }

    public function destroy(int $id): RedirectResponse
    {

        $this->checkAuthorization(auth()->user(), ['whatsappmessage.delete']);
        WhatsAppMessage::findOrFail($id)->delete();
        session()->flash('success', 'Message has been deleted.');
        return redirect()->route('admin.whatsappmessage.index');

       
    }
}

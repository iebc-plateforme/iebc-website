<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // On affiche les messages les plus récents en premier
        $contacts = Contact::latest()->paginate(15);
        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Display the specified resource and mark as read.
     */
    public function show(Contact $contact)
    {
        // Marquer le message comme lu lors de l'affichage
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        
        return redirect()->route('admin.contacts.index')
            ->with('success', 'Message de contact supprimé avec succès.');
    }
}
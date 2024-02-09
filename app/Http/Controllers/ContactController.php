<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ContactRepository;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    private $repository;
    public function __construct( ContactRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contact = Contact::all();
        return view("contact.index", compact("contact"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("contact.index");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->repository->store($request);
        return redirect()->route("contact.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view("contact.show", compact("contact"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        $contact = Contact::all();
        return view("contact.edit", compact("contact"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $this->repository->update($request, $contact);
        return redirect()->route("contact.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route("contact.index");
    }
}

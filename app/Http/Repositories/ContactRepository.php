<?php

namespace App\Http\Repositories;

use App\Models\Contact;

class ContactRepository
{


    public function store($request)
    {
        $contact = new Contact();
        $contact->name = $request->user()->name;
        $contact->message = $request->message;

        $contact->save();
    }

    public function update( $request, $contact)
    {
        $contact->name = $request->name;
        $contact->message = $request->message;

        $contact->save();
    }



}

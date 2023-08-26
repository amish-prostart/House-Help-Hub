<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends AppBaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Contact::all())
                ->addIndexColumn()
                ->make(true);
        }

        return view('contacts.index');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Contact::create($input);

        return response()->json(['success' => 'Contact us submitted successfully.']);
    }
}

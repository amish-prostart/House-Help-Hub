<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ReviewController extends AppBaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Review::all())
                ->addIndexColumn()
                ->make(true);
        }

        return view('reviews.index');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        Review::create($input);

        return response()->json(['success' => 'Review submitted successfully.']);
    }
}

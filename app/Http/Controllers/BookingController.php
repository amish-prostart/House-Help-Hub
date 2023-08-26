<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Category;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Yajra\DataTables\DataTables;

class BookingController extends AppBaseController
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Booking::with('provider','customer')->get())
                ->addIndexColumn()
                ->make(true);
        }

        return view('bookings.index');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $bookingExist = Booking::where('date',$input['date'])->where('time',$input['time'])->exists();
        if ($bookingExist){
            return $this->sendError('Booking date and time already exists.');
        }
        Booking::create($input);

        return response()->json(['success' => 'Booking created successfully.']);
    }
}

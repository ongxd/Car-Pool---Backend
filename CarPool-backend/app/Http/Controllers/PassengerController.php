<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;

class PassengerController extends Controller
{
    /// GET /products
    public function list()
    {
        $passengers = Passenger::all();

        return view('users.list', ['passengers' => $passengers]);
    }
}

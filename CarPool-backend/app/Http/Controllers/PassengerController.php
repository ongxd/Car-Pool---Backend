<?php

namespace App\Http\Controllers;

use App\Models\Passenger;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PassengerController extends Controller
{
    private function saveStudentCardPhoto($file)
    {
        $name = Str::ulid() . '.jpg';
        Image::make($file)->save(public_path("/studentCard/$name"));

        return $name;
    }

    private function saveProfileImgPhoto($file)
    {
        $name = Str::ulid() . '.jpg';
        Image::make($file)->save(public_path("/profileImg/$name"));

        return $name;
    }

    private function deleteStudentCardPhoto($name)
    {
        if ($name != '0.jpg') {
            // TODO
            File::delete(public_path("/studentCard/$name"));
        }
    }

    private function deleteProfileImgPhoto($name)
    {
        if ($name != '0.jpg') {
            // TODO
            File::delete(public_path("/profileImg/$name"));
        }
    }

    //List passenger
    public function list()
    {
        $passengers = Passenger::all();

        return view('passengers.list', ['passengers' => $passengers]);
    }

    //Get passenger edit detail
    public function edit($id)
    {
        $passenger = Passenger::find($id);
        return view('passengers.edit', ['passenger' => $passenger]);
    }

    // Update passenger detail to DB
    public function performEdit(Request $request, Passenger $passenger)
    {
        $request->validate([
            'email' => 'required|email',
            'name' => 'required|max:100',
            'gender' => 'required|in:M,F',
            'contactNo' => 'required|',
            'studentCard' => 'mimes:jpg,png,jpeg',
            'profileImg' => 'mimes:jpg,png,jpeg',
            'studentCardExpDate' => 'required',
            'remark' => 'max:255',
            'passengerStatus' => 'in:Pending Approval,Rejected,Approved'
        ]);

        $newPassenger = $passenger;
        $newPassenger->email = $request->input('email');
        $newPassenger->name = $request->input('name');
        $newPassenger->gender = $request->input('gender');
        $newPassenger->contactNo = $request->input('contactNo');
        $newPassenger->studentCardExpDate = $request->input('studentCardExpDate');
        $newPassenger->passengerStatus = $request->input('passengerStatus');
        $newPassenger->remark =  trim($request->input('remark'));

        if ($request->studentCard) {
            $this->deleteStudentCardPhoto($newPassenger->studentCard);
            $newPassenger->studentCard = $this->saveStudentCardPhoto($request->studentCard);
        }
        if ($request->profileImg) {
            $this->deleteProfileImgPhoto($newPassenger->profileImg);
            $newPassenger->profileImg = $this->saveProfileImgPhoto($request->profileImg);
        }

        $result = $newPassenger->update();

        return view('passengers.edit', ['passenger' => $newPassenger]);
    }

    //Delete passenger 
    public function destroy(Passenger $passenger)
    {
        $newPassenger = $passenger;
        $this->deleteStudentCardPhoto($passenger->studentCard);
        $this->deleteProfileImgPhoto($passenger->profileImg);

        $result = $newPassenger->delete();

        if ($result) {
            return response()->json([
                'status' => 200,
                'passenger' => $newPassenger
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => $result
            ], 404);
        }
    }

    //API to get passenger detail
    public function getPassengerDetailAPI($email)
    {

        $passenger = Passenger::where('email', $email)->get();

        if ($passenger->count() > 0) {
            return response()->json([
                'status' => 200,
                'passenger' => $passenger
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Records Found"
            ], 404);
        }
    }

    //API to create passenger [register]
    public function createPassengerAPI(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:passengers', //email cannot duplicated
            'password' => 'required|min:6|confirmed', //remember to add one more field name "password_confirmation"
            'name' => 'required|max:100',
            'gender' => 'required|in:M,F',
            'contactNo' => 'required|',
            'studentCard' => 'required|mimes:jpg,png,jpeg',
            'profileImg' => 'required|mimes:jpg,png,jpeg',
            'studentCardExpDate' => 'required'
        ]);

        $passenger = new Passenger();
        $passenger->email = $request->input('email');
        $passenger->password = $request->input('password');
        $passenger->name = $request->input('name');
        $passenger->gender = $request->input('gender');
        $passenger->contactNo = $request->input('contactNo');
        $passenger->studentCard = $this->saveStudentCardPhoto($request->studentCard);
        $passenger->profileImg = $this->saveProfileImgPhoto($request->profileImg);
        $passenger->studentCardExpDate = $request->input('studentCardExpDate');
        $result = $passenger->save();

        if ($result) {
            return response()->json([
                'status' => 200,
                'passenger' => $passenger
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "No Records Found"
            ], 404);
        }
    }

    //API to update passenger 
    public function updatePassengerAPI(Request $request, Passenger $passenger)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
            'name' => 'required|max:100',
            'gender' => 'required|in:M,F',
            'contactNo' => 'required|',
            'studentCard' => 'mimes:jpg,png,jpeg',
            'profileImg' => 'mimes:jpg,png,jpeg',
            'studentCardExpDate' => 'required'
        ]);

        $newPassenger = $passenger;
        $newPassenger->email = $request->input('email');
        $newPassenger->password = $request->input('password');
        $newPassenger->name = $request->input('name');
        $newPassenger->gender = $request->input('gender');
        $newPassenger->contactNo = $request->input('contactNo');
        $newPassenger->studentCardExpDate = $request->input('studentCardExpDate');

        if ($request->studentCard) {
            $this->deleteStudentCardPhoto($newPassenger->studentCard);
            $newPassenger->studentCard = $this->saveStudentCardPhoto($request->studentCard);
        }
        if ($request->profileImg) {
            $this->deleteProfileImgPhoto($newPassenger->profileImg);
            $newPassenger->profileImg = $this->saveProfileImgPhoto($request->profileImg);
        }

        $result = $newPassenger->update();

        if ($result) {
            return response()->json([
                'status' => 200,
                'passenger' => $newPassenger
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => $result
            ], 404);
        }
    }
}

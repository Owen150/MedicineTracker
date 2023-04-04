<?php

namespace App\Http\Controllers;

use App\Exports\SupplierProductExport;
use App\Http\Middleware\TwoFactor;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Http\Request;
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = Facility::orderBy('type', 'desc')->get();

        return view('users.index')->with('facilities',$facilities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $facilities = Facility::orderBy('type', 'desc')->get();
        return view('users.create')->with('facilities',$facilities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $generator = new ComputerPasswordGenerator();

        $generator->setLowercase()->setNumbers(false)->setSymbols(false)->setLength(6);

        $password = $generator->generatePassword();

        $request->validate([
            'name' => 'required',
            'employee_number' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'role' => 'required',
            'phone_number' => 'required'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->employee_number = $request->employee_number;
        $user->designation = $request->designation;
        $user->role = $request->role;
        $user->email = $request->email;

        if ($request->facility == "undefined") {
            
        } else {
            $user->facility_id = $request->facility;
        }
        
        $user->password = Hash::make('12345678');
        $user->phone_number = $request->phone_number;
        //todo send notification
        //Notification::send($staff, new GeneratedPassword($password));

        if ($user->save()) {
            return response(1);

        }

        return response(0);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $facilities = Facility::all();

        return view('users.edit')->with(['user' => $user, 'facilities' => $facilities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*
        $generator = new ComputerPasswordGenerator();

        $generator->setLowercase()->setNumbers(false)->setSymbols(false)->setLength(6);

        $password = $generator->generatePassword();
        */

        $request->validate([
            'name' => 'required',
            'employee_number' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'role' => 'required',
            'phone_number' => 'required'
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->employee_number = $request->employee_number;
        $user->designation = $request->designation;
        $user->role = $request->role;
        $user->email = $request->email;
        if ($request->facility == "undefined") {
            $user->facility_id = null;
        } else {
            $user->facility_id = $request->facility;
        }
        $user->phone_number = $request->phone_number;
        //$user->password = Hash::make($password);

        //todo send notification
        //Notification::send($staff, new GeneratedPassword($password));

        if ($user->update()) {
            return response(1);

        }

        return response(0);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if ($user->delete()) {
            return response(1);
        }

        return response(0);
    }

    public function indexData()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        return response($users);
  
    }

    /**
     * 
     * view to verify to factor
    */
    public function towFactor()
    {
        $user = Auth::user();

        return view('twofactor.form')->with('user', $user);
    }

    /**
     * 
     * validate two factore code
     */

    public function validateRedirectTwoFactor(Request $request)
    {
        $request->validate([
            'two_factor_code' => 'required|integer'
        ]);

        $user = Auth::user();

        $userRole = $user->role;

        if ($user->two_factor_code == $request->two_factor_code) {

            $user->resetTwoFactorCode();

            if ($userRole === 'admin') {
            

                return redirect()->route('home');
            }
    
            if ($userRole === 'cp') {
                return redirect()->route('home');
            }
    
            if ($userRole === 'cd') {
                return redirect()->route('home');
            }
    
            if ($userRole === 'co') {
                return redirect()->route('home');
            }
        } else {
            return redirect()->back()->with('unsuccess', 'Two factor code entered does not match');
        }


       
        
         
        
    }

    public function resend()
    {
        $user = Auth::user();

        $user->generateTwoFactorCode();

        $user->notify(new TwoFactor());

        return redirect()->back()->with('success', 'Two factor code has been resent');
    }

    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $request->validate([
            'firstname' => 'required|string|max:255|min:1',
            'middlename' => 'required|string|max:255|min:1',
            'lastname' => 'required|string|max:255|min:1',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'mobile_number' => 'required|string|max:255|min:1',
            'date_of_birth' => 'required|string|max:255|min:1',
            'address' => 'required|string|max:255',
            'source_of_income' => 'required|string|max:255',
            'govt_id' => 'required|image|mimes:jpg,jpeg,gif,png',
            'govt_id_type' => 'required|string|max:255|min:1',
            'selfie_with_id' => 'required|image|mimes:jpg,jpeg,gif,png',
            'e_signature' => 'required|image|mimes:jpg,jpeg,gif,png',
        ]);

        $imageName_govt_id = null;
        $imageName_selfie_with_id = null;

        //check if request has file attached
        if (!$request->hasFile('govt_id')) {
            return redirect()->back()->withErrors(["msg" => "Government ID (with address) is required."])->withInput();
        }

        //check if request has file attached
        if (!$request->hasFile('selfie_with_id')) {
            return redirect()->back()->withErrors(["msg" => "Selfie with ID is required."])->withInput();
        }

        //check if request has file attached
        if (!$request->hasFile('e_signature')) {
            return redirect()->back()->withErrors(["msg" => "E-Signature is required."])->withInput();
        }

        $file_govt_id = $request['govt_id'];
        $imageName_govt_id = date("Y_m_d_H_i_s_") . hash('md5', $file_govt_id->getClientOriginalName()) . "." .
            $file_govt_id->getClientOriginalExtension();

        $file_selfie_with_id = $request['selfie_with_id'];
        $imageName_selfie_with_id = date("Y_m_d_H_i_s_") . hash('md5', $file_selfie_with_id->getClientOriginalName()) . "." .
            $file_selfie_with_id->getClientOriginalExtension();

        $file_e_signature = $request['e_signature'];
        $imageName_e_signature = date("Y_m_d_H_i_s_") . hash('md5', $file_e_signature->getClientOriginalName()) . "." .
            $file_e_signature->getClientOriginalExtension();


        // Save the file to the 'public/car_images' folder
        Storage::disk('public')->put('govt_id/' . $imageName_govt_id, file_get_contents($file_govt_id));
        Storage::disk('public')->put('selfie_id/' . $imageName_selfie_with_id, file_get_contents($file_selfie_with_id));
        Storage::disk('public')->put('e_signature/' . $imageName_e_signature, file_get_contents($file_e_signature));

        $user = new User();
        $user->firstname = $request->firstname;
        $user->middlename = $request->middlename;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->mobile_number = $request->mobile_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->address = $request->address;
        $user->source_of_income = $request->source_of_income;
        $user->govt_id_type = $request->govt_id_type;
        // $user->customer_status = (int)$user::PENDING;
        $user->govt_id = (string) $imageName_govt_id;
        $user->selfie_with_id =  (string) $imageName_selfie_with_id;
        $user->e_signature =  (string) $imageName_e_signature;
        $user->save();

        MailController::sendPendingApproval(
            $request->email,
            [
                "name" => $request->name,
                "attachment" => $request->attachment,
            ]
        );


         return redirect('/register')->with('status', 'Registration successful! Your account is pending approval. Please check your email for the approval status.');

          // Log the user in
        // Auth::login($user);

        // Redirect to the intended route
        // return redirect()->intended('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $user = User::find(Auth::user()->id);
        $contacts = Contact::where('user_id',Auth::user()->id)->get();
        $userAddress = UserAddress::where('user_id', Auth::user()->id)->first();
        return view('back-end.profile',[
            'user' => $user,
            'contacts' => $contacts,
            'address' => $userAddress,
        ]);
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(),[
            'current_pass' => 'required',
            'new_pass' => 'required',
            'c_password' => 'required|same:new_pass',
        ]);

        Session()->flash('change-password');

        if($validator->passes()){
            $current_password = $request->current_pass;
            $user = User::find(Auth::user()->id);
            if(password_verify($current_password, $user->password)){
                $user->password = Hash::make($request->new_pass);
                $user->save();
                session()->flash('success', 'Password changed Successfully');
                return redirect()->back();
            }
        }else{
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    public function updateProfile(Request $request){
       $validator = Validator::make($request->all(),[
            'name' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','unique:users,email,'.Auth::user()->id],
            'phone' => ['required','string','max:20','unique:users,phone,'.Auth::user()->id],
        ]);


        session()->flash('profile');

        #----------------------User Update start--------------------

        if($validator->passes()){
            $user = User::find(Auth::user()->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;

             if(!empty($request->image_name)){
                $imageName = $request->image_name;
                $image_path = public_path('uploads/temp/'.$imageName);
                $user_path  = public_path('uploads/user/'.$imageName);
                if(File::exists($image_path)){
                    File::copy($image_path,$user_path);
                    File::delete($image_path);
                }

                $user->image = $imageName;
            }

            $user->save();

            #----------------------User Update / Create end--------------------



            #----------------------Address Update / Create start--------------------

            $findAddress  = UserAddress::where('user_id', Auth::user()->id)->first(); // get user only one
            if( $findAddress != null){
                // update
                $findAddress->address = $request->address;
                $findAddress->save();
            }else{
                // insert
                $address = new UserAddress(); // create object to create user address
                $address->user_id = Auth::user()->id; // catch user id
                $address->address = $request->address; // address feild -> address request
                $address->save(); // save


            }

            #----------------------Address Update / Create end--------------------




            #----------------------Contacts Update / Create start--------------------

            $findContact = Contact::where('user_id', Auth::user()->id)->first(); // find user id for forignkey (only one) (user have contact yet)

            if($findContact != null){
                //update Contact already exist
                $allContact = Contact::where('user_id', Auth::user()->id)->get(); // get allContact to update (2up)

                // "link" => array:2[
                //     0 => "http://facbook/thearak",
                //     1 => "http://telegram/thearak"
                // ]
                $links = $request->link;


                // loop one by one
                for($i=0; $i < count($allContact); $i++){
                    // contact_url feilds
                    $allContact[$i]->contact_url  = $links[$i];
                    $allContact[$i]->save();
                }
            }else{
                //insert Contact dosen't exist
                $links = $request->link;
                for($i = 0; $i < count($links); $i++){
                    $contact = new Contact(); // Create new object
                    $contact->user_id = Auth::user()->id; //catch user id
                    $contact->contact_url = $links[$i]; //insert urls
                    $contact->save(); // save
                }
            }

            #----------------------Contact Update / Create end--------------------



           return redirect()->back()->with('success','Profile update successfully.');
        }else{
            return redirect()->withInput()->withErrors($validator);
        }
    }

     public function changeImageProfile(Request $request){

        session()->flash('profile');

        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move("uploads/temp/", $name);

            return response([
                'status' => 200,
                'image' => $name,
                'message' => 'Image uploaded successfully.'
            ]);
        }else{
            return response()->json([
                'status' => 500,
                'message' => 'Failed to upload image.'
            ]);
        }
    }

}

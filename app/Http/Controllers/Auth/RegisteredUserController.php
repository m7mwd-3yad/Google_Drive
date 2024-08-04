<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rule;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{

    public function changImage(Request $request, $id)
    {
        $users = User::find($id);
        $user_image = $request->file('image');
        if ($user_image == null) {
            $file_path = $users->image;

        } else {

            $file_Name = rand(0,255). $user_image->getClientOriginalName();
            $location = public_path() . '/user_image';
            $user_image->move($location, $file_Name);
            $file_path = 'user_image/' . $file_Name;
        }
        if($users->image != 'user_imag/fake.png'){
            $oldImage =public_path().'/' . $users->image;
            unlink($oldImage);
        }
        $users->image = $file_path;
        $users->save();
        return back()->with("done","Updated Image Successfully");
    }
    public function index()
    {
        $users = User::all();
        return view('auth.users', compact('users'));
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $rule = Rule::all();
        return view('auth.register', compact('rule'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {

        $file_size = 5 * 1024;

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ["max:$file_size", "mimes:jpg"],
            'rule_id' => ['required'],
        ]);


        $user_image = $request->file('image');
        if ($user_image == null) {
            $file_path = '/user_image/fake.png';

        } else {

            $file_Name = $user_image->getClientOriginalName();
            $location = public_path() . '/user_image';
            $user_image->move($location, $file_Name);
            $file_path = '/user_image' . $file_Name;
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'image' => $file_path,
            'rule_id' => $request->rule_id,
        ]);


        event(new Registered($user));

        // Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

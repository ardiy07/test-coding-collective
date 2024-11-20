<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class AuthController extends Controller
{
    /**
     * Display the login page.
     *
     * @return \Illuminate\View\View
     */
    public function login()
    {
        return view('pages.auth.login');
    }

    /**
     * Display the registration page.
     *
     * @return \Illuminate\View\View
     */
    public function register()
    {
        return view('pages.auth.register');
    }

    /**
     * Handle registration form submission.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerStore(Request $request)
    {
        try {
            // Validate input data
            $request->validate([
                'name' => 'required|string|max:255|min:4',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
            ]);

            // Assign input values to variables
            $name = $request->name;
            $email = $request->email;
            $password = bcrypt($request->password);

            // Begin database transaction
            DB::beginTransaction();

            // Create a new user record in the database
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);

            // Commit the transaction if successful
            DB::commit();
            return redirect()->route('login')->with('success', 'Registration successful! Please log in.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction on validation failure
            DB::rollBack();
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Rollback the transaction on general failure
            DB::rollBack();
            return redirect()->back()->with('error', 'Registration failed. Please try again.');
        }
    }

    /**
     * Handle login authentication using API.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authLogin(Request $request)
    {
        // Dispatch an internal request to the API login route
        $response = Route::dispatch(
            Request::create('/api/login', 'POST', $request->all())
        );

        // Check if login was successful
        if ($response->getStatusCode() == 200) {
            $data = json_decode($response->getContent(), true);
            $request->session()->put('auth_token', $data['token']);
            return redirect()->route('user.index');
        }

        // Redirect back to login with an error message
        return redirect()->route('login')->with('error', 'Email or password is incorrect');
    }

    /**
     * Handle logout by calling the API logout route.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function authLogout(Request $request)
    {
        // Retrieve the authentication token from session
        $token = $request->session()->get('auth_token');

        // Dispatch an internal request to the API logout route
        $internalRequest = Request::create('/api/logout', 'POST');
        $internalRequest->headers->set('Authorization', "Bearer $token");
        $response = Route::dispatch($internalRequest);

        // Check if logout was successful
        if ($response->getStatusCode() == 200) {
            $request->session()->forget('auth_token');
            $request->session()->invalidate();
            return redirect()->route('auth.login');
        }

        // Redirect back with an error message if logout fails
        return redirect()->route('user.index')->with('error', 'Logout failed, please try again');
    }
}

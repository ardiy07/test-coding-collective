<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Retrieve all users from the database
        $users = User::all();

        // Return the 'index' view with the users data
        return view('pages.user.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Retrieve the user by ID, or fail if not found
        $user = User::findOrFail($id);

        // Return the 'edit' view with the user's data
        return view('pages.user.edit', compact('user'));
    }

    /**
     * Update the specified user in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Start a database transaction to ensure atomic updates
        DB::beginTransaction();

        try {
            // Validate the incoming data
            $request->validate([
                'name' => 'required|string|max:255', // Name should be a string, max length of 255 characters
                'email' => 'required|email|max:255|unique:users,email,' . $id, // Email must be unique except for the current user
                'password' => 'nullable|string|min:8', // Password is optional but must be at least 8 characters if provided
            ]);

            // Retrieve the user by ID
            $user = User::findOrFail($id);

            // Update user data with validated input
            $user->update([
                'name' => $request->input('name'), // Update name
                'email' => $request->input('email'), // Update email
                'password' => bcrypt($request->input('password') ?: $user->password), // Update password if provided, otherwise retain the current password
            ]);

            // Commit the transaction if everything goes well
            DB::commit();

            // Redirect to the user edit page with a success message
            return redirect()->route('user.show', $id)->with('success', 'User updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction if validation fails
            DB::rollBack();
            // Redirect back with validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Rollback the transaction if any error occurs
            DB::rollBack();
            // Return an error message and redirect back
            return redirect()->route('user.show', $id)->with('error', 'Failed to update user. Please try again.');
        }
    }
}

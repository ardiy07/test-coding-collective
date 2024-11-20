<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a list of all employees.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Retrieve all employees along with their associated user data
        $employees = Employee::with('user')->get();
        
        // Return the employee index view with the employee data
        return view('pages.employee.index', compact('employees'));
    }

    /**
     * Display a specific employee for editing.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Retrieve the employee along with their associated user data
        $employee = Employee::with('user')->findOrFail($id);
        
        // Return the employee edit view with the employee data
        return view('pages.employee.edit', compact('employee'));
    }

    /**
     * Update the specified employee's details.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        // Start a database transaction to ensure atomicity
        DB::beginTransaction();

        try {
            // Validate only the fields that are being updated (city and dob)
            $request->validate([
                'city' => 'required|string|max:255',
                'dob' => 'nullable|date', // Validate dob as a valid date
            ]);

            // Retrieve the employee by ID
            $employee = Employee::findOrFail($id);

            // Prepare an array to store the updated data
            $updateData = [];

            // If the 'city' field is provided, update it
            if ($request->has('city')) {
                $updateData['city'] = $request->input('city');
            }

            // If the 'dob' field is provided and valid, update it
            if ($request->has('dob') && $request->input('dob')) {
                // Ensure the dob is in the correct format (Y-m-d)
                $updateData['dob'] = Carbon::parse($request->input('dob'))->format('Y-m-d');
            }

            // Perform the update
            $employee->update($updateData);

            // Commit the transaction if everything goes well
            DB::commit();

            // Redirect to the employee show page with a success message
            return redirect()->route('employee.show', $id)->with('success', 'Employee updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction if validation fails
            DB::rollBack();
            // Redirect back with validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Rollback the transaction if any other error occurs
            DB::rollBack();
            // Return an error message and redirect back
            return redirect()->route('employee.show', $id)->with('error', 'Failed to update employee. Please try again.');
        }
    }
}

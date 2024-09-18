<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Exception;

class RolePermissionController extends Controller
{
    /**
     * Show the form for creating new roles and permissions.
     */
    public function create()
    {
        return view('roles-permissions.create');
    }

    /**
     * Store a newly created role and permission in the database.
     */
    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'role_name' => ['required', 'string', 'max:255'],
                'permissions' => ['array'],
                'permissions.*' => ['string'],
            ]);

            // Create the role
            $role = Role::create(['name' => $request->role_name]);

            // Assign permissions to the role
            if ($request->has('permissions')) {
                $role->givePermissionTo($request->permissions);
            }

            // Redirect with success message
            return redirect()->route('roles-permissions.create')
                ->with('success', 'Role and permissions created successfully.');

        } catch (Exception $e) {
            // Log the error details
            Log::error('Error creating role and permissions: ' . $e->getMessage());

            // Redirect back with an error message
            return redirect()->route('roles-permissions.create')
                ->with('error', 'An error occurred while creating the role and permissions. Please try again.');
        }
    }
}

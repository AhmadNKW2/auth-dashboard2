<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\RolePermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/assign-role', function () {
    // Creating roles and permissions
    $role = Role::create(['name' => 'admin']);
    $permission = Permission::create(['name' => 'edit articles']);
    
    $user = User::find(1); // Find the first user
    
    // Assign role to user
    $user->assignRole('admin');

    // Give permission to role
    $role->givePermissionTo('edit articles');
    
    return 'Role and Permission assigned';
});

use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');
    
// Route to show the form for creating new roles and permissions
Route::get('/roles-permissions/create', [RolePermissionController::class, 'create'])
    ->middleware('auth')
    ->name('roles-permissions.create');

// Route to handle form submission
Route::post('/roles-permissions/create', [RolePermissionController::class, 'store'])
    ->middleware('auth')
    ->name('roles-permissions.store');


require __DIR__.'/auth.php';

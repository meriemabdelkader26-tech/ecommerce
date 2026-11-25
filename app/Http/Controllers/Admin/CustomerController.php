<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->latest()->paginate(20);

        return view('admin.customers.index', compact('customers'));
    }

    public function update(Request $request, User $customer)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:30'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$customer->id],
        ]);

        $customer->update($validated);

        return back()->with('status', 'Client mis a jour.');
    }

    public function destroy(User $customer)
    {
        $customer->delete();

        return back()->with('status', 'Client supprime.');
    }
}

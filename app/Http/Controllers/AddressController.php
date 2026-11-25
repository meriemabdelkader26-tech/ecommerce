<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $validated = $this->validatedAddress($request);
        $user = $request->user();
        $validated['is_default'] = $request->boolean('is_default') || ! $user->addresses()->exists();

        DB::transaction(function () use ($user, $validated) {
            if ($validated['is_default']) {
                $user->addresses()->update(['is_default' => false]);
            }

            $user->addresses()->create($validated);
        });

        return back()->with('status', 'Adresse enregistree.');
    }

    public function update(Request $request, Address $address)
    {
        $address = $request->user()->addresses()->findOrFail($address->id);
        $validated = $this->validatedAddress($request);
        $validated['is_default'] = $request->boolean('is_default');

        DB::transaction(function () use ($address, $validated) {
            if ($validated['is_default']) {
                $address->user->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
            }

            $address->update($validated);
        });

        return back()->with('status', 'Adresse mise a jour.');
    }

    public function destroy(Request $request, Address $address)
    {
        $address = $request->user()->addresses()->findOrFail($address->id);
        $wasDefault = $address->is_default;
        $user = $request->user();

        DB::transaction(function () use ($address, $wasDefault, $user) {
            $address->delete();

            if ($wasDefault) {
                $nextAddress = $user->addresses()->oldest()->first();
                $nextAddress?->update(['is_default' => true]);
            }
        });

        return back()->with('status', 'Adresse supprimee.');
    }

    private function validatedAddress(Request $request): array
    {
        return $request->validate([
            'label' => ['required', 'string', 'max:50'],
            'recipient_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:100'],
            'is_default' => ['sometimes', 'boolean'],
        ]);
    }
}

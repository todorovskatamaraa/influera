<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ContactInfoController extends Controller
{
    public function edit(Request $request)
    {
        return view('settings.contact-info');
    }

    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:255'],
            'email'   => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone'   => ['nullable', 'string', 'max:50'],
            'country' => ['nullable', 'string', 'max:255'],
        ]);

        $user->fill($validated)->save();

        return redirect()
            ->route('settings.contact')
            ->with('contact_updated', true);
    }
}

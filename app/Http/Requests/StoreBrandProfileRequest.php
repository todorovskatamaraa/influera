<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBrandProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'company_name' => ['required', 'string', 'max:255'],
            'industry'     => ['required', 'string', 'max:255'],
            'about'        => ['required', 'string'],
            'location'     => ['required', 'string', 'max:255'],
            'website'      => ['nullable', 'url', 'max:255'],

            'company_logo' => ['required', 'image', 'max:6144'],
            'company_cover'=> ['nullable', 'image', 'max:12288'],

            'social_links'   => ['array'],
            'social_links.*' => ['nullable', 'url', 'max:255'],

            'campaign_title'    => ['nullable', 'string', 'max:255'],
            'age_range'         => ['nullable', 'string', 'max:50'],
            'gender'            => ['nullable', 'string', 'max:50'],
            'audience_location' => ['nullable', 'string', 'max:100'],
            'niche'             => ['nullable', 'string', 'max:100'],

            'budget_type'  => ['nullable', 'in:fixed,range'],
            'budget_fixed' => ['nullable', 'integer', 'min:0'],
            'budget_min'   => ['required_if:budget_type,range', 'integer', 'min:0'],
            'budget_max'   => ['required_if:budget_type,range', 'integer', 'min:0', 'gte:budget_min'],

            'platforms'   => ['array'],
            'platforms.*' => ['string', 'max:50'],

            'campaign_brief' => ['nullable', 'string'],
        ];
    }
}

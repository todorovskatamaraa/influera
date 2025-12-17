<div class="w-full lg:w-64 shrink-0">
    <h1 class="text-2xl font-bold text-slate-900 mb-8">Settings</h1>

    @php
        $active = $active ?? '';
        $link = 'px-4 py-2 text-sm text-slate-500 hover:text-slate-900 hover:border-l-2 hover:border-slate-300 hover:-ml-0.5 transition-all';
        $linkActive = 'px-4 py-2 text-sm font-bold text-primary border-l-2 border-primary -ml-0.5';
    @endphp

    {{-- Billing --}}
    <div class="mb-8">
        <h2 class="text-sm font-bold text-slate-900 mb-4">Billing</h2>
        <nav class="flex flex-col space-y-1 border-l-2 border-slate-100">
            <a href="{{ route('settings.billing') }}"
               class="{{ $active === 'billing' ? $linkActive : $link }}">
                Billing & Payments
            </a>
        </nav>
    </div>

    {{-- Settings --}}
    <div>
        <h2 class="text-sm font-bold text-slate-900 mb-4">User Settings</h2>
        <nav class="flex flex-col space-y-1 border-l-2 border-slate-100">
            <a href="{{route('settings.memberships')}}"
               class="{{ $active === 'memberships' ? $linkActive : $link }}">
                Memberships & Connect
            </a>

            <a href="{{route('settings.contact')}}"
               class="{{ $active === 'contact' ? $linkActive : $link }}">
                Contact Info
            </a>

            <a href="{{route('settings.tax-information')}}"
               class="{{ $active === 'tax' ? $linkActive : $link }}">
                Tax Information
            </a>

            <a href="{{route('settings.my-profile')}}"
               class="{{ $active === 'my-profile' ? $linkActive : $link }}">
                My Profile
            </a>

            <a href="{{route('settings.profile-settings')}}"
               class="{{ $active === 'profile-settings' ? $linkActive : $link }}">
                Profile Settings
            </a>

            <a href="{{route('settings.get-paid')}}"
               class="{{ $active === 'get-paid' ? $linkActive : $link }}">
                Get Paid
            </a>

            <a href="{{ route('settings.connected-services') }}"
               class="{{ $active === 'connected-services' ? $linkActive : $link }}">
                Connected Services
            </a>

            <a href="{{ route('settings.password-security') }}"
               class="{{ $active === 'password-security' ? $linkActive : $link }}">
                Password & Security
            </a>

            <a href="{{ route('settings.identity-verification') }}"
               class="{{ $active === 'identity-verification' ? $linkActive : $link }}">
                Identify Verification
            </a>

            <a href="{{route('settings.notifications')}}"
               class="{{ $active === 'notifications' ? $linkActive : $link }}">
                Notification Settings
            </a>
        </nav>
    </div>
</div>

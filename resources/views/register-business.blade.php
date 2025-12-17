@extends("layouts.register-layout")

@section("title", "Influentia - Create Your Business Profile")

@section("content")
  <div class="w-full max-w-5xl mx-auto">
    <form method="POST" action="{{ route('register-business-store') }}" enctype="multipart/form-data" id="business-form">
      @csrf

      <div class="mb-8">
        <h1 class="mb-2 text-3xl font-bold text-slate-900">
          Create Your Business Profile
        </h1>
        <p class="text-slate-500 text-sm">
          Set up your company profile to start finding creators
        </p>
      </div>

      {{-- Steps Indicator --}}
      <div class="mb-10 relative">
        <div class="w-full h-[2px] bg-slate-200 absolute bottom-0 left-0"></div>
        <div
          id="progress-bar"
          class="h-[2px] bg-primary transition-all absolute bottom-0 left-0 duration-300"
          style="width: 50%"
        ></div>

        <div class="flex items-center z-10 pb-4 relative w-full">
          <button
            type="button"
            onclick="goToStep(1)"
            class="flex text-sm font-bold text-primary transition-colors cursor-pointer step-btn group items-center gap-2 w-1/2 justify-start pl-8"
            data-step="1"
          >
            <span
              class="flex w-6 h-6 text-white text-xs bg-primary rounded-full border-2 border-primary items-center justify-center"
            >
              1
            </span>
            <span class="hidden md:inline">Company Info</span>
          </button>

          <button
            type="button"
            onclick="goToStep(2)"
            class="flex text-sm font-medium text-slate-400 transition-colors cursor-pointer step-btn group items-center gap-2 w-1/2 justify-start pl-8 hover:text-slate-600"
            data-step="2"
          >
            <span
              class="flex w-6 h-6 text-slate-400 text-xs bg-white rounded-full border-2 border-slate-200 items-center justify-center group-hover:border-slate-300"
            >
              2
            </span>
            <span class="hidden md:inline">Campaign Preferences</span>
          </button>
        </div>
      </div>

      @if ($errors->any())
        <div class="mb-6 p-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg">
          <ul class="pl-5 space-y-1 list-disc">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

  <div id="step-1-content" class="space-y-8 step-section">

    {{-- STEP TITLE --}}
    <div>
        <h2 class="mb-1 text-lg font-bold text-slate-900">Company Information</h2>
        <p class="text-xs text-slate-500">
            Tell us about your business to create the perfect brand profile
        </p>
    </div>

    {{-- UPLOAD SECTION --}}
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

        {{-- COMPANY LOGO --}}
        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Company Logo*</label>

            <div id="company-logo-box"
                 class="flex overflow-hidden h-40 bg-white text-slate-400 border-2 border-dashed border-slate-200 rounded-xl cursor-pointer upload-box transition-all items-center justify-center hover:border-primary hover:text-primary hover:bg-primary/5">

                <input type="file" accept="image/*" name="company_logo" id="company_logo_input" required
                       class="hidden upload-input" />

                <div class="upload-placeholder flex flex-col items-center justify-center">
                    <svg class="w-8 h-8 mb-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <span class="text-xs text-slate-600">Upload your company logo</span>
                </div>

                <img class="upload-preview hidden object-cover w-full h-full rounded-xl" id="company_logo_preview" />
            </div>

            <p class="hidden mt-1 text-xs text-red-500 error-message" id="company_logo_error">
                Company logo is required
            </p>
        </div>

        {{-- COMPANY COVER --}}
        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Company Cover</label>

            <div id="company-cover-box"
                 class="flex overflow-hidden h-40 bg-white text-slate-400 border-2 border-dashed border-slate-200 rounded-xl cursor-pointer upload-box transition-all items-center justify-center hover:border-primary hover:text-primary hover:bg-primary/5">

                <input type="file" accept="image/*" name="company_cover" id="company_cover_input"
                       class="hidden upload-input" />

                <div class="upload-placeholder flex flex-col items-center justify-center">
                    <svg class="w-8 h-8 mb-3 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                    </svg>
                    <span class="text-xs text-slate-600">Upload your company cover</span>
                </div>

                <img class="upload-preview hidden object-cover w-full h-full rounded-xl" id="company_cover_preview" />
            </div>
        </div>
    </div>

    {{-- BASIC INFO --}}
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Company Name*</label>
            <input type="text" name="company_name" class="form-input" placeholder="Enter your company name" />

            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="company_name">
                Company name is required
            </p>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Industry*</label>
            <select name="industry" class="form-input select-field text-slate-500">
                <option value="" disabled selected hidden>Select industry</option>
                <option value="technology">Technology</option>
                <option value="fashion">Fashion & Apparel</option>
                <option value="beauty">Beauty & Wellness</option>
                <option value="food">Food & Beverage</option>
                <option value="travel">Travel & Lifestyle</option>
            </select>

            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="industry">
                Industry is required
            </p>
        </div>
    </div>

    {{-- EMAIL + PASSWORD --}}
    <div class="grid grid-cols-1 gap-8 md:grid-cols-3">

        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Email*</label>
            <input type="email" name="email" class="form-input" placeholder="your@email.com" />

            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="email">
                Email is required
            </p>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Password*</label>
            <input type="password" name="password" class="form-input" placeholder="Create a password" />

            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="password">
                Password is required
            </p>
        </div>
        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Repeat Password*</label>
            <input type="password" name="password_confirmation" class="form-input" placeholder="Repeat your password" />

            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="password_confirmation">
                Repeat password is required
            </p>
        </div>
    </div>

    {{-- ABOUT US --}}
    <div>
        <label class="block mb-2 text-sm font-medium text-slate-700">About Us*</label>
        <textarea name="about" class="form-input h-32 resize-none"
                  placeholder="Tell us about your company..."></textarea>

        <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="about">
            About section is required
        </p>
    </div>

    {{-- WEBSITE + LOCATION --}}
    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">

        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Website</label>
            <input type="text" name="website" class="form-input" placeholder="https://yourcompany.com" />
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">Location*</label>
            <select name="location" class="form-input select-field text-slate-500">
                <option value="" disabled selected hidden>Select your location</option>
                <option>United States</option>
                <option>United Kingdom</option>
                <option>Canada</option>
                <option>Germany</option>
                <option>France</option>
            </select>

            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="location">
                Location is required
            </p>
        </div>
    </div>

    {{-- SOCIAL LINKS --}}
    <div>
        <label class="block mb-2 text-sm font-medium text-slate-700">Social Media Links</label>

        <div id="social-links-container" class="space-y-3 mb-3">
            <input type="text" name="social_links[]" class="form-input" placeholder="Social media link" />
            <input type="text" name="social_links[]" class="form-input" placeholder="Social media link" />
            <input type="text" name="social_links[]" class="form-input" placeholder="Social media link" />
        </div>

        <button type="button" onclick="addSocialLink()"
                class="w-full py-2 text-sm text-slate-500 border border-slate-200 rounded-lg hover:bg-slate-50">
            Add more
        </button>
    </div>

    {{-- INFO BOX --}}
    <div class="flex p-4 bg-primary/5 border border-primary/10 rounded-lg gap-3 items-start">
        <svg class="w-4 h-4 mt-1 text-primary" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>
            <polyline points="10 9 9 9 8 9"></polyline>
        </svg>

        <p class="text-xs text-slate-800">
            <span class="font-bold text-primary">Brand Profile:</span>
            This information helps us match you with creators who align with your brand values.
        </p>
    </div>

    {{-- ACTIONS --}}
    <div class="flex justify-end gap-4 pt-4">
        <button type="button" onclick="window.location.href='{{ route("register") }}'"
                class="w-24 px-6 py-2.5 text-sm font-medium text-slate-600 border border-slate-300 rounded-lg hover:bg-slate-50">
            Cancel
        </button>

        <button type="button" onclick="nextStep()"
                class="w-24 px-6 py-2.5 text-sm font-medium text-white bg-primary rounded-lg hover:bg-primary/90 shadow-lg shadow-primary/25">
            Next
        </button>
    </div>

</div>


      {{-- STEP 2: Campaign Preferences --}}
      <div id="step-2-content" class="hidden space-y-8 step-section">
        <div>
          <h2 class="mb-1 text-lg font-bold text-slate-900">
            Campaign Preferences
          </h2>
          <p class="text-xs text-slate-500">
            Define your ideal campaign to match with the right creators
          </p>
        </div>

        {{-- Campaign Title --}}
        <div>
          <label class="block mb-2 text-sm font-medium text-slate-700">
            Campaign Title*
          </label>
            <input
              type="text"
              name="campaign_title"
              required
              placeholder="Enter your campaign title"
              class="form-input"
            />
            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="campaign_title">
              Campaign title is required
            </p>
        </div>

        {{-- Target Audience --}}
        <div>
          <h3 class="mb-4 text-sm font-bold text-slate-900">Target Audience</h3>
          <div class="grid grid-cols-1 mb-6 gap-8 md:grid-cols-2">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Age Range*
              </label>
              <select
                name="age_range"
                required
                class="text-slate-500 select-field form-input"
              >
                <option value="" disabled selected hidden>
                  Select age range
                </option>
                <option>18-24</option>
                <option>25-34</option>
                <option>35-44</option>
                <option>45+</option>
              </select>
              <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="age_range">
                Age range is required
              </p>
            </div>
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Gender*
              </label>
              <select
                name="gender"
                required
                class="text-slate-500 select-field form-input"
              >
                <option value="" disabled selected hidden>Select gender</option>
                <option>All</option>
                <option>Female</option>
                <option>Male</option>
                <option>Non-binary</option>
              </select>
              <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="gender">
                Gender is required
              </p>
            </div>
          </div>
          <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Location*
              </label>
              <select
                name="audience_location"
                required
                class="text-slate-500 select-field form-input"
              >
                <option value="" disabled selected hidden>
                  Select location
                </option>
                <option>Global</option>
                <option>North America</option>
                <option>Europe</option>
                <option>Asia</option>
              </select>
              <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="audience_location">
                Audience location is required
              </p>
            </div>
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Niches*
              </label>
              <select
                name="niche"
                required
                class="text-slate-500 select-field form-input"
              >
                <option value="" disabled selected hidden>Select niche</option>
                <option>Fashion</option>
                <option>Beauty</option>
                <option>Technology</option>
                <option>Fitness</option>
              </select>
              <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="niche">
                Niche is required
              </p>
            </div>
          </div>
        </div>

        {{-- Budget --}}
        {{-- Budget --}}
        <div class="mt-8 space-y-4">
          <label class="block mb-3 text-sm font-medium text-slate-700">
            Budget per Campaign*
          </label>

          <div class="flex flex-wrap mb-5 gap-6">
            {{-- Fixed Budget --}}
            <label class="flex cursor-pointer items-center gap-2">
              <input
                type="radio"
                name="budget_type"
                class="custom-radio"
                value="fixed"
                checked
                onclick="setBudgetType('fixed')"
              />
              <span class="text-sm text-slate-700">Fixed Budget</span>
            </label>

            {{-- Budget Range --}}
            <label class="flex cursor-pointer items-center gap-2">
              <input
                type="radio"
                name="budget_type"
                class="custom-radio"
                value="range"
                onclick="setBudgetType('range')"
              />
              <span class="text-sm text-slate-700">Budget Range</span>
            </label>
          </div>

          {{-- Fixed amount input --}}
          <div id="budget-fixed-wrapper" class="space-y-2">
            <input
              type="number"
              id="budget_fixed"
              name="budget_fixed"
              placeholder="Enter fixed budget amount"
              class="form-input"
            />
            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="budget_fixed">
              Enter a fixed budget amount
            </p>
          </div>

          {{-- Range slider (min & max) --}}
          <div id="budget-range-wrapper" class="hidden space-y-4">
            <div class="flex justify-between text-xs font-bold text-slate-700">
              <span id="budget-min-label">$500</span>
              <span id="budget-max-label">$5000</span>
            </div>

            <div class="flex flex-col gap-4">
              <input
                id="budget_min"
                name="budget_min"
                type="range"
                min="0"
                max="10000"
                step="100"
                value="{{ old('budget_min', 500) }}"
                class="w-full accent-primary"
              />

              <input
                id="budget_max"
                name="budget_max"
                type="range"
                min="0"
                max="10000"
                step="100"
                value="{{ old('budget_max', 5000) }}"
                class="w-full accent-primary"
              />
            </div>

            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="budget_min">
              Select a minimum budget
            </p>
            <p class="hidden mt-1 text-xs text-red-500 error-message" data-error="budget_max">
              Select a maximum budget
            </p>
          </div>{{-- Platform Focus --}}
        <div>
          <label class="block mb-4 text-sm font-medium text-slate-700">
            Platform Focus*
          </label>
          <div class="grid grid-cols-2 gap-y-4 gap-x-2 md:grid-cols-5">
            @foreach (["Instagram", "TikTok", "Youtube", "X", "LinkedIn", "Facebook", "Snapchat", "Telegram", "Pinterest"] as $platform)
              <label class="flex cursor-pointer items-center gap-2">
                <input
                  type="checkbox"
                  name="platforms[]"
                  value="{{ $platform }}"
                  class="custom-checkbox"
                />
                <span class="text-sm text-slate-600">{{ $platform }}</span>
              </label>
            @endforeach
          </div>
        </div>

        {{-- Campaign Brief --}}
        <div>
          <label class="block mb-2 text-sm font-medium text-slate-700">
            Campaign Brief
          </label>
          <textarea
            name="campaign_brief"
            class="h-32 resize-none form-input"
            placeholder="Describe your campaign goals, key messages, and any specific requirements"
          ></textarea>
        </div>

        {{-- Info Box --}}
        <div
          class="flex p-4 bg-cyan-50 border border-cyan-100 rounded-lg items-start gap-3"
        >
          <div class="mt-0.5 text-cyan-600">
            <svg
              width="16"
              height="16"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            >
              <path d="M2 12h5" />
              <path d="M22 12h-5" />
              <path d="M12 2v5" />
              <path d="M12 22v-5" />
              <path
                d="M12 7a5 5 0 0 1 5 5 5 5 0 0 1-5 5 5 5 0 0 1-5-5 5 5 0 0 1 5-5z"
              />
            </svg>
          </div>
          <div>
            <p class="text-xs text-slate-800">
              <span class="font-bold text-cyan-700">Smart Matching:</span>
              Our AI will use these preferences to recommend the most suitable
              creators for your campaign.
            </p>
          </div>
        </div>

        {{-- Actions --}}
        <div class="flex pt-4 justify-end gap-4">
          <button
            type="button"
            onclick="prevStep()"
            class="w-24 px-6 py-2.5 text-sm font-medium text-slate-600 border border-slate-300 rounded-lg transition-colors cursor-pointer hover:bg-slate-50"
          >
            Back
          </button>
          <button
            type="submit"
            class="px-6 py-2.5 text-white text-sm font-medium bg-primary rounded-lg transition-colors shadow-lg shadow-primary/25 cursor-pointer hover:bg-primary/90"
          >
            Complete Application
          </button>
        </div>
      </div>
    </form>
  </div>

  <script>
    function markInvalid(el) {
      el.classList.add('ring-1', 'ring-red-400', 'border-red-300');
    }

    function clearInvalid(el) {
      el.classList.remove('ring-1', 'ring-red-400', 'border-red-300');
    }

    function hideErrors(step) {
      const section = document.getElementById(`step-${step}-content`);
      if (!section) return;

      section.querySelectorAll('.error-message').forEach((msg) => {
        msg.classList.add('hidden');
      });
      section
        .querySelectorAll('input, select, textarea, .upload-box')
        .forEach((el) => clearInvalid(el));
    }

    function showErrorFor(step, key, element) {
      const section = document.getElementById(`step-${step}-content`);
      if (!section) return;

      const msg = section.querySelector(`[data-error="${key}"]`);
      if (msg) msg.classList.remove('hidden');
      if (element) markInvalid(element);
    }

    let currentStep = 1;
    const totalSteps = 2;

    function clampRanges(minInput, maxInput) {
      if (!minInput || !maxInput) return;
      if (parseInt(minInput.value) > parseInt(maxInput.value)) {
        const temp = minInput.value;
        minInput.value = maxInput.value;
        maxInput.value = temp;
      }
    }

    function updateUI() {
      document.querySelectorAll('.step-section').forEach((section, index) => {
        section.classList.toggle('hidden', index + 1 !== currentStep);
      });

      const progress = document.getElementById('progress-bar');
      if (progress) {
        progress.style.width = `${(currentStep / totalSteps) * 100}%`;
      }

      document.querySelectorAll('.step-btn').forEach((btn) => {
        const step = parseInt(btn.getAttribute('data-step'));
        const circle = btn.querySelector('span:first-child');
        const text = btn.querySelector('span:last-child');

        if (step < currentStep) {
          circle.className =
            'flex w-6 h-6 text-white text-xs bg-primary rounded-full border-2 border-primary items-center justify-center';
          circle.innerHTML =
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';
          text.className = 'hidden md:inline font-bold text-primary';
        } else if (step === currentStep) {
          circle.className =
            'flex w-6 h-6 text-white text-xs bg-primary rounded-full border-2 border-primary items-center justify-center';
          circle.innerText = step;
          text.className = 'hidden md:inline font-bold text-primary';
        } else {
          circle.className =
            'flex w-6 h-6 text-slate-400 text-xs bg-white rounded-full border-2 border-slate-200 items-center justify-center group-hover:border-slate-300';
          circle.innerText = step;
          text.className =
            'hidden md:inline font-medium text-slate-400 group-hover:text-slate-600';
        }
      });
    }

    function goToStep(step) {
      if (step === currentStep) return;
      if (step > currentStep && !validateStep1()) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
      }
      currentStep = step;
      updateUI();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function nextStep() {
      if (!validateStep1()) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
        return;
      }
      currentStep = Math.min(currentStep + 1, totalSteps);
      updateUI();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function prevStep() {
      currentStep = Math.max(currentStep - 1, 1);
      updateUI();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateStep1() {
      hideErrors(1);

      const logoInput = document.getElementById('company_logo_input');
      const logoBox = document.getElementById('company-logo-box');
      const logoError = document.getElementById('company_logo_error');
      if (logoError) logoError.classList.add('hidden');
      if (logoBox) clearInvalid(logoBox);

      let valid = true;
      if (!logoInput?.files?.length) {
        if (logoBox) {
          markInvalid(logoBox);
        }
        if (logoError) {
          logoError.classList.remove('hidden');
        }
        valid = false;
      }

      const fields = [
        { selector: 'input[name="company_name"]', key: 'company_name' },
        { selector: 'select[name="industry"]', key: 'industry' },
        { selector: 'input[name="email"]', key: 'email' },
        { selector: 'input[name="password"]', key: 'password' },
        { selector: 'input[name="password_confirmation"]', key: 'password_confirmation' },
        { selector: 'textarea[name="about"]', key: 'about' },
        { selector: 'select[name="location"]', key: 'location' },
      ];

      fields.forEach(({ selector, key }) => {
        const el = document.querySelector(selector);
        if (!el) return;
        if (!el.value) {
          showErrorFor(1, key, el);
          valid = false;
        }
      });

      const password = document.querySelector('input[name="password"]');
      const confirm = document.querySelector('input[name="password_confirmation"]');
      const confirmError = document.querySelector('[data-error="password_confirmation"]');
      if (password && confirm) {
        if (password.value && confirm.value && password.value !== confirm.value) {
          if (confirmError) {
            confirmError.textContent = 'Passwords do not match';
            confirmError.classList.remove('hidden');
          }
          markInvalid(password);
          markInvalid(confirm);
          valid = false;
        }
      }

      return valid;
    }

    function validateStep2() {
      hideErrors(2);

      const requiredSelectors = [
        'input[name="campaign_title"]',
        'select[name="age_range"]',
        'select[name="gender"]',
        'select[name="audience_location"]',
        'select[name="niche"]',
      ];

      let valid = true;
      requiredSelectors.forEach((selector) => {
        const el = document.querySelector(selector);
        if (!el) return;
        if (!el.value) {
          const key =
            el.getAttribute('name') === 'audience_location'
              ? 'audience_location'
              : el.getAttribute('name');
          showErrorFor(2, key, el);
          valid = false;
        }
      });

      const fixedRadio = document.querySelector('input[name="budget_type"][value="fixed"]');
      const rangeRadio = document.querySelector('input[name="budget_type"][value="range"]');
      const fixedInput = document.getElementById('budget_fixed');
      const budgetMin = document.getElementById('budget_min');
      const budgetMax = document.getElementById('budget_max');

      if (fixedRadio?.checked && fixedInput) {
        if (!fixedInput.value) {
          showErrorFor(2, 'budget_fixed', fixedInput);
          valid = false;
        }
      }

      if (rangeRadio?.checked) {
        if (!budgetMin?.value) {
          showErrorFor(2, 'budget_min', budgetMin);
          valid = false;
        }
        if (!budgetMax?.value) {
          showErrorFor(2, 'budget_max', budgetMax);
          valid = false;
        }
        if (budgetMin?.value && budgetMax?.value && parseInt(budgetMin.value) > parseInt(budgetMax.value)) {
          showErrorFor(2, 'budget_min', budgetMin);
          showErrorFor(2, 'budget_max', budgetMax);
          valid = false;
        }
      }

      return valid;
    }

    function addSocialLink() {
      const container = document.getElementById('social-links-container');
      const input = document.createElement('input');
      input.type = 'text';
      input.name = 'social_links[]';
      input.placeholder = 'Social media link';
      input.className = 'form-input';
      container.appendChild(input);
    }

    function setupUploadBox(boxId) {
      const box = document.getElementById(boxId);
      if (!box) return;

      const input = box.querySelector('.upload-input');
      const placeholder = box.querySelector('.upload-placeholder');
      const preview = box.querySelector('.upload-preview');

      box.addEventListener('click', () => input && input.click());

      if (input) {
        input.addEventListener('change', (e) => {
          const file = e.target.files?.[0];
          if (!file || !preview) return;

          const url = URL.createObjectURL(file);
          preview.src = url;
          preview.classList.remove('hidden');
          if (placeholder) placeholder.classList.add('hidden');
        });
      }
    }

    function previewImage(event, imgId, boxId) {
      const file = event.target.files[0];
      if (!file) return;

      const img = document.getElementById(imgId);
      const box = document.getElementById(boxId);

      img.src = URL.createObjectURL(file);

      img.classList.remove('hidden');

      const placeholder = box.querySelector('.placeholder');
      placeholder.classList.add('hidden');
    }

    function setBudgetType(type) {
      const fixedWrapper = document.getElementById('budget-fixed-wrapper');
      const rangeWrapper = document.getElementById('budget-range-wrapper');

      if (type === 'fixed') {
        fixedWrapper.classList.remove('hidden');
        rangeWrapper.classList.add('hidden');
      } else {
        fixedWrapper.classList.add('hidden');
        rangeWrapper.classList.remove('hidden');
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      const minSlider = document.getElementById('budget_min');
      const maxSlider = document.getElementById('budget_max');
      const minLabel = document.getElementById('budget-min-label');
      const maxLabel = document.getElementById('budget-max-label');

      if (!minSlider || !maxSlider || !minLabel || !maxLabel) return;

      const updateBudgetLabels = () => {
        clampRanges(minSlider, maxSlider);
        minLabel.textContent = `$${minSlider.value}`;
        maxLabel.textContent = `$${maxSlider.value}`;
      };

      minSlider.addEventListener('input', updateBudgetLabels);
      maxSlider.addEventListener('input', updateBudgetLabels);
      updateBudgetLabels();
    });

    function disablePlaceholder(selectEl) {
      const firstOption = selectEl.querySelector('option.placeholder-option');
      if (firstOption) {
        firstOption.disabled = true;
      }
      selectEl.classList.remove('invalid');
    }

    document.addEventListener('DOMContentLoaded', () => {
      updateUI();

      setupUploadBox('company-logo-box');
      setupUploadBox('company-cover-box');

      const form = document.getElementById('business-form');
      if (form) {
        form.addEventListener('submit', (e) => {
          if (!validateStep2()) {
            e.preventDefault();
            goToStep(2);
            window.scrollTo({ top: 0, behavior: 'smooth' });
          }
        });
      }
    });
  </script>
@endsection

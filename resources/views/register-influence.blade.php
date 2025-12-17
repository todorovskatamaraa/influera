@extends("layouts.register-layout")

@section("title", "Influentia - Apply as Influencer")

@section("content")
  <div class="w-full max-w-5xl mx-auto">
    <div class="mb-10">
      <h1 class="mb-2 text-3xl font-bold text-slate-900">
        Apply to Join Influentia
      </h1>
      <p class="text-slate-600 text-sm">
        Complete your profile to start collaborating with top brands
      </p>
    </div>

    {{-- Progress Stepper --}}
    <div class="mb-12 relative">
      <div class="w-full h-[2px] bg-slate-200 absolute bottom-0 left-0"></div>
      <div
        id="progress-bar"
        class="h-[2px] bg-primary transition-all absolute bottom-0 left-0 duration-300"
        style="width: 16.66%"
      ></div>

      {{-- Steps --}}
      <div class="flex z-10 pb-4 justify-between relative">
        <button
          type="button"
          onclick="goToStep(1)"
          class="flex text-sm font-bold text-primary transition-colors cursor-pointer step-btn group items-center gap-2"
          data-step="1"
        >
          <span
            class="flex w-6 h-6 text-white text-xs bg-primary rounded-full border-2 border-primary items-center justify-center"
          >
            1
          </span>
          <span class="hidden md:inline">Basic Info</span>
        </button>

        <button
          type="button"
          onclick="goToStep(2)"
          class="flex text-sm font-medium text-slate-400 transition-colors cursor-pointer step-btn group items-center gap-2 hover:text-slate-600"
          data-step="2"
        >
          <span
            class="flex w-6 h-6 text-slate-400 text-xs bg-white rounded-full border-2 border-slate-200 items-center justify-center group-hover:border-slate-300"
          >
            2
          </span>
          <span class="hidden md:inline">Social Media</span>
        </button>

        <button
          type="button"
          onclick="goToStep(3)"
          class="flex text-sm font-medium text-slate-400 transition-colors cursor-pointer step-btn group items-center gap-2 hover:text-slate-600"
          data-step="3"
        >
          <span
            class="flex w-6 h-6 text-slate-400 text-xs bg-white rounded-full border-2 border-slate-200 items-center justify-center group-hover:border-slate-300"
          >
            3
          </span>
          <span class="hidden md:inline">Content Info</span>
        </button>

        <button
          type="button"
          onclick="goToStep(4)"
          class="flex text-sm font-medium text-slate-400 transition-colors cursor-pointer step-btn group items-center gap-2 hover:text-slate-600"
          data-step="4"
        >
          <span
            class="flex w-6 h-6 text-slate-400 text-xs bg-white rounded-full border-2 border-slate-200 items-center justify-center group-hover:border-slate-300"
          >
            4
          </span>
          <span class="hidden md:inline">Collaboration</span>
        </button>

        <button
          type="button"
          onclick="goToStep(5)"
          class="flex text-sm font-medium text-slate-400 transition-colors cursor-pointer step-btn group items-center gap-2 hover:text-slate-600"
          data-step="5"
        >
          <span
            class="flex w-6 h-6 text-slate-400 text-xs bg-white rounded-full border-2 border-slate-200 items-center justify-center group-hover:border-slate-300"
          >
            5
          </span>
          <span class="hidden md:inline">Legal Info</span>
        </button>

        <button
          type="button"
          onclick="goToStep(6)"
          class="flex text-sm font-medium text-slate-400 transition-colors cursor-pointer step-btn group items-center gap-2 hover:text-slate-600"
          data-step="6"
        >
          <span
            class="flex w-6 h-6 text-slate-400 text-xs bg-white rounded-full border-2 border-slate-200 items-center justify-center group-hover:border-slate-300"
          >
            6
          </span>
          <span class="hidden md:inline">Metrics</span>
        </button>
      </div>
    </div>

    <form
      id="influencer-form"
      method="POST"
      action="{{ route("influencer-register-store") }}"
      enctype="multipart/form-data"
    >
      @csrf
      @if ($errors->any())
        <div
          class="mb-6 p-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg"
        >
          <ul class="pl-5 space-y-1 list-disc">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      {{-- STEP 1: BASIC INFO --}}
      <section id="step-1" class="space-y-8 step-section">
        <div>
          <h2 class="text-lg font-bold text-slate-900">
            Let's start with the basics
          </h2>
          <p class="text-slate-500 text-sm">
            Tell us a bit about yourself to get started
          </p>
        </div>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
          {{-- Profile Picture --}}
          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Profile Picture*
            </label>
            <div
              id="profile-picture-upload"
              class="flex overflow-hidden h-48 text-slate-400 bg-white border-2 border-dashed border-slate-200 rounded-xl transition-all cursor-pointer upload-box items-center justify-center hover:border-primary hover:text-primary hover:bg-primary/5"
            >
              <input
                type="file"
                accept="image/*"
                class="hidden upload-input"
                name="profile_picture"
              />
              <div
                class="flex flex-col upload-placeholder items-center justify-center"
              >
                <svg
                  class="w-8 h-8 mb-3 text-primary"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                  />
                </svg>
                <span class="text-sm font-medium text-slate-600">
                  Upload your profile picture
                </span>
              </div>
              <img
                class="hidden object-cover w-full h-full rounded-xl upload-preview"
                alt="Profile preview"
              />
            </div>
          </div>

          {{-- Profile Cover --}}
          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Profile Cover
            </label>
            <div
              id="profile-cover-upload"
              class="flex overflow-hidden h-48 text-slate-400 bg-white border-2 border-dashed border-slate-200 rounded-xl transition-all cursor-pointer upload-box items-center justify-center hover:border-primary hover:text-primary hover:bg-primary/5"
            >
              <input
                type="file"
                accept="image/*"
                class="hidden upload-input"
                name="profile_cover"
              />
              <div
                class="flex flex-col upload-placeholder items-center justify-center"
              >
                <svg
                  class="w-8 h-8 mb-3 text-primary"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"
                  />
                </svg>
                <span class="text-sm font-medium text-slate-600">
                  Upload your profile cover
                </span>
              </div>
              <img
                class="hidden object-cover w-full h-full rounded-xl upload-preview"
                alt="Cover preview"
              />
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Full Name*
            </label>
            <input
              type="text"
              placeholder="Enter your full name"
              class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
              name="full_name"
            />
          </div>

          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Email Address*
            </label>
            <input
              type="email"
              placeholder="youremail@example.com"
              class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
              name="email"
            />
          </div>

          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Password*
            </label>
            <input
              type="password"
              minlength="8"
              placeholder="Minimum 8 characters"
              class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
              name="password"
            />
          </div>

          {{-- REPEAT PASSWORD --}}
          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Repeat Password*
            </label>
            <input
              type="password"
              minlength="8"
              placeholder="Re-enter your password"
              class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
              name="password_confirmation"
            />
            <p id="password-error" class="hidden mt-1 text-xs text-red-500">
              Passwords do not match.
            </p>
          </div>

          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Phone Number
            </label>
            <input
              type="tel"
              placeholder="+389 76 570 307"
              class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
              name="phone"
            />
          </div>

          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Location*
            </label>
            <select
              class="w-full px-4 py-3 text-sm text-slate-400 bg-white rounded-lg border border-slate-200 select-field transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
              name="location"
            >
              <option value="" disabled selected class="text-slate-400">
                Enter your location
              </option>
              <option value="us" class="text-slate-700">United States</option>
              <option value="uk" class="text-slate-700">United Kingdom</option>
              <option value="mk" class="text-slate-700">Macedonia</option>
            </select>
          </div>
        </div>

        <div
          class="flex p-4 bg-[#f3e8ff] border border-[#e9d5ff] rounded-xl gap-3 items-start"
        >
          <svg
            class="w-5 h-5 mt-0.5 text-primary shrink-0"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"
            />
          </svg>
          <p class="text-xs text-slate-700 leading-relaxed">
            <span class="font-bold">Privacy Note:</span>
            Your personal information is secure and will only be used to
            facilitate brand collaborations and payments.
          </p>
        </div>
      </section>

      {{-- STEP 2: SOCIAL MEDIA --}}
      <section id="step-2" class="hidden space-y-8 step-section">
        <div>
          <h2 class="text-lg font-bold text-slate-900">
            Connect Your Social Media
          </h2>
          <p class="text-slate-500 text-sm">
            Tell us about your social media presence
          </p>
        </div>

        <div class="space-y-6">
          <div id="social-platforms-list" class="space-y-6">
            {{-- Row 1 --}}
            <div
              class="grid grid-cols-1 gap-6 social-platform-row md:grid-cols-2"
            >
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">
                  Social Platform*
                </label>
                <select
                  id="primary-social-platform-1"
                  class="select-placeholder form-input"
                  name="social_platforms[]"
                >
                  <option value="" disabled selected>Select platform</option>
                  <option value="instagram">Instagram</option>
                  <option value="tiktok">TikTok</option>
                  <option value="youtube">YouTube</option>
                </select>
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">
                  Username*
                </label>
                <input
                  id="primary-social-username-1"
                  type="text"
                  class="form-input"
                  placeholder="@username"
                  name="social_usernames[]"
                />
              </div>
            </div>

            {{-- Row 2 --}}
            <div
              class="grid grid-cols-1 gap-6 social-platform-row md:grid-cols-2"
            >
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">
                  Social Platform*
                </label>
                <select
                  id="primary-social-platform-2"
                  class="select-placeholder form-input"
                  name="social_platforms[]"
                >
                  <option value="" disabled selected>Select platform</option>
                  <option value="instagram">Instagram</option>
                  <option value="tiktok">TikTok</option>
                  <option value="youtube">YouTube</option>
                </select>
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">
                  Username*
                </label>
                <input
                  id="primary-social-username-2"
                  type="text"
                  class="form-input"
                  placeholder="@username"
                  name="social_usernames[]"
                />
              </div>
            </div>
          </div>

          {{-- Add more social row --}}
          <div class="grid grid-cols-1 gap-6 items-end md:grid-cols-2">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Social Platform
              </label>
              <select
                id="add-social-platform"
                class="select-placeholder form-input"
                name="social_platforms[]"
              >
                <option value="" disabled selected>Select platform</option>
                <option value="instagram">Instagram</option>
                <option value="tiktok">TikTok</option>
                <option value="youtube">YouTube</option>
              </select>
            </div>

            <div class="flex gap-4 items-end">
              <div class="flex-1">
                <label class="block mb-2 text-sm font-medium text-slate-700">
                  Username
                </label>
                <input
                  id="add-social-username"
                  type="text"
                  class="form-input"
                  placeholder="@username"
                  name="social_usernames[]"
                />
              </div>

              <button
                id="add-social-btn"
                type="button"
                class="flex w-[46px] h-[46px] text-slate-900 bg-[#d8b4fe] rounded-lg transition-colors cursor-pointer items-center justify-center hover:bg-primary hover:text-white"
              >
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="8" x2="12" y2="16"></line>
                  <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
              </button>
            </div>
          </div>

          {{-- Stats --}}
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Followers
              </label>
              <input
                type="text"
                class="form-input"
                placeholder="10,000"
                name="followers"
              />
            </div>
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Engagement Rate
              </label>
              <input
                type="text"
                class="form-input"
                placeholder="5.2%"
                name="engagement_rate"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Average Reach
              </label>
              <input
                type="text"
                class="form-input"
                placeholder="8,500"
                name="avg_reach"
              />
            </div>
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Posting Frequency
              </label>
              <select
                class="select-placeholder form-input"
                name="posting_frequency"
              >
                <option value="" disabled selected>Select frequency</option>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
              </select>
            </div>
          </div>

          {{-- Demographics --}}
          <div>
            <h3 class="mb-4 text-sm font-bold text-slate-900">
              Audience Demographics
            </h3>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">
                  Age Range*
                </label>
                <select
                  class="select-placeholder form-input"
                  name="audience_age_range"
                >
                  <option value="" disabled selected>Select age range</option>
                  <option value="18-24">18-24</option>
                  <option value="25-34">25-34</option>
                  <option value="35-44">35-44</option>
                  <option value="45+">45+</option>
                </select>
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">
                  Gender*
                </label>
                <select
                  class="select-placeholder form-input"
                  name="audience_gender"
                >
                  <option value="" disabled selected>Select gender</option>
                  <option value="female">Female</option>
                  <option value="male">Male</option>
                  <option value="all-genders">All Genders</option>
                </select>
              </div>
              <div>
                <label class="block mb-2 text-sm font-medium text-slate-700">
                  Location*
                </label>
                <input
                  type="text"
                  class="form-input"
                  placeholder="Enter location"
                  name="audience_location"
                />
              </div>
            </div>
          </div>
        </div>
      </section>

      {{-- STEP 3: CONTENT INFO --}}
      <section id="step-3" class="space-y-8 step-section">
        <div>
          <h2 class="text-lg font-bold text-slate-900">Content Information</h2>
          <p class="text-slate-500 text-sm">
            Tell us about your content style and experience
          </p>
        </div>

        <div class="space-y-6">
          {{-- Niches --}}
          <div>
            <label class="block mb-3 text-sm font-medium text-slate-700">
              Niches Categories*
            </label>

            <div id="niche-tags" class="flex flex-wrap mb-4 gap-2">
              @foreach ([
                  "Fashion",
                  "Beauty",
                  "Fitness",
                  "Food",
                  "Travel",
                  "Technology",
                  "Lifestyle",
                  "Gaming",
                  "Education",
                  "Finance",
                  "Health",
                  "Parenting"
                ]
                as $niche
              )
                <button
                  type="button"
                  class="inline-flex px-4 py-2 text-slate-600 text-sm bg-slate-100 rounded-lg transition-colors items-center hover:bg-[#f3e8ff] hover:text-primary"
                  data-toggle="pill"
                  data-group="niches"
                  data-value="{{ $niche }}"
                >
                  {{ $niche }}
                </button>
              @endforeach
            </div>

            <div class="flex gap-4">
              <input
                id="custom-niche-input"
                type="text"
                placeholder="Add custom niche"
                class="flex-1 px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="custom_niche"
              />
              <button
                type="button"
                id="add-custom-niche"
                class="flex w-[46px] h-[46px] text-slate-900 bg-[#d8b4fe] rounded-lg transition-colors items-center justify-center hover:bg-primary hover:text-white"
                title="Add niche"
              >
                <svg
                  width="20"
                  height="20"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <circle cx="12" cy="12" r="10"></circle>
                  <line x1="12" y1="8" x2="12" y2="16"></line>
                  <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
              </button>
            </div>
          </div>

          {{-- Content Types --}}
          <div>
            <label class="block mb-3 text-sm font-medium text-slate-700">
              Content Types*
            </label>
            <div id="content-type-tags" class="flex flex-wrap gap-2">
              @foreach ([
                  "Photo Posts",
                  "Video Content",
                  "Reels/Shorts",
                  "Blog Posts",
                  "Tutorials",
                  "Reviews",
                  "Livestreams",
                  "Gaming"
                ]
                as $type
              )
                <button
                  type="button"
                  class="inline-flex px-4 py-2 text-slate-600 text-sm bg-slate-100 rounded-lg transition-colors items-center hover:bg-[#f3e8ff] hover:text-primary"
                  data-toggle="pill"
                  data-group="content-types"
                  data-value="{{ $type }}"
                >
                  {{ $type }}
                </button>
              @endforeach
            </div>
          </div>

          {{-- Previous Collaborations --}}
          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Previous Collaborations*
            </label>
            <div class="flex gap-4">
              <input
                type="text"
                placeholder="Brand name or collaboration details"
                class="flex-1 px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="collaborations[]"
              />
            </div>
          </div>

          {{-- Portfolio --}}
          <div>
            <label class="block mb-2 text-sm font-medium text-slate-700">
              Portfolio / Media Kit Link
            </label>
            <input
              type="url"
              placeholder="https://your-portfolio.com"
              class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
              name="portfolio_url"
            />
          </div>
        </div>
      </section>

      {{-- STEP 4: COLLABORATION --}}
      <section id="step-4" class="hidden space-y-8 step-section">
        <div>
          <h2 class="text-lg font-bold text-slate-900">
            Collaboration Preferences
          </h2>
          <p class="text-slate-500 text-sm">
            Let brands know what you're looking for
          </p>
        </div>

        <div class="space-y-6">
          {{-- Types --}}
          <div>
            <label class="block mb-3 text-sm font-medium text-slate-700">
              Preferred Collaboration Types*
            </label>
            <div id="collab-type-chips" class="flex flex-wrap gap-2">
              @foreach ([
                  "Sponsored Posts",
                  "Product Reviews",
                  "Giveaways",
                  "Brand Ambassadorship",
                  "Event Coverage",
                  "Affiliate Marketing",
                  "Content Creation",
                  "Takeovers"
                ]
                as $type
              )
                <button
                  type="button"
                  data-chip
                  class="px-4 py-2 text-slate-600 text-sm bg-slate-100 rounded-lg transition-colors chip hover:bg-[#f3e8ff] hover:text-primary"
                  data-toggle="pill"
                  data-group="collab-types"
                >
                  {{ $type }}
                </button>
              @endforeach
            </div>
          </div>

          {{-- Pricing --}}
          <div class="grid grid-cols-1 gap-6 items-end md:grid-cols-2">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Content Type for Pricing
              </label>
              <select
                class="w-full px-4 py-3 text-sm text-slate-400 bg-white rounded-lg border border-slate-200 select-field transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="pricing_type"
              >
                <option value="" disabled selected class="text-slate-400">
                  Select Content Type
                </option>
                <option value="post" class="text-slate-700">
                  Instagram Post
                </option>
                <option value="reel" class="text-slate-700">
                  Instagram Reel
                </option>
                <option value="story" class="text-slate-700">
                  Instagram Story
                </option>
              </select>
            </div>

            <div class="flex gap-4">
              <div class="flex-1">
                <label class="block mb-2 text-sm font-medium text-slate-700">
                  Price per Content ($)
                </label>
                <input
                  type="number"
                  placeholder="500"
                  class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                  name="price"
                />
              </div>
            </div>
          </div>

          {{-- Availability --}}
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Availability*
              </label>
              <select
                class="w-full px-4 py-3 text-sm text-slate-400 bg-white rounded-lg border border-slate-200 select-field transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="availability"
              >
                <option value="" disabled selected class="text-slate-400">
                  Select availability
                </option>
                <option value="full-time" class="text-slate-700">
                  Full-time
                </option>
                <option value="part-time" class="text-slate-700">
                  Part-time
                </option>
                <option value="project-based" class="text-slate-700">
                  Project-based
                </option>
              </select>
            </div>

            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Content Restriction
              </label>
              <input
                type="text"
                placeholder="No alcohol, gambling, etc."
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="content_restrictions"
              />
            </div>
          </div>

          <div class="p-4 bg-[#e0f2fe] border border-[#bae6fd] rounded-xl">
            <p class="text-xs text-slate-700 font-medium">
              <span class="font-bold text-cyan-600">Tip:</span>
              Being clear about your rates and availability helps brands find
              the right match faster.
            </p>
          </div>
        </div>
      </section>

      {{-- STEP 5: LEGAL INFO --}}
      <section id="step-5" class="hidden space-y-8 step-section">
        <div>
          <h2 class="text-lg font-bold text-slate-900">
            Legal & Administrative
          </h2>
          <p class="text-slate-500 text-sm">
            Complete the necessary legal and payment information
          </p>
        </div>

        <div class="space-y-6">
          {{-- Contract Agreement --}}
          <div>
            <label class="block mb-3 text-sm font-medium text-slate-700">
              Contract Agreement*
            </label>
            <p class="mb-4 text-xs text-slate-500 leading-relaxed">
              By proceeding, you agree to Influentia's terms of service, privacy
              policy, and creator agreement. This includes guidelines for brand
              collaborations, content requirements, and payment terms.
              <button
                type="button"
                id="open-terms"
                class="text-primary font-semibold underline hover:text-primary/80"
              >
                Check here the terms.
              </button>
            </p>

            <div class="space-y-3" id="agreement-group">
              <label class="flex cursor-pointer items-center gap-3 group">
                <div
                  class="flex w-5 h-5 rounded-full border-2 border-slate-300 radio-visual group-hover:border-primary items-center justify-center"
                >
                  <div
                    class="hidden w-2.5 h-2.5 bg-primary rounded-full radio-dot"
                  ></div>
                </div>
                <input
                  type="radio"
                  name="agreement"
                  value="yes"
                  class="sr-only"
                />
                <span class="text-sm text-slate-700">
                  Yes, I agree to all terms and conditions
                </span>
              </label>

              <label class="flex cursor-pointer items-center gap-3 group">
                <div
                  class="flex w-5 h-5 rounded-full border-2 border-slate-300 radio-visual group-hover:border-primary items-center justify-center"
                >
                  <div
                    class="hidden w-2.5 h-2.5 bg-primary rounded-full radio-dot"
                  ></div>
                </div>
                <input
                  type="radio"
                  name="agreement"
                  value="no"
                  class="sr-only"
                />
                <span class="text-sm text-slate-700">No</span>
              </label>
            </div>
          </div>

          {{-- Payment --}}
          <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Preferred Payment Method*
              </label>
              <select
                class="w-full px-4 py-3 text-sm text-slate-400 bg-white rounded-lg border border-slate-200 select-field transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="payment_method"
              >
                <option value="" disabled selected class="text-slate-400">
                  Select payment method
                </option>
                <option value="bank" class="text-slate-700">
                  Bank Transfer
                </option>
                <option value="paypal" class="text-slate-700">PayPal</option>
                <option value="stripe" class="text-slate-700">Stripe</option>
              </select>
            </div>

            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Tax Information
              </label>
              <input
                type="text"
                placeholder="SSN, EIN, or Tax ID"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="tax_id"
              />
            </div>
          </div>

          <div
            class="flex p-4 bg-[#fef2f2] border border-[#fecaca] rounded-xl gap-3 items-start"
          >
            <svg
              class="w-5 h-5 mt-0.5 text-red-500 shrink-0"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"
              />
            </svg>
            <p class="text-xs text-slate-700 leading-relaxed">
              <span class="font-bold text-red-600">Important:</span>
              Tax information is required for payments over $600 annually. All
              information is encrypted and stored securely.
            </p>
          </div>
        </div>
      </section>

      {{-- STEP 6: METRICS --}}
      <section id="step-6" class="hidden space-y-8 step-section">
        <div>
          <h2 class="text-lg font-bold text-slate-900">Performance Metrics</h2>
          <p class="text-slate-500 text-sm">
            These metrics are automatically calculated based on your social
            media data
          </p>
        </div>

        <div class="p-4 mb-6 bg-[#e0f2fe] border border-[#bae6fd] rounded-xl">
          <p class="text-xs text-slate-700 font-medium">
            <span class="font-bold text-cyan-600">Optional Step:</span>
            These metrics are automatically populated from your connected social
            accounts. You can review and adjust them if needed.
          </p>
        </div>

        <div class="space-y-6">
          <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Engagement Rate (%)
              </label>
              <input
                type="text"
                placeholder="5.2"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="metric_engagement_rate"
              />
            </div>

            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Average Reach
              </label>
              <input
                type="text"
                placeholder="25,000"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="metric_avg_reach"
              />
            </div>

            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Average Impressions
              </label>
              <input
                type="text"
                placeholder="45,000"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="metric_impressions"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Conversion Rate (%)
              </label>
              <input
                type="text"
                placeholder="1.5"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="metric_conversion_rate"
              />
            </div>

            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Cost per Engagement
              </label>
              <input
                type="text"
                placeholder="$0.12"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="metric_cpe"
              />
            </div>

            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Cost per click
              </label>
              <input
                type="text"
                placeholder="$0.45"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="metric_cpc"
              />
            </div>
          </div>

          <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Video Completion Rate (%)
              </label>
              <input
                type="text"
                placeholder="78"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="metric_video_completion"
              />
            </div>

            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Sentiment Analysis Score
              </label>
              <input
                type="text"
                placeholder="92"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="metric_sentiment"
              />
            </div>

            <div>
              <label class="block mb-2 text-sm font-medium text-slate-700">
                Discount Code Usage(%)
              </label>
              <input
                type="text"
                placeholder="15"
                class="w-full px-4 py-3 text-sm rounded-lg border border-slate-200 transition-all focus:outline-none focus:ring-2 focus:ring-primary/20 focus:border-primary"
                name="metric_discount_usage"
              />
            </div>
          </div>

          <div
            class="flex p-4 bg-[#f0fdf4] border border-[#bbf7d0] rounded-xl gap-2 items-start"
          >
            <svg
              class="w-4 h-4 mt-0.5 text-green-600 shrink-0"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"
              />
            </svg>
            <p class="text-xs text-slate-700 font-medium">
              <span class="font-bold text-green-700">Great Job</span>
              Your metrics look strong. Brands will be impressed by your
              engagement rates and reach.
            </p>
          </div>
        </div>
      </section>

      <input type="hidden" name="selected_data" id="selected-data" />
    </form>

    {{-- NAV BUTTONS --}}
    <div
      class="flex mt-16 pt-6 border-t border-slate-100 justify-between items-center"
    >
      <div class="flex items-center gap-4">
        <button
          type="button"
          id="cancel-btn"
          onclick="window.location.href='{{ route("register") }}'"
          class="px-6 py-2.5 text-slate-700 font-medium text-sm rounded-lg border border-slate-300 transition-colors cursor-pointer hover:bg-slate-50"
        >
          Cancel
        </button>
        <div class="text-xs text-slate-500 font-medium" id="step-counter">
          Step 1 of 6
        </div>
      </div>

      <div class="flex gap-4">
        <button
          type="button"
          id="back-btn"
          onclick="prevStep()"
          class="hidden px-6 py-2.5 text-slate-700 font-bold text-sm rounded-lg border border-slate-300 transition-colors cursor-pointer hover:bg-slate-50"
        >
          Back
        </button>
        <button
          type="button"
          id="next-btn"
          onclick="nextStep()"
          class="px-6 py-2.5 text-white font-bold text-sm bg-primary rounded-lg transition-colors shadow-lg shadow-primary/20 cursor-pointer hover:bg-primary/90"
        >
          Next
        </button>
      </div>
    </div>
  </div>

  {{-- Terms of Use Modal --}}
  <div
    id="terms-modal"
    class="z-50 hidden flex bg-black/40 fixed inset-0 items-center justify-center backdrop-blur-sm"
  >
    <div
      class="max-w-3xl w-full mx-4 bg-white rounded-2xl shadow-2xl relative md:mx-0"
    >
      <div
        class="flex px-6 py-4 border-b border-slate-100 items-center justify-between"
      >
        <h3 class="text-sm font-semibold text-slate-900">
          Terms of Use (Detailed Version)
        </h3>
        <button
          type="button"
          class="p-1 rounded-full hover:bg-slate-100"
          data-close-terms
        >
          <svg
            width="18"
            height="18"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
          >
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
        </button>
      </div>

      <div
        class="overflow-y-auto max-h-[70vh] px-6 py-5 space-y-4 text-sm text-slate-700 leading-relaxed"
      >
        <p>
          <span class="font-semibold">1. Acceptance of Terms</span>
          <br />
          By registering and using the Influentia platform, users (companies and
          influencers) agree to abide by these Terms of Use, Privacy Policy, and
          all applicable laws and regulations.
        </p>
        <p>
          <span class="font-semibold">2. Platform Usage</span>
          <br />
          All communication, contracts, transactions, deliverables, and payments
          between users must occur strictly through the Influentia platform.
          Bypassing the platform (e.g., sharing personal contact details or
          arranging external deals) is prohibited and may lead to account
          termination.
        </p>
        <p>
          <span class="font-semibold">3. Escrow System and Payments</span>
          <br />
          All payments are processed securely via our escrow system. Funds are
          held until the company confirms delivery and satisfaction with the
          campaign. Influencers receive payment only after the campaign is
          marked complete. Influentia retains a 15% commission from all
          successful transactions.
        </p>
      </div>

      {{-- Footer --}}
      <div class="flex px-6 py-4 border-t border-slate-100 justify-end gap-3">
        <button
          type="button"
          class="px-4 py-2 text-sm font-medium text-slate-600 rounded-lg hover:bg-slate-100"
          data-close-terms
        >
          Close
        </button>
        <button
          type="button"
          id="accept-terms"
          class="px-4 py-2 text-sm font-semibold text-white bg-primary rounded-lg hover:bg-primary/90"
        >
          I understand
        </button>
      </div>
    </div>
  </div>

  {{-- SCRIPTS --}}
  <script>
    let currentStep = 1;
    const totalSteps = 6;

    function clearStepErrors(step) {
      const section = document.getElementById(`step-${step}`);
      if (!section) return;

      section.querySelectorAll('.error-message').forEach((msg) => msg.remove());

      section.querySelectorAll('.has-error').forEach((el) => {
        el.classList.remove(
          'has-error',
          'ring-1',
          'ring-red-300',
          'border-red-300',
        );
      });
    }

    function addError(element, message) {
      if (!element) return;

      element.classList.add(
        'has-error',
        'ring-1',
        'ring-red-300',
        'border-red-300',
      );

      const error = document.createElement('p');
      error.className = 'mt-2 text-xs text-red-600 error-message';
      error.innerText = message;

      element.insertAdjacentElement('afterend', error);
    }

    function getSelectedPillsSafe() {
      return typeof window.getSelectedPills === 'function'
        ? window.getSelectedPills()
        : { niches: [], content_types: [], collab_types: [] };
    }

    function validateStep(step) {
      const section = document.getElementById(`step-${step}`);
      if (!section) return true;

      clearStepErrors(step);
      let isValid = true;

      const requireValue = (selector, message) => {
        const el = section.querySelector(selector);
        if (!el) return;
        const value = (el.value || '').trim();

        if (!value) {
          addError(el, message);
          isValid = false;
        }
      };

      if (step === 1) {
        const profileInput = section.querySelector(
          'input[name="profile_picture"]',
        );

        if (!profileInput?.files?.length) {
          addError(
            profileInput?.closest('.upload-box') || profileInput,
            'Profile picture is required',
          );
          isValid = false;
        }

        requireValue('input[name="full_name"]', 'Full name is required');
        requireValue('input[name="email"]', 'Email is required');
        requireValue('input[name="password"]', 'Password is required');

        const password = section.querySelector('input[name="password"]');
        if (password && password.value && password.value.length < 8) {
          addError(password, 'Password must be at least 8 characters');
          isValid = false;
        }

        const repeatPassword = section.querySelector(
          'input[name="password_confirmation"]',
        );
        if (password && repeatPassword) {
          if (repeatPassword.value.trim() === '') {
            addError(repeatPassword, 'Please repeat your password');
            isValid = false;
          } else if (password.value !== repeatPassword.value) {
            addError(repeatPassword, 'Passwords do not match');
            isValid = false;
          }
        }

        requireValue('select[name="location"]', 'Select your location');
      }

      

      if (step === 2) {
        const pairs = Array.from(
          section.querySelectorAll(
            '#social-platforms-list .social-platform-row',
          ),
        ).slice(0, 2);

        pairs.forEach((row, index) => {
          const platform = row.querySelector(
            'select[name="social_platforms[]"]',
          );
          const username = row.querySelector(
            'input[name="social_usernames[]"]',
          );

          if (!platform?.value) {
            addError(
              platform,
              `Select a social platform for profile ${index + 1}`,
            );
            isValid = false;
          }

          if (!username?.value.trim()) {
            addError(username, `Username is required for profile ${index + 1}`);
            isValid = false;
          }
        });

        requireValue('select[name="audience_age_range"]', 'Select age range');
        requireValue('select[name="audience_gender"]', 'Select gender');
        requireValue(
          'input[name="audience_location"]',
          'Audience location is required',
        );
      }

      if (step === 3) {
        const pills = getSelectedPillsSafe();

        if (!pills.niches.length) {
          addError(
            section.querySelector('#niche-tags'),
            'Choose at least one niche',
          );
          isValid = false;
        }

        if (!pills.content_types.length) {
          addError(
            section.querySelector('#content-type-tags'),
            'Choose at least one content type',
          );
          isValid = false;
        }

        requireValue(
          'input[name="collaborations[]"]',
          'Add at least one collaboration',
        );
      }

      if (step === 4) {
        const pills = getSelectedPillsSafe();

        if (!pills.collab_types.length) {
          addError(
            section.querySelector('#collab-type-chips'),
            'Choose at least one collaboration type',
          );
          isValid = false;
        }

        requireValue('select[name="availability"]', 'Select availability');
      }

      if (step === 5) {
        const agreement = section.querySelector(
          'input[name="agreement"]:checked',
        );
        if (!agreement || agreement.value !== 'yes') {
          addError(
            section.querySelector('#agreement-group'),
            'You must accept the agreement to continue',
          );
          isValid = false;
        }

        requireValue(
          'select[name="payment_method"]',
          'Select a payment method',
        );
      }

      return isValid;
    }

    function updateUI() {
      // Step counter
      document.getElementById('step-counter').innerText =
        `Step ${currentStep} of ${totalSteps}`;

      // Sections
      document.querySelectorAll('.step-section').forEach((section, index) => {
        section.classList.toggle('hidden', index + 1 !== currentStep);
      });

      // Progress bar
      const progressPercentage = (currentStep / totalSteps) * 100;
      document.getElementById('progress-bar').style.width =
        `${progressPercentage}%`;

      // Step buttons
      document.querySelectorAll('.step-btn').forEach((btn) => {
        const step = parseInt(btn.getAttribute('data-step'));
        const circle = btn.querySelector('span:first-child');
        const text = btn.querySelector('span:last-child');

        if (step < currentStep) {
          // completed
          circle.className =
            'w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-xs border-2 border-primary';
          circle.innerHTML =
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';
          text.className = 'hidden md:inline font-bold text-primary';
        } else if (step === currentStep) {
          // active
          circle.className =
            'w-6 h-6 rounded-full bg-primary text-white flex items-center justify-center text-xs border-2 border-primary';
          circle.innerText = step;
          text.className = 'hidden md:inline font-bold text-primary';
        } else {
          // future
          circle.className =
            'w-6 h-6 rounded-full bg-white text-slate-400 flex items-center justify-center text-xs border-2 border-slate-200 group-hover:border-slate-300';
          circle.innerText = step;
          text.className =
            'hidden md:inline font-medium text-slate-400 group-hover:text-slate-600';
        }
      });

      // Buttons
      const backBtn = document.getElementById('back-btn');
      const nextBtn = document.getElementById('next-btn');
      const cancelBtn = document.getElementById('cancel-btn');

      backBtn.classList.toggle('hidden', currentStep === 1);
      cancelBtn.classList.toggle('hidden', currentStep !== 1);

      if (currentStep === totalSteps) {
        nextBtn.innerText = 'Complete Application';
      } else {
        nextBtn.innerText = 'Next';
      }
    }

    function nextStep() {
      if (!validateStep(currentStep)) return;

      if (currentStep < totalSteps) {
        currentStep++;
        updateUI();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      } else {
        const selected = window.getSelectedPills
          ? window.getSelectedPills()
          : { niches: [], content_types: [], collab_types: [] };

        const hidden = document.getElementById('selected-data');
        if (hidden) {
          hidden.value = JSON.stringify(selected);
        }

        document.getElementById('influencer-form').submit();
      }
    }

    function prevStep() {
      if (currentStep > 1) {
        currentStep--;
        updateUI();
        window.scrollTo({ top: 0, behavior: 'smooth' });
      }
    }

    function goToStep(step) {
      if (step === currentStep) return;
      if (step > currentStep && !validateStep(currentStep)) return;

      currentStep = step;
      updateUI();
      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function setupUploadBox(id) {
      const box = document.getElementById(id);
      if (!box) return;

      const input = box.querySelector('.upload-input');
      const placeholder = box.querySelector('.upload-placeholder');
      const preview = box.querySelector('.upload-preview');

      box.addEventListener('click', () => input.click());

      input.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;

        const url = URL.createObjectURL(file);
        preview.src = url;
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
      });
    }

    const socialList = document.getElementById('social-platforms-list');
    document.getElementById('add-social-btn').addEventListener('click', () => {
      const platformSelect = document.getElementById('add-social-platform');
      const usernameInput = document.getElementById('add-social-username');

      const platform = platformSelect.value;
      const username = usernameInput.value.trim();

      if (!platform || !username) return;

      const row = document.createElement('div');
      row.className =
        'grid grid-cols-1 md:grid-cols-2 gap-6 social-platform-row';

      row.innerHTML = `
            <div>
                <label
                  class="
                    block
                    mb-2
                    text-sm font-medium text-slate-700
                  "
                >
                    Social Platform
                </label>
                <select
                  class="
                    select-placeholder
                    form-input
                  "
                 name="social_platforms[]">
                    <option value="" disabled>Select platform</option>
                    <option value="instagram" ${
                      platform === 'instagram' ? 'selected' : ''
                    }>Instagram</option>
                    <option value="tiktok" ${
                      platform === 'tiktok' ? 'selected' : ''
                    }>TikTok</option>
                    <option value="youtube" ${
                      platform === 'youtube' ? 'selected' : ''
                    }>YouTube</option>
                </select>
            </div>
            <div>
                <label
                  class="
                    block
                    mb-2
                    text-sm font-medium text-slate-700
                  "
                >
                    Username
                </label>
                <input
                    type="text"
                      class="
                        form-input
                      "

                    value="${username}"
                    name="social_usernames[]"
                >
            </div>
        `;

      socialList.appendChild(row);
      platformSelect.value = '';
      usernameInput.value = '';
    });

    function setPillActive(pill, active) {
      if (active) {
        pill.classList.add(
          'is-active',
          'bg-[#f3e8ff]',
          'text-primary',
          'border',
          'border-primary/20',
        );
        pill.classList.remove('bg-slate-100', 'text-slate-600');
      } else {
        pill.classList.remove(
          'is-active',
          'bg-[#f3e8ff]',
          'text-primary',
          'border',
          'border-primary/20',
        );
        pill.classList.add('bg-slate-100', 'text-slate-600');
      }
    }

    function setupPill(pill) {
      if (!pill.classList.contains('is-active')) {
        setPillActive(pill, false);
      }

      pill.addEventListener('click', function () {
        const isActive = pill.classList.contains('is-active');
        setPillActive(pill, !isActive);
      });
    }

    function setupSelectedPillsCollector() {
      window.getSelectedPills = function () {
        const selected = {
          niches: [],
          content_types: [],
          collab_types: [],
        };

        document
          .querySelectorAll('[data-toggle="pill"].is-active')
          .forEach((pill) => {
            const group = pill.getAttribute('data-group');
            const text = pill.textContent.trim();

            if (group === 'niches') selected.niches.push(text);
            if (group === 'content-types') selected.content_types.push(text);
            if (group === 'collab-types') selected.collab_types.push(text);
          });

        return selected;
      };
    }

    function setupCustomNicheAdder() {
      const input = document.getElementById('custom-niche-input');
      const button = document.getElementById('add-custom-niche');
      const container = document.getElementById('niche-tags');

      if (!input || !button || !container) return;

      const addNiche = () => {
        const value = input.value.trim();
        if (!value) return;

        const exists = Array.from(
          container.querySelectorAll('[data-group="niches"]'),
        ).some(
          (pill) =>
            pill.textContent.trim().toLowerCase() === value.toLowerCase(),
        );

        if (exists) {
          input.value = '';
          return;
        }

        const pill = document.createElement('button');
        pill.type = 'button';
        pill.className =
          'inline-flex px-4 py-2 text-slate-600 text-sm bg-slate-100 rounded-lg transition-colors items-center hover:bg-[#f3e8ff] hover:text-primary';
        pill.setAttribute('data-toggle', 'pill');
        pill.setAttribute('data-group', 'niches');
        pill.setAttribute('data-value', value);
        pill.textContent = value;

        setupPill(pill);
        setPillActive(pill, true);

        container.appendChild(pill);
        input.value = '';
        input.focus();
      };

      button.addEventListener('click', addNiche);
      input.addEventListener('keyup', (e) => {
        if (e.key === 'Enter') addNiche();
      });
    }

    function setupSelectPlaceholders() {
      document.querySelectorAll('.select-field').forEach((select) => {
        const updateColor = () => {
          if (!select.value) {
            select.classList.add('text-slate-400');
            select.classList.remove('text-slate-700');
          } else {
            select.classList.remove('text-slate-400');
            select.classList.add('text-slate-700');
          }
        };

        updateColor();
        select.addEventListener('change', updateColor);
      });
    }

    function setupAgreementRadios() {
      const group = document.getElementById('agreement-group');
      if (!group) return;

      const labels = group.querySelectorAll('label');

      labels.forEach((label) => {
        label.addEventListener('click', () => {
          group.querySelectorAll('.radio-dot').forEach((dot) => {
            dot.classList.add('hidden');
          });

          const dot = label.querySelector('.radio-dot');
          if (dot) dot.classList.remove('hidden');

          const input = label.querySelector('input[type="radio"]');
          if (input) input.checked = true;
        });
      });
    }

    function setupTermsModal() {
      const openBtn = document.getElementById('open-terms');
      const modal = document.getElementById('terms-modal');
      if (!openBtn || !modal) return;

      const closeButtons = modal.querySelectorAll('[data-close-terms]');

      const open = () => modal.classList.remove('hidden');
      const close = () => modal.classList.add('hidden');

      openBtn.addEventListener('click', (e) => {
        e.preventDefault();
        open();
      });

      closeButtons.forEach((btn) => {
        btn.addEventListener('click', close);
      });

      modal.addEventListener('click', (e) => {
        if (e.target === modal) close();
      });

      const acceptBtn = document.getElementById('accept-terms');
      if (acceptBtn) {
        acceptBtn.addEventListener('click', () => {
          const yesRadio = document.querySelector(
            'input[name="agreement"][value="yes"]',
          );

          if (yesRadio) {
            const yesLabel = yesRadio.closest('label');
            if (yesLabel) {
              yesLabel.click();
            } else {
              yesRadio.checked = true;
            }
          }

          close();
        });
      }
    }

    document.addEventListener('DOMContentLoaded', () => {
      updateUI();
      setupUploadBox('profile-picture-upload');
      setupUploadBox('profile-cover-upload');
      setupSelectPlaceholders();
      setupAgreementRadios();
      setupTermsModal();

      document.querySelectorAll('[data-toggle="pill"]').forEach(setupPill);

      setupCustomNicheAdder();
      setupSelectedPillsCollector();
    });
  </script>
@endsection

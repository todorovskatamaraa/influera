@extends("layouts.loggedin-layout")

@section("title", "Influentia - Settings - Profile Settings")

@section("content")
  <div class="flex flex-col py-8 gap-16 lg:flex-row">
    {{-- Sidebar --}}
    @include("settings._sidebar", ["active" => "profile-settings"])

    {{-- Main Content --}}
    <div class="flex-1 space-y-6">
      {{-- My Profile Card --}}
      <div class="p-8 bg-white border border-slate-200 rounded-xl shadow-sm">
        <div class="flex mb-6 justify-between items-start">
          <h3 class="font-bold text-slate-900 text-lg">My Profile</h3>
          <a
            href="#"
            class="text-xs font-bold text-purple-400 transition-colors hover:text-purple-500"
          >
            View my profile as other see it
          </a>
        </div>

        <div class="space-y-6">
          {{-- Visibility --}}
          <div>
            <label class="block mb-2 text-xs font-bold text-slate-900">
              Visibility
            </label>
            <div class="relative">
              <select
                class="w-full px-4 py-2.5 text-sm text-slate-700 bg-white border border-slate-200 rounded-lg appearance-none focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
              >
                <option>Public</option>
                <option>Private</option>
              </select>
              <div
                class="text-slate-500 pointer-events-none absolute right-3 top-1/2 -translate-y-1/2"
              >
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
                  <path d="m6 9 6 6 6-6" />
                </svg>
              </div>
            </div>
          </div>

          {{-- Custom Profile URL --}}
          <div>
            <div class="flex mb-2 items-center gap-2">
              <label class="block text-xs font-bold text-slate-900">
                Custom Profile URL
              </label>
              <button
                class="text-slate-400 transition-colors hover:text-primary"
              >
                <svg
                  width="12"
                  height="12"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path
                    d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
                  ></path>
                </svg>
              </button>
            </div>
            <p class="text-sm text-slate-500">/influencer/johnd8</p>
          </div>

          {{-- Project Preference --}}
          <div>
            <label class="block mb-2 text-xs font-bold text-slate-900">
              Project Preference
            </label>
            <div class="relative">
              <select
                class="w-full px-4 py-2.5 text-sm text-slate-700 bg-white border border-slate-200 rounded-lg appearance-none focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
              >
                <option>Project Preference</option>
                <option>Long-term</option>
                <option>Short-term</option>
              </select>
              <div
                class="text-slate-500 pointer-events-none absolute right-3 top-1/2 -translate-y-1/2"
              >
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
                  <path d="m6 9 6 6 6-6" />
                </svg>
              </div>
            </div>
          </div>

          {{-- Earnings Privacy --}}
          <div>
            <label
              class="flex w-fit ml-0 pl-0 cursor-pointer items-start gap-3 custom-checkbox group"
            >
              <input type="checkbox" class="sr-only peer" />
              <div
                class="flex w-5 h-5 bg-white border border-slate-300 transition-colors rounded items-center justify-center group-hover:border-primary peer-checked:border-primary peer-checked:bg-primary"
              >
                <svg
                  class="hidden text-white peer-checked:block"
                  width="14"
                  height="14"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="3"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                >
                  <path d="M20 6 9 17l-5-5" />
                </svg>

                <p
                  class="text-sm text-slate-700 leading-none whitespace-nowrap"
                >
                  Hide my Earnings
                </p>
              </div>
            </label>
          </div>
        </div>
      </div>

      {{-- Experience Level Card --}}
      <div class="p-8 bg-white border border-slate-200 rounded-xl shadow-sm">
        <h3 class="mb-6 font-bold text-slate-900 text-lg">Experience Level</h3>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
          {{-- Entry Level --}}
          <label class="cursor-pointer group">
            <input type="radio" name="experience_level" class="sr-only peer" />
            <div
              class="h-32 p-4 border border-slate-200 rounded-xl transition-colors relative hover:border-primary peer-checked:border-primary peer-checked:bg-slate-50"
            >
              <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-slate-900">
                  Entry Level
                </span>
                <div
                  class="w-4 h-4 rounded-full border border-slate-300 transition-colors peer-checked:border-primary peer-checked:bg-primary"
                ></div>
              </div>
            </div>
          </label>

          {{-- Intermediate --}}
          <label class="cursor-pointer group">
            <input type="radio" name="experience_level" class="sr-only peer" />
            <div
              class="h-32 p-4 border border-slate-200 rounded-xl transition-colors relative hover:border-primary peer-checked:border-primary peer-checked:bg-slate-50"
            >
              <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-slate-900">
                  Intermediate
                </span>
                <div
                  class="w-4 h-4 rounded-full border border-slate-300 transition-colors peer-checked:border-primary peer-checked:bg-primary"
                ></div>
              </div>
            </div>
          </label>

          {{-- Expert --}}
          <label class="cursor-pointer group">
            <input type="radio" name="experience_level" class="sr-only peer" />
            <div
              class="h-32 p-4 border border-slate-200 rounded-xl transition-colors relative hover:border-primary peer-checked:border-primary peer-checked:bg-slate-50"
            >
              <div class="flex justify-between items-start">
                <span class="text-xs font-bold text-slate-900">Expert</span>
                <div
                  class="w-4 h-4 rounded-full border border-slate-300 transition-colors peer-checked:border-primary peer-checked:bg-primary"
                ></div>
              </div>
            </div>
          </label>
        </div>
      </div>

      {{-- Categories --}}
      <div class="p-8 bg-white border border-slate-200 rounded-xl shadow-sm">
        <div class="flex mb-6 justify-between items-start">
          <h3 class="font-bold text-slate-900 text-lg">Categories</h3>
          <button
            class="p-2 text-primary bg-slate-50 rounded-full transition-colors hover:text-primary/80"
          >
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
              <path
                d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
              />
            </svg>
          </button>
        </div>

        <div class="flex flex-wrap gap-3">
          <span
            class="px-4 py-1.5 text-purple-700 text-xs font-medium bg-purple-100 rounded-full"
          >
            Beauty
          </span>
          <span
            class="px-4 py-1.5 text-purple-700 text-xs font-medium bg-purple-100 rounded-full"
          >
            Fashion
          </span>
          <span
            class="px-4 py-1.5 text-purple-700 text-xs font-medium bg-purple-100 rounded-full"
          >
            Travel
          </span>
          <span
            class="px-4 py-1.5 text-purple-700 text-xs font-medium bg-purple-100 rounded-full"
          >
            Fitness
          </span>
        </div>
      </div>

      {{-- Linked Accounts --}}
      <div class="p-8 bg-white border border-slate-200 rounded-xl shadow-sm">
        <h3 class="mb-6 font-bold text-slate-900 text-lg">Linked Accounts</h3>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
          {{-- Instagram --}}
          <button
            class="flex py-3 px-6 border border-slate-200 rounded-full transition-colors items-center justify-center gap-2 hover:bg-slate-50"
          >
            <svg
              class="w-5 h-5"
              viewBox="0 0 24 24"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M7.5 2C4.46243 2 2 4.46243 2 7.5V16.5C2 19.5376 4.46243 22 7.5 22H16.5C19.5376 22 22 19.5376 22 16.5V7.5C22 4.46243 19.5376 2 16.5 2H7.5ZM16.5 3.83333C18.5251 3.83333 20.1667 5.47487 20.1667 7.5V16.5C20.1667 18.5251 18.5251 20.1667 16.5 20.1667H7.5C5.47487 20.1667 3.83333 18.5251 3.83333 16.5V7.5C3.83333 5.47487 5.47487 3.83333 7.5 3.83333H16.5ZM17.4167 5.20833C16.9104 5.20833 16.5 5.61875 16.5 6.125C16.5 6.63125 16.9104 7.04167 17.4167 7.04167C17.9229 7.04167 18.3333 6.63125 18.3333 6.125C18.3333 5.61875 17.9229 5.20833 17.4167 5.20833ZM12 6.58333C9.00846 6.58333 6.58333 9.00846 6.58333 12C6.58333 14.9915 9.00846 17.4167 12 17.4167C14.9915 17.4167 17.4167 14.9915 17.4167 12C17.4167 9.00846 14.9915 6.58333 12 6.58333ZM12 8.41667C13.9792 8.41667 15.5833 10.0208 15.5833 12C15.5833 13.9792 13.9792 15.5833 12 15.5833C10.0208 15.5833 8.41667 13.9792 8.41667 12C8.41667 10.0208 10.0208 8.41667 12 8.41667Z"
                fill="url(#paint0_linear_instagram)"
              />
              <defs>
                <linearGradient
                  id="paint0_linear_instagram"
                  x1="2"
                  y1="22"
                  x2="22"
                  y2="2"
                  gradientUnits="userSpaceOnUse"
                >
                  <stop stop-color="#FEDA75" />
                  <stop offset="0.25" stop-color="#FA7E1E" />
                  <stop offset="0.5" stop-color="#D62976" />
                  <stop offset="0.75" stop-color="#962FBF" />
                  <stop offset="1" stop-color="#4F5BD5" />
                </linearGradient>
              </defs>
            </svg>

            <span class="text-sm font-medium text-slate-700">Instagram</span>
          </button>

          {{-- Youtube --}}
          <button
            class="flex py-3 px-6 border border-slate-200 rounded-full transition-colors items-center justify-center gap-2 hover:bg-slate-50"
          >
            <svg
              class="w-5 h-5 text-red-600"
              fill="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"
              />
            </svg>
            <span class="text-sm font-medium text-slate-700">Youtube</span>
          </button>

          {{-- TikTok --}}
          <button
            class="flex py-3 px-6 border border-slate-200 rounded-full transition-colors items-center justify-center gap-2 hover:bg-slate-50"
          >
            <svg
              class="w-5 h-5 text-black"
              fill="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"
              />
            </svg>
            <span class="text-sm font-medium text-slate-700">TikTok</span>
          </button>
        </div>
      </div>
    </div>
  </div>
@endsection

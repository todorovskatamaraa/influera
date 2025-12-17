@extends("layouts.loggedin-layout")

@section("title", "Influentia - Apply for " . $job->campaign_name)

@section("content")
  @php
    $matchScoreLocal = $matchScore ?? null;

    if (! is_null($matchScoreLocal)) {
      $matchScoreLocal = max(0, min(99, (int) $matchScoreLocal));
      $angle = $matchScoreLocal * 3.6;
    } else {
      $angle = 0;
    }

    if (is_null($matchScoreLocal)) {
      $matchTitle = "DNA Match unavailable";
      $matchSubtitle = "Sign in as an influencer with a complete profile to see how well you match this campaign.";
    } elseif ($matchScoreLocal >= 80) {
      $matchTitle = "Strong compatibility";
      $matchSubtitle = "This campaign strongly matches your audience and content style.";
    } elseif ($matchScoreLocal >= 50) {
      $matchTitle = "Good compatibility";
      $matchSubtitle = "You share several important traits with this campaign.";
    } elseif ($matchScoreLocal > 0) {
      $matchTitle = "Partial compatibility";
      $matchSubtitle = "There is some overlap, but it is not a perfect match yet.";
    } else {
      $matchTitle = "No significant match";
      $matchSubtitle = 'Your creator DNA is quite different from this campaign\'s requirements.';
    }
  @endphp

  <div class="container min-h-screen mx-auto px-6 py-8 md:px-12 lg:px-24">
    <div class="mb-8">
      <p class="flex mb-2 text-xs text-slate-500 items-center gap-1">
        <a href="{{ route("jobs.index") }}" class="hover:text-primary">
          Find Work
        </a>
        <span>&gt;</span>
        <a href="{{ route("jobs.show", $job) }}" class="hover:text-primary">
          {{ $job->campaign_name }}
        </a>
      </p>
      <h1 class="text-3xl font-bold text-slate-900">
        Apply for {{ $job->campaign_name }}
      </h1>
      <p class="text-sm text-slate-600">
        {{ $job->user->name ?? "Brand" }}
      </p>
    </div>

    {{-- Stepper --}}
    <div
      class="w-full p-8 mb-12 bg-gradient-to-r from-purple-100 to-blue-50 rounded-2xl"
    >
      <div class="flex justify-between relative">
        <div
          class="z-0 w-full h-0.5 bg-transparent absolute top-5 left-0"
        ></div>

        <div class="flex flex-col z-10 w-1/5 items-center relative">
          <div
            id="step-indicator-1"
            class="flex w-10 h-10 mb-2 text-sm font-bold rounded-full border-2 transition-colors items-center justify-center step-active duration-300"
          >
            1
          </div>
          <span
            class="text-[10px] font-bold text-slate-800 text-center md:text-xs"
          >
            Job Info
          </span>
        </div>

        <div class="flex flex-col z-10 w-1/5 items-center relative">
          <div
            id="step-indicator-2"
            class="flex w-10 h-10 mb-2 text-sm font-bold rounded-full border-2 transition-colors items-center justify-center step-inactive duration-300"
          >
            2
          </div>
          <span
            class="text-[10px] font-bold text-slate-800 text-center md:text-xs"
          >
            Deliverables
          </span>
        </div>

        <div class="flex flex-col z-10 w-1/5 items-center relative">
          <div
            id="step-indicator-3"
            class="flex w-10 h-10 mb-2 text-sm font-bold rounded-full border-2 transition-colors items-center justify-center step-inactive duration-300"
          >
            3
          </div>
          <span
            class="text-[10px] font-bold text-slate-800 text-center md:text-xs"
          >
            DNA Match
          </span>
        </div>

        <div class="flex flex-col z-10 w-1/5 items-center relative">
          <div
            id="step-indicator-4"
            class="flex w-10 h-10 mb-2 text-sm font-bold rounded-full border-2 transition-colors items-center justify-center step-inactive duration-300"
          >
            4
          </div>
          <span
            class="text-[10px] font-bold text-slate-800 text-center md:text-xs"
          >
            Payment
          </span>
        </div>

        <div class="flex flex-col z-10 w-1/5 items-center relative">
          <div
            id="step-indicator-5"
            class="flex w-10 h-10 mb-2 text-sm font-bold rounded-full border-2 transition-colors items-center justify-center step-inactive duration-300"
          >
            5
          </div>
          <span
            class="text-[10px] font-bold text-slate-800 text-center md:text-xs"
          >
            Confirmation
          </span>
        </div>
      </div>
    </div>

    <form
      id="apply-form"
      method="POST"
      action="{{ route("jobs.apply.store", $job) }}"
    >
      @csrf

      <div
        class="overflow-hidden w-full mx-auto p-8 bg-white rounded-2xl border border-slate-100 shadow-sm relative md:p-12"
      >
        {{-- STEP 1: Job Info --}}
        <div id="step-content-1" class="step-content">
          <h2 class="mb-1 text-2xl font-bold text-slate-900">Job Info</h2>
          <p class="mb-8 text-sm text-slate-500">
            Basic information about this campaign.
          </p>

          <div class="p-8 mb-12 border border-slate-100 rounded-xl">
            <h3 class="mb-4 text-base font-bold text-slate-900">Overview</h3>

            <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
              <div class="lg:col-span-2">
                <p class="mb-8 text-sm text-slate-600 leading-relaxed">
                  {{ $job->campaign_overview }}
                </p>

                @php
                  $lookingForItems = preg_split('/\r\n|\r|\n|•|-/', $job->looking_for);
                @endphp

                <h4 class="mb-4 text-sm font-bold text-slate-900">
                  What we're looking for
                </h4>

                <ul class="space-y-3">
                  @forelse ($lookingForItems as $item)
                    @if (trim($item) !== "")
                      <li class="flex items-start gap-3">
                        <div
                          class="flex w-5 h-5 mt-0.5 bg-primary/10 rounded-full items-center justify-center shrink-0"
                        >
                          <svg
                            class="w-3 h-3 text-primary"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="3"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 13l4 4L19 7"
                            />
                          </svg>
                        </div>
                        <span class="text-sm text-slate-600">
                          {{ trim($item) }}
                        </span>
                      </li>
                    @endif
                  @empty
                    <li class="text-xs text-slate-400">
                      No specific requirements added for this campaign.
                    </li>
                  @endforelse
                </ul>
              </div>

              <div class="space-y-6">
                <div>
                  <p class="mb-1 text-xs font-bold text-slate-900">Category</p>
                  <p class="text-xs text-slate-500">
                    {{ $job->industry_category }}
                  </p>
                </div>

                <div>
                  <p class="mb-1 text-xs font-bold text-slate-900">
                    Budget range
                  </p>
                  <p class="text-xs text-slate-500">
                    ${{ $job->budget_min }} – ${{ $job->budget_max }}
                  </p>
                </div>

                <div>
                  <p class="mb-1 text-xs font-bold text-slate-900">
                    Campaign type
                  </p>
                  <p class="text-xs text-slate-500">
                    {{ $job->campaign_type }}
                  </p>
                </div>

                <div>
                  <p class="mb-1 text-xs font-bold text-slate-900">
                    Number of influencers
                  </p>
                  <p class="text-xs text-slate-500">
                    {{ $job->influencers_needed }}
                  </p>
                </div>

                <div>
                  <p class="mb-1 text-xs font-bold text-slate-900">Duration</p>
                  <p class="text-xs text-slate-500">
                    {{ $job->duration }}
                  </p>
                </div>
              </div>
            </div>
          </div>

          <h2 class="mb-1 text-2xl font-bold text-slate-900">
            Visual & Brand Guidelines
          </h2>
          <p class="mb-8 text-sm text-slate-500">
            How the brand wants to be presented.
          </p>

          <div class="p-8 border border-slate-100 rounded-xl">
            <div class="mb-8">
              <h4 class="mb-4 text-sm font-bold text-slate-900">
                Values that define this brand
              </h4>
              <div class="flex flex-wrap gap-3">
                @forelse ($job->brand_values ?? [] as $value)
                  <span
                    class="px-4 py-1.5 text-primary text-xs font-medium bg-purple-50 rounded"
                  >
                    {{ $value }}
                  </span>
                @empty
                  <span class="text-xs text-slate-400">
                    No brand values provided.
                  </span>
                @endforelse
              </div>
            </div>

            <div>
              <h4 class="mb-4 text-sm font-bold text-slate-900">
                Tone of the communication
              </h4>
              <div class="flex flex-wrap gap-3">
                @php
                  $tones = $job->brand_tones ?? [];
                  if (! empty($job->content_tone)) {
                    $tones[] = $job->content_tone;
                  }
                @endphp

                @forelse ($tones as $tone)
                  <span
                    class="px-4 py-1.5 text-primary text-xs font-medium bg-purple-50 rounded"
                  >
                    {{ $tone }}
                  </span>
                @empty
                  <span class="text-xs text-slate-400">No tone specified.</span>
                @endforelse
              </div>
            </div>
          </div>
        </div>

        {{-- STEP 2: Deliverables --}}
        <div id="step-content-2" class="hidden step-content">
          <h2 class="mb-1 text-2xl font-bold text-slate-900">Deliverables</h2>
          <p class="mb-8 text-sm text-slate-500">
            Items that you will need to deliver in order to successfully
            complete the campaign.
          </p>

          <div class="p-8 border border-slate-100 rounded-xl">
            <h3 class="mb-6 text-base font-bold text-slate-900">
              Content & Platform Requirements
            </h3>

            <ul class="space-y-4 mb-8">
              <li class="flex items-start gap-3">
                <div
                  class="flex w-5 h-5 mt-0.5 bg-primary rounded items-center justify-center shrink-0"
                >
                  <svg
                    class="w-3 h-3 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="3"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7"
                    />
                  </svg>
                </div>
                <span class="text-sm text-slate-700">
                  Content amount: {{ $job->content_amount }}
                </span>
              </li>

              @if (! empty($job->platforms))
                <li class="flex items-start gap-3">
                  <div
                    class="flex w-5 h-5 mt-0.5 bg-primary rounded items-center justify-center shrink-0"
                  >
                    <svg
                      class="w-3 h-3 text-white"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="3"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7"
                      />
                    </svg>
                  </div>
                  <span class="text-sm text-slate-700">
                    Platforms:
                    {{ implode(", ", $job->platforms) }}
                  </span>
                </li>
              @endif

              @if (! empty($job->niches))
                <li class="flex items-start gap-3">
                  <div
                    class="flex w-5 h-5 mt-0.5 bg-primary rounded items-center justify-center shrink-0"
                  >
                    <svg
                      class="w-3 h-3 text-white"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="3"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 13l4 4L19 7"
                      />
                    </svg>
                  </div>
                  <span class="text-sm text-slate-700">
                    Target niches:
                    {{ implode(", ", $job->niches) }}
                  </span>
                </li>
              @endif
            </ul>

            <p class="text-sm text-slate-900">
              <span class="font-bold">Tone:</span>
              {{ $job->content_tone }}
            </p>
          </div>
        </div>

        {{-- STEP 3: DNA Match --}}
        <div id="step-content-3" class="hidden step-content">
          <h2 class="mb-1 text-2xl font-bold text-slate-900">DNA Match</h2>
          <p class="mb-8 text-sm text-slate-500">
            This is your Digital DNA match with
            {{ $job->user->name ?? "this brand" }}.
          </p>

          <div
            class="flex flex-col p-8 border border-slate-100 rounded-xl gap-12 md:flex-row"
          >
            <div
              class="w-full p-6 bg-emerald-50/30 border border-emerald-100 rounded-xl shrink-0 md:w-80"
            >
              <div class="flex mb-6 items-center gap-2">
                <div
                  class="flex w-6 h-6 text-primary rounded items-center justify-center"
                >
                  <img
                    src="{{ asset('images/icons/logo.png') }}"
                    alt="Influentia"
                    class="w-6 h-6 object-contain"
                  />
                </div>
                <span class="font-bold text-sm text-slate-900">
                  Your DNA Match
                </span>
              </div>

              <p class="mb-4 text-xs text-slate-500 text-center">
                How well you align with this campaign
              </p>

              <div class="flex mb-6 justify-center">
                <div class="w-28 h-28 relative">
                  <div
                    class="flex w-full h-full rounded-full items-center justify-center"
                    style="
                      background: conic-gradient(
                        hsl(262 83% 58%) {{ $angle }}deg,
                        #e2e8f0 0deg
                      );
                    "
                  >
                    <div
                      class="flex w-24 h-24 bg-white rounded-full shadow-inner items-center justify-center"
                    >
                      <span class="text-3xl font-extrabold text-slate-900">
                        @if (! is_null($matchScoreLocal))
                          {{ $matchScoreLocal }}%
                        @else
                            —
                        @endif
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <p class="text-xs text-slate-600 text-center">
                {{ $matchTitle }}
              </p>
            </div>

            <div>
              <h3 class="mb-4 font-bold text-slate-900">DNA Match Results</h3>
              <p class="mb-4 text-sm text-slate-600 leading-relaxed">
                {{ $matchSubtitle }}
              </p>

              <p class="text-xs text-slate-500 leading-relaxed">
                Your score is calculated based on niche overlap, audience age
                fit and your engagement rate, using the same Digital DNA logic
                as on the Discover page.
              </p>
            </div>
          </div>
        </div>

        {{-- STEP 4: Payment --}}
        <div id="step-content-4" class="hidden step-content">
          <h2 class="mb-1 text-2xl font-bold text-slate-900">Payment</h2>
          <p class="mb-8 text-sm text-slate-500">
            All the payment information related to the job application.
          </p>

          <div class="p-8 border border-slate-100 rounded-xl">
            <h3 class="mb-4 font-bold text-slate-900">You'll receive</h3>

            <ul class="space-y-3 mb-8">
              <li class="flex items-start gap-3">
                <div
                  class="flex w-5 h-5 mt-0.5 bg-primary rounded-full items-center justify-center shrink-0"
                >
                  <svg
                    class="w-3 h-3 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="3"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7"
                    />
                  </svg>
                </div>
                <span class="text-sm text-slate-700">
                  Free or discounted product package (if applicable to this
                  campaign).
                </span>
              </li>

              <li class="flex items-start gap-3">
                <div
                  class="flex w-5 h-5 mt-0.5 bg-primary rounded-full items-center justify-center shrink-0"
                >
                  <svg
                    class="w-3 h-3 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="3"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7"
                    />
                  </svg>
                </div>
                <span class="text-sm text-slate-700">
                  Base compensation – defined in the agreement directly with the
                  brand.
                </span>
              </li>
            </ul>

            <h3 class="mb-4 font-bold text-slate-900">Payment Schedule</h3>

            <ul class="space-y-3 mb-8">
              <li class="flex items-start gap-3">
                <div
                  class="flex w-5 h-5 mt-0.5 bg-primary rounded-full items-center justify-center shrink-0"
                >
                  <svg
                    class="w-3 h-3 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="3"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7"
                    />
                  </svg>
                </div>
                <span class="text-sm text-slate-700">
                  Part of the payment may be sent on agreement/product shipment.
                </span>
              </li>

              <li class="flex items-start gap-3">
                <div
                  class="flex w-5 h-5 mt-0.5 bg-primary rounded-full items-center justify-center shrink-0"
                >
                  <svg
                    class="w-3 h-3 text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="3"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7"
                    />
                  </svg>
                </div>
                <span class="text-sm text-slate-700">
                  Remaining payment usually after content delivery and approval.
                </span>
              </li>
            </ul>

            <h3 class="mb-4 font-bold text-slate-900">
              Please choose a payment type
            </h3>

            <div class="space-y-3">
              <label class="flex cursor-pointer items-center gap-3 group">
                <input
                  type="radio"
                  name="payment_type"
                  value="wire"
                  class="custom-radio"
                />
                <span class="text-sm text-slate-700">Wire transfer</span>
              </label>

              <label class="flex cursor-pointer items-center gap-3 group">
                <input
                  type="radio"
                  name="payment_type"
                  value="paypal"
                  class="custom-radio"
                />
                <span class="text-sm text-slate-700">PayPal</span>
              </label>

              <label class="flex cursor-pointer items-center gap-3 group">
                <input
                  type="radio"
                  name="payment_type"
                  value="payoneer"
                  class="custom-radio"
                />
                <span class="text-sm text-slate-700">Payoneer</span>
              </label>

              <label class="flex cursor-pointer items-center gap-3 group">
                <input
                  type="radio"
                  name="payment_type"
                  value="cash"
                  class="custom-radio"
                />
                <span class="text-sm text-slate-700">Cash</span>
              </label>

              <label class="flex cursor-pointer items-center gap-3 group">
                <input
                  type="radio"
                  name="payment_type"
                  value="escrow"
                  class="custom-radio"
                />
                <span class="text-sm text-slate-700">Escrow</span>
              </label>
            </div>

            <p id="payment-error" class="hidden mt-2 text-xs text-red-500">
              Please select a payment type to continue.
            </p>
          </div>
        </div>

        {{-- STEP 5: Confirmation --}}
        <div id="step-content-5" class="hidden step-content">
          <h2 class="mb-1 text-2xl font-bold text-slate-900">Confirmation</h2>
          <p class="mb-8 text-sm text-slate-500">
            Please confirm the application by agreeing to the agreement consent
            below.
          </p>

          <div
            class="p-6 bg-white border border-slate-200 rounded-xl shadow-sm"
          >
            <h3 class="mb-2 font-bold text-slate-900">Agreement Consent</h3>
            <p class="mb-4 text-xs text-slate-600 leading-relaxed">
              By clicking "Agree & Apply", you confirm that you want to apply to
              <span class="font-semibold">{{ $job->campaign_name }}</span>
              and that you understand the basic expectations, deliverables and
              payment terms for this campaign.
            </p>
          </div>
        </div>

        {{-- Buttons --}}
        <div class="flex mt-12 justify-between">
          <button
            type="button"
            id="btn-back"
            class="hidden px-8 py-2.5 text-sm font-bold text-slate-600 rounded-lg border border-slate-300 transition-all hover:bg-slate-50"
          >
            Back
          </button>

          <div class="flex-1"></div>

          <button
            type="button"
            id="btn-next"
            class="px-8 py-2.5 text-white text-sm font-bold bg-primary rounded-lg transition-all shadow-lg shadow-primary/25 hover:bg-primary/90"      >
            Next
          </button>
        </div>
      </div>
    </form>
  </div>

  <style>
    .step-active {
      background-color: hsl(262 83% 58%);
      color: white;
      border-color: hsl(262 83% 58%);
    }
    .step-inactive {
      background-color: white;
      color: #64748b;
      border-color: #e2e8f0;
    }
    .step-completed {
      background-color: hsl(262 83% 58%);
      color: white;
      border-color: hsl(262 83% 58%);
    }
    .progress-bar-bg {
      background-color: #e2e8f0;
      border-radius: 9999px;
      height: 6px;
      overflow: hidden;
    }
    .progress-bar-fill {
      background-color: hsl(262 83% 58%);
      height: 100%;
      border-radius: 9999px;
    }
  </style>

  <script>
    let currentStep = 1;
    const totalSteps = 5;

    const btnNext = document.getElementById('btn-next');
    const btnBack = document.getElementById('btn-back');
    const form = document.getElementById('apply-form');

    const paymentError = document.getElementById('payment-error');

    function updateStep() {
      document
        .querySelectorAll('.step-content')
        .forEach((el) => el.classList.add('hidden'));
      document
        .getElementById(`step-content-${currentStep}`)
        .classList.remove('hidden');

      if (currentStep === 1) {
        btnBack.classList.add('hidden');
      } else {
        btnBack.classList.remove('hidden');
      }

      if (currentStep === totalSteps) {
        btnNext.textContent = 'Agree & Apply';
      } else {
        btnNext.textContent = 'Next';
      }

      for (let i = 1; i <= totalSteps; i++) {
        const indicator = document.getElementById(`step-indicator-${i}`);

        if (i < currentStep) {
          indicator.classList.remove('step-active', 'step-inactive');
          indicator.classList.add('step-completed');
          indicator.innerHTML =
            '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
        } else if (i === currentStep) {
          indicator.classList.remove('step-inactive', 'step-completed');
          indicator.classList.add('step-active');
          indicator.textContent = i;
        } else {
          indicator.classList.remove('step-active', 'step-completed');
          indicator.classList.add('step-inactive');
          indicator.textContent = i;
        }
      }

      window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function validateStep(step) {
      if (paymentError) paymentError.classList.add('hidden');

      if (step === 4) {
        const selectedPayment = document.querySelector(
          'input[type="radio"][name="payment_type"]:checked',
        );
        if (!selectedPayment) {
          if (paymentError) paymentError.classList.remove('hidden');
          return false;
        }
      }

      return true;
    }

    btnNext.addEventListener('click', () => {
      if (currentStep < totalSteps) {
        if (currentStep === 4) {
          const valid = validateStep(4);
          if (!valid) return;
        }

        currentStep++;
        updateStep();
      } else {
        form.submit();
      }
    });

    btnBack.addEventListener('click', () => {
      if (currentStep > 1) {
        currentStep--;
        updateStep();
      }
    });

    updateStep();
  </script>
@endsection

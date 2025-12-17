@extends('layouts.loggedin-layout')

@section('title', 'Influentia - Post a Job')

@section('content')
    <main class="container mx-auto px-6 md:px-12 lg:px-24 py-8 min-h-screen">
        
        <div class="mb-8">
            <p class="text-xs text-slate-500 mb-2">Jobs > Post Job</p>
            <h1 class="text-3xl font-bold text-slate-900">Post a Job</h1>
            <p class="text-sm text-slate-600">FitLife Gear</p>
        </div>

        <div class="w-full bg-gradient-to-r from-purple-100 to-blue-50 rounded-2xl p-8 mb-12">
            <div class="flex justify-between relative">
                <div class="absolute top-5 left-0 w-full h-0.5 bg-transparent z-0"></div>

                <div class="flex flex-col items-center relative z-10 w-1/6">
                    <div id="step-indicator-1" class="w-10 h-10 rounded-full flex items-center justify-center border-2 text-sm font-bold mb-2 step-active transition-colors duration-300">1</div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-800 text-center">Campaign Info</span>
                </div>
                <div class="flex flex-col items-center relative z-10 w-1/6">
                    <div id="step-indicator-2" class="w-10 h-10 rounded-full flex items-center justify-center border-2 text-sm font-bold mb-2 step-inactive transition-colors duration-300">2</div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-800 text-center">Collaboration Details</span>
                </div>
                <div class="flex flex-col items-center relative z-10 w-1/6">
                    <div id="step-indicator-3" class="w-10 h-10 rounded-full flex items-center justify-center border-2 text-sm font-bold mb-2 step-inactive transition-colors duration-300">3</div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-800 text-center">Ideal Influencer</span>
                </div>
                <div class="flex flex-col items-center relative z-10 w-1/6">
                    <div id="step-indicator-4" class="w-10 h-10 rounded-full flex items-center justify-center border-2 text-sm font-bold mb-2 step-inactive transition-colors duration-300">4</div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-800 text-center">Deliverables</span>
                </div>
                <div class="flex flex-col items-center relative z-10 w-1/6">
                    <div id="step-indicator-5" class="w-10 h-10 rounded-full flex items-center justify-center border-2 text-sm font-bold mb-2 step-inactive transition-colors duration-300">5</div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-800 text-center">Visual & Brand Guidelines</span>
                </div>
                <div class="flex flex-col items-center relative z-10 w-1/6">
                    <div id="step-indicator-6" class="w-10 h-10 rounded-full flex items-center justify-center border-2 text-sm font-bold mb-2 step-inactive transition-colors duration-300">6</div>
                    <span class="text-[10px] md:text-xs font-bold text-slate-800 text-center">Review & Submit</span>
                </div>
            </div>
        </div>

        <div class="w-full mx-auto bg-white rounded-2xl border border-slate-100 shadow-sm p-8 md:p-12 relative overflow-hidden">
            
            <form id="create-job-form" method="POST" action="{{ route('create-job.store') }}">
                @csrf

                {{-- STEP 1 --}}
                <div id="step-content-1" class="step-content">
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">Campaign Info</h2>
                    <p class="text-sm text-slate-500 mb-8">Provide basic information about the campaign</p>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Campaign Name</label>
                            <input name="campaign_name" type="text" required
                                   value="{{ old('campaign_name') }}"
                                   placeholder="Enter campaign name"
                                   class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Industry Category</label>
                            <select name="industry_category" required
                                    class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all bg-white">
                                <option value="" disabled @selected(!old('industry_category')) class="text-slate-400">Select e.g. Fashion, Tech...</option>
                                <option value="Fashion"           @selected(old('industry_category')=='Fashion')>Fashion</option>
                                <option value="Technology"        @selected(old('industry_category')=='Technology')>Technology</option>
                                <option value="Health & Fitness"  @selected(old('industry_category')=='Health & Fitness')>Health & Fitness</option>
                                <option value="Food & Beverage"   @selected(old('industry_category')=='Food & Beverage')>Food & Beverage</option>
                                <option value="Travel"            @selected(old('industry_category')=='Travel')>Travel</option>
                                <option value="Beauty"            @selected(old('industry_category')=='Beauty')>Beauty</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Campaign Overview</label>
                            <textarea name="campaign_overview" required
                                      class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all h-32 resize-none"
                                      placeholder="What is this campaign about? What should creators know?">{{ old('campaign_overview') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">What are you looking for?</label>
                            <textarea name="looking_for" required
                                      class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all h-32 resize-none"
                                      placeholder="What are you looking for in an influencers? This will help match an influencer to your campaign.">{{ old('looking_for') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- STEP 2 --}}
                <div id="step-content-2" class="step-content hidden">
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">Collaboration Details</h2>
                    <p class="text-sm text-slate-500 mb-8">What kind of collaboration are you planning?</p>

                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Budget Range</label>
                            <div class="space-y-3">
                                <div class="flex justify-between text-xs font-bold text-slate-700">
                                    <span id="budget-min-label">€{{ old('budget_min', 500) }}</span>
                                    <span id="budget-max-label">€{{ old('budget_max', 2500) }}</span>
                                </div>
                                <div class="flex flex-col gap-3">
                                    <input id="budget-min" name="budget_min" type="range" min="0" max="5000" step="100" required
                                           value="{{ old('budget_min', 500) }}"
                                           class="w-full accent-purple-600">
                                    <input id="budget-max" name="budget_max" type="range" min="0" max="5000" step="100" required
                                           value="{{ old('budget_max', 2500) }}"
                                           class="w-full accent-purple-600">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-4">Campaign Type</label>
                            <div class="space-y-3">
                                @php
                                    $campaignTypes = [
                                        'Product Promotion',
                                        'Event Coverage',
                                        'Brand Awareness',
                                        'UGC (User-Generated Content)',
                                        'Review/Testimonial',
                                    ];
                                @endphp
                                @foreach($campaignTypes as $type)
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="radio" name="campaign_type" value="{{ $type }}" required
                                               @checked(old('campaign_type')==$type)
                                               class="w-4 h-4 text-purple-600 border-slate-300 focus:ring-purple-500">
                                        <span class="text-sm text-slate-700">{{ $type }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Number of influencers needed</label>
                            <select name="influencers_needed" required
                                    class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                                <option value="" disabled @selected(!old('influencers_needed')) class="text-slate-400">Select number of influencers</option>
                                <option value="1"               @selected(old('influencers_needed')=='1')>1 influencer</option>
                                <option value="2-3"             @selected(old('influencers_needed')=='2-3')>2 - 3 influencers</option>
                                <option value="4-10"            @selected(old('influencers_needed')=='4-10')>4 - 10 influencers</option>
                                <option value="10+"             @selected(old('influencers_needed')=='10+')>10+ influencers</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Duration</label>
                            <select name="duration" required
                                    class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                                <option value="" disabled @selected(!old('duration')) class="text-slate-400">Select duration</option>
                                <option value="1-2 weeks"   @selected(old('duration')=='1-2 weeks')>1 - 2 weeks</option>
                                <option value="1 month"     @selected(old('duration')=='1 month')>1 month</option>
                                <option value="2-3 months"  @selected(old('duration')=='2-3 months')>2 - 3 months</option>
                                <option value="3-6 months"  @selected(old('duration')=='3-6 months')>3 - 6 months</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- STEP 3 --}}
                <div id="step-content-3" class="step-content hidden">
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">Ideal Influencer</h2>
                    <p class="text-sm text-slate-500 mb-8">Define the ideal influencer for the job</p>

                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Age Range</label>
                            <div class="space-y-3">
                                <div class="flex justify-between text-xs font-bold text-slate-700">
                                    <span id="age-min-label">{{ old('age_min', 21) }}</span>
                                    <span id="age-max-label">{{ old('age_max', 55) }}</span>
                                </div>
                                <div class="flex flex-col gap-3">
                                    <input id="age-min" name="age_min" type="range" min="18" max="100" step="1" required
                                           value="{{ old('age_min', 21) }}"
                                           class="w-full accent-purple-600">
                                    <input id="age-max" name="age_max" type="range" min="18" max="100" step="1" required
                                           value="{{ old('age_max', 55) }}"
                                           class="w-full accent-purple-600">
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Gender</label>
                            <select name="gender" required
                                    class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                                <option value="" disabled @selected(!old('gender')) class="text-slate-400">Select gender</option>
                                <option value="Female"     @selected(old('gender')=='Female')>Female</option>
                                <option value="Male"       @selected(old('gender')=='Male')>Male</option>
                                <option value="All"        @selected(old('gender')=='All')>All genders</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Influencer Tier</label>
                            <select name="influencer_tier" required
                                    class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm bg-white focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                                <option value="" disabled @selected(!old('influencer_tier')) class="text-slate-400">Select tier</option>
                                <option value="Nano (1K-10K)"      @selected(old('influencer_tier')=='Nano (1K-10K)')>Nano (1K - 10K)</option>
                                <option value="Micro (10K-100K)"   @selected(old('influencer_tier')=='Micro (10K-100K)')>Micro (10K - 100K)</option>
                                <option value="Macro (100K-1M)"    @selected(old('influencer_tier')=='Macro (100K-1M)')>Macro (100K - 1M)</option>
                                <option value="Mega (1M+)"         @selected(old('influencer_tier')=='Mega (1M+)')>Mega (1M+)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-4">Content Niches (select all that apply)</label>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="space-y-3">
                                    @php
                                        $leftNiches = ['Fashion','Fitness','Travel','Technology','Education','Entertainment'];
                                        $oldNiches = old('niches', []);
                                    @endphp
                                    @foreach($leftNiches as $niche)
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" name="niches[]" value="{{ $niche }}"
                                                   @checked(in_array($niche,$oldNiches))
                                                   class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                            <span class="text-sm text-slate-700">{{ $niche }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="space-y-3">
                                    @php
                                        $rightNiches = ['Beauty','Food','Lifestyle','Gaming','Business','Art'];
                                    @endphp
                                    @foreach($rightNiches as $niche)
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" name="niches[]" value="{{ $niche }}"
                                                   @checked(in_array($niche,$oldNiches))
                                                   class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                            <span class="text-sm text-slate-700">{{ $niche }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-4">Content Tone</label>
                            <div class="space-y-3">
                                @php
                                    $tones = [
                                        'Educational & Informative',
                                        'Fun & Entertaining',
                                        'Inspirational & Motivational',
                                        'Authentic & Relatable',
                                    ];
                                @endphp
                                @foreach($tones as $tone)
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="radio" name="content_tone" value="{{ $tone }}" required
                                               @checked(old('content_tone')==$tone)
                                               class="w-4 h-4 text-purple-600 border-slate-300 focus:ring-purple-500">
                                        <span class="text-sm text-slate-700">{{ $tone }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 4 --}}
                <div id="step-content-4" class="step-content hidden">
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">Deliverables</h2>
                    <p class="text-sm text-slate-500 mb-8">What kind of content is needed for your campaign?</p>

                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-2">Content Amount</label>
                            <input name="content_amount" type="text" required
                                   value="{{ old('content_amount') }}"
                                   placeholder="Input type of content and amount, e.g. 3-5 Instagram stories"
                                   class="w-full px-4 py-3 rounded-lg border border-slate-200 text-sm focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-4">Which platforms do you need content for?</label>
                            <div class="grid grid-cols-2 gap-3">
                                @php
                                    $leftPlatforms  = ['Instagram','YouTube','Facebook','Blog','TikTok','Twitter'];
                                    $rightPlatforms = ['LinkedIn','Podcast','Pinterest','Telegram'];
                                    $oldPlatforms   = old('platforms', []);
                                @endphp
                                <div class="space-y-3">
                                    @foreach($leftPlatforms as $platform)
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" name="platforms[]" value="{{ $platform }}"
                                                   @checked(in_array($platform,$oldPlatforms))
                                                   class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                            <span class="text-sm text-slate-700">{{ $platform }}</span>
                                        </label>
                                    @endforeach
                                </div>
                                <div class="space-y-3">
                                    @foreach($rightPlatforms as $platform)
                                        <label class="flex items-center gap-3 cursor-pointer">
                                            <input type="checkbox" name="platforms[]" value="{{ $platform }}"
                                                   @checked(in_array($platform,$oldPlatforms))
                                                   class="w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                            <span class="text-sm text-slate-700">{{ $platform }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 5 --}}
                <div id="step-content-5" class="step-content hidden">
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">Visual & Brand Guidelines</h2>
                    <p class="text-sm text-slate-500 mb-8">What kind of collaboration are you planning?</p>

                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-4">Select up to 3 values that define your brand:</label>
                            <div class="space-y-3">
                                @php
                                    $brandValues = ['Quality','Innovation','Wellness','Authenticity'];
                                    $oldBrandValues = old('brand_values', []);
                                @endphp
                                @foreach($brandValues as $value)
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" name="brand_values[]" value="{{ $value }}"
                                               @checked(in_array($value,$oldBrandValues))
                                               class="brand-value w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                        <span class="text-sm text-slate-700">{{ $value }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-slate-900 mb-4">Choose the tone that best fits your communication style (select up to 2):</label>
                            <div class="space-y-3">
                                @php
                                    $tones2 = ['Professional','Casual','Serious','Playful','Traditional','Innovative'];
                                    $oldBrandTones = old('brand_tones', []);
                                @endphp
                                @foreach($tones2 as $tone)
                                    <label class="flex items-center gap-3 cursor-pointer">
                                        <input type="checkbox" name="brand_tones[]" value="{{ $tone }}"
                                               @checked(in_array($tone,$oldBrandTones))
                                               class="brand-tone w-4 h-4 text-purple-600 border-slate-300 rounded focus:ring-purple-500">
                                        <span class="text-sm text-slate-700">{{ $tone }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- STEP 6 --}}
                <div id="step-content-6" class="step-content hidden">
                    <h2 class="text-2xl font-bold text-slate-900 mb-1">Job Post Confirmation</h2>
                    <p class="text-sm text-slate-500 mb-8">Please confirm your job posting.</p>

                    <div class="border border-slate-200 rounded-xl p-6 bg-white shadow-sm">
                        <h3 class="font-bold text-slate-900 mb-2">Agreement Consent</h3>
                        <p class="text-xs text-slate-600 leading-relaxed">
                            By clicking "Agree," you confirm that you understand and accept the terms of this campaign...
                        </p>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between mt-12">
                    <button id="btn-cancel" type="button"
                        class="px-8 py-2.5 rounded-lg border border-slate-300 text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all">
                        Cancel
                    </button>

                    <button id="btn-back" type="button"
                        class="px-8 py-2.5 rounded-lg border border-slate-300 text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all hidden">
                        Back
                    </button>

                    <div class="flex-1"></div>

                    <button id="btn-next" type="button"
                        class="px-8 py-2.5 rounded-lg bg-primary text-white text-sm font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/25">
                        Next
                    </button>
                </div>

            </form>
        </div>
    </main>

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
    </style>

    <script>
        let currentStep = 1;
        const totalSteps = 6;

        const btnNext   = document.getElementById('btn-next');
        const btnBack   = document.getElementById('btn-back');
        const btnCancel = document.getElementById('btn-cancel');
        const form      = document.getElementById('create-job-form');

        function updateStep() {
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
            document.getElementById(`step-content-${currentStep}`).classList.remove('hidden');

            if (currentStep === 1) {
                btnCancel.classList.remove('hidden');
                btnBack.classList.add('hidden');
            } else {
                btnCancel.classList.add('hidden');
                btnBack.classList.remove('hidden');
            }

            if (currentStep === totalSteps) {
                btnNext.textContent = 'Agree & Post';
            } else {
                btnNext.textContent = 'Next';
            }

            for (let i = 1; i <= totalSteps; i++) {
                const indicator = document.getElementById(`step-indicator-${i}`);
                if (i < currentStep) {
                    indicator.classList.remove('step-active', 'step-inactive');
                    indicator.classList.add('step-completed');
                    indicator.innerHTML = '<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>';
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

        btnNext.addEventListener('click', () => {
            if (currentStep < totalSteps) {
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

        btnCancel.addEventListener('click', () => {
            window.location.href = "{{ route('business-dashboard') }}";
        });

        function clampRanges(minInput, maxInput) {
            if (parseInt(minInput.value) > parseInt(maxInput.value)) {
                const temp = minInput.value;
                minInput.value = maxInput.value;
                maxInput.value = temp;
            }
        }

        const budgetMin = document.getElementById('budget-min');
        const budgetMax = document.getElementById('budget-max');
        const budgetMinLabel = document.getElementById('budget-min-label');
        const budgetMaxLabel = document.getElementById('budget-max-label');

        function updateBudget() {
            clampRanges(budgetMin, budgetMax);
            budgetMinLabel.textContent = '€' + budgetMin.value;
            budgetMaxLabel.textContent = '€' + budgetMax.value;
        }

        budgetMin.addEventListener('input', updateBudget);
        budgetMax.addEventListener('input', updateBudget);
        updateBudget();

        const ageMin = document.getElementById('age-min');
        const ageMax = document.getElementById('age-max');
        const ageMinLabel = document.getElementById('age-min-label');
        const ageMaxLabel = document.getElementById('age-max-label');

        function updateAge() {
            clampRanges(ageMin, ageMax);
            ageMinLabel.textContent = ageMin.value;
            ageMaxLabel.textContent = ageMax.value;
        }

        ageMin.addEventListener('input', updateAge);
        ageMax.addEventListener('input', updateAge);
        updateAge();

        function limitCheckboxes(selector, max) {
            const boxes = Array.from(document.querySelectorAll(selector));
            boxes.forEach(box => {
                box.addEventListener('change', () => {
                    const checked = boxes.filter(b => b.checked);
                    if (checked.length > max) {
                        box.checked = false;
                    }
                });
            });
        }

        limitCheckboxes('.brand-value', 3);
        limitCheckboxes('.brand-tone', 2);

        updateStep();
    </script>
@endsection

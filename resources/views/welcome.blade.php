@extends('layouts.master')

@section('style')
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="parallax-wrapper">
    <section class="parallax bg1" style="height:100vh;">
        <img src="{{ url('/images/logo/200x200.png') }}" width="200px" height="200px" style="margin: calc(50vh - 100px) calc(50% - 100px) 0 calc(50% - 100px)" alt="Agrabah Marketplace">
        <p style="text-align:center; margin-top:0; font-size:1rem;">More than a platform, we build communities</p>
    </section>
    <section class="section static">
        <div class="section-text section1">
            <span class="sm-text">Order it directly from</span>
            <br>
            <span class="lg-text">FARMERS</span>
        </div>
    </section>
    <section class="section parallax bg2">
        <span style="font-weight:800; color: white; font-size: 3rem; background-color: #ff5345; padding: 1rem;">Get it FRESH</span>
    </section>
    <section class="section static" id="login-section">
        <span class="section-head">Log in to Agrabah</span>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">{{ __('E-Mail Address') }}</label>
                <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" name="email" value="{{ old('email') }}" {{$errors->has('email') ? 'autofocus' : ''}} required>
                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>
            <button type="submit" class="btn btn-primary">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            @endif
        </form>
    </section>
    <section class="section parallax bg6">
        <div style="padding:2rem; color:white; background:rgba(0,0,0,0.5);text-align:center;">
            <span style="font-size:1.5rem;">There is a problem in the agricultural value chain. Filipino farmers get the smallest profit share while rendering a majority of the hard work.</span>
        </div>
    </section>
    <section class="section static1"  id="about-section">
        <div class="section-text">
            <h3>About Us</h3>
            <br>
            <span style="font-size:1rem;">
            Agrabah Marketplace is more than a platform, we build communities. Part of our initiative is to create awareness and encourage millennials to take part in the wave of change. We want to create awareness around the topic of food sustainability in the Philippines. Everyone???s efforts can help create the ripple effect regardless of how big or small their input is. We aim to do this through volunteering efforts and also promoting agri-preneurship as a viable occupational choice.
            </span>
        </div>
    </section>
    <section class="section static">
        <div class="section-text">
            <span style="font-size:1.2rem;">How do we connect the consumers directly to the producers and redistribute a fair profit share to the farmers?</span>
            <br>
            <span style="font-size:1rem;">
            We created a b2b web-app platform that address this issue. We provide fisherman and farmers with discoverability which means an increase in sales, marketing cost reduction and elimination of vendor-client bias. On the other hand we also provide consumer???s product cost savings, vendor discovery and analytics.
            </span>
        </div>
    </section>
    <section class="section parallax bg3">
        <span style="padding:2rem; color:white; text-align:center; background:rgba(0,0,0,0.5); font-size: 1rem;">Did you know that the average age of the Filipino farmer is 57 years old?<br><br>
        Furthermore, most of the arable land in the Philippines is not being fully utilized.<br>
        Our food production is not keeping up with the consumer demand.<br>
        Hunger and food waste is becoming an increasingly alarming issue and yet the Philippines is still called an agricultural country.</span>
    </section>
    <section class="section static">
        <div class="section-text">
            <h3>Do you want to make a difference?</h3>
            <br><br>
            <span>If you were capable of making a positive impact on the lives of others, would you?<br><br>
                Volunteering can bring a smile to their faces and inject joy into their world.
            </span>
        </div>
    </section>
    <section class="section parallax bg4">
        <span style="padding:1.5rem; color:white; text-align:center; background:rgba(0,0,0,0.5); font-size: 1rem;">Let???s help each other and uplift the lives of Filipino farmers and fishermen. If we can make our farmers more efficient, we can start a ripple effect. With each person adding to the wave, we can make a positive impact where everyone can benefit. It starts with the increase of food production, local quality food being sold in our markets, and fair pricing for both consumers and farmers. We need to be to the catalyst of the changes we want to see.<br>
        But we cannot do it alone, we need you! Yes! you! If you think you could be the change you want to see in this country, join us!</span>
    </section>
    <section class="section static">
        <div class="section-text">
            <span>
            Agrabah Marketplace is more than a platform, we build communities. Part of our initiative is to create awareness and encourage millennials to take part in the wave of change. We want to create awareness around the topic of food sustainability in the Philippines. Everyone???s efforts can help create the ripple effect regardless of how big or small their input is. We aim to do this through volunteering efforts and also promoting agri-preneurship as a viable occupational choice.
            </span>
        </div>
    </section>
    <section class="section static1">
        <div class="section-text">
            <span>
            We want to show Filipino youth that farming is not just a noble profession; it can be a profitable one too. We want to encourage Filipinos to take more of an interest in where their food is coming from, who the farmer is that produced their food, and the ways and means it took to get their food from farm to table. We???re on a mission to put farming in the spotlight, leading the wave of change to help create a sustainable Agricultural Ecosystem here in the Philippines. We want to make things better for the next generation of Filipino Farmers.
            </span>
        </div>
    </section>
    <section class="section parallax bg5"  id="volunteer-section">
        <div style="padding:2rem; color:black; background:rgba(255,255,255,0.5);">
            <span style="font-size:1.3rem;">We are always on the lookout for volunteer:</span>
            <br>
            <br>
            <ul style="font-size:1rem;">
                <li>Content Writers</li>
                <li>Vloggers</li>
                <li>Influencers</li>
                <li>Community Engagement Coordinators</li>
                <li>Event Coordinators</li>
            </ul>
            <span>Location: <b>Metro Manila</b></span>
            <br>
            <br>
            <span>If you want to be a wavemaker, please reach out to us by filling out the <a href="#volunteer_form">form</a> below.</span>
        </div>
    </section>
    <section class="lg-section static1" id="volunteer_form">
        <span class="section-head">Volunteer</span>
        <form class="m-2" method="POST" action="/volunteer">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="firstName">First Name</label>
                    <input type="text" name="volunteer_firstname" value="{{ old('volunteer_firstname') }}" id="firstName" class="form-control {{ $errors->has('volunteer_firstname') ? ' is-invalid' : '' }}" {{ $errors->has('volunteer_firstname') ? 'autofocus' : ''}}>
                    @if($errors->has('volunteer_firstname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('volunteer_firstname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="volunteer_lastname" value="{{ old('volunteer_lastname') }}" id="lastName" class="form-control {{ $errors->has('volunteer_lastname') ? ' is-invalid' : '' }}" {{ $errors->has('volunteer_lastname') ? 'autofocus' : ''}}>
                    @if($errors->has('volunteer_lastname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('volunteer_lastname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" name="volunteer_address" value="{{ old('volunteer_address') }}" class="form-control {{ $errors->has('volunteer_address') ? ' is-invalid' : '' }}" {{ $errors->has('volunteer_address') ? 'autofocus' : ''}} id="inputAddress">
                @if($errors->has('volunteer_address'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('volunteer_address') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="inputEmail">Email</label>
                <input type="text" name="volunteer_email" value="{{ old('volunteer_email') }}" class="form-control {{ $errors->has('volunteer_email') ? ' is-invalid' : '' }}" {{ $errors->has('volunteer_email') ? 'autofocus' : '' }} id="inputEmail">
                @if($errors->has('volunteer_email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('volunteer_email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="inputPhone">Phone</label>
                <input type="text" name="volunteer_mobile" value="{{ old('volunteer_mobile') }}" class="form-control {{ $errors->has('volunteer_mobile') ? ' is-invalid' : '' }}" {{ $errors->has('volunteer_mobile') ? 'autofocus' : '' }} id="inputPhone">
                @if($errors->has('volunteer_mobile'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('volunteer_mobile') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="volunteer-role">Volunteer as:</label>
                <select name="volunteer-role" id="volunteer-role" class="custom-select">
                    <option value="Content Writer Volunteer" {{ old('volunteer-role') ? 'selected' : '' }} selected>Content Writer Volunteer</option>
                    <option value="Volunteer Vlogger" {{ old('volunteer-role') == 'Volunteer Vlogger' ? 'selected' : '' }}>Volunteer Vlogger</option>
                    <option value="Volunteer Influencer" {{ old('volunteer-role') == 'Volunteer Influencer' ? 'selected' : '' }}>Volunteer Influencer</option>
                    <option value="Community Engagement Manager Volunteer" == 'Community Engagement Manager Volunteer' {{ old('volunteer-role') ? 'selected' : '' }}>Community Engagement Manager Volunteer</option>
                    <option value="Events Coordinator Volunteer" {{ old('volunteer-role') == 'Events Coordinator Volunteer' ? 'selected' : '' }}>Events Coordinator Volunteer</option>
                </select>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input {{ $errors->has('agreement') ? ' is-invalid' : '' }}" {{ $errors->has('agreement') ? 'autofocus' : '' }} name="agreement" {{ old('agreement') ? 'checked' : null }} type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        I agree to Agrabah Marketplace's Privacy terms and conditions.
                    </label>
                    @if($errors->has('agreement'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('agreement') }}</strong>
                        </span>
                    @endif
                </div>
                @if($errors->has('agreement'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('agreement') }}</strong>
                    </span>
                @endif
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>
    </section>

    <section class="lg-section static" id="contact-section">
        <span class="section-head">Contact Us</span>
        <form class="m-2" method="POST" action="/contact">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="contactFirstName">First Name</label>
                <input type="text" name="contact_firstname" id="contactFirstName" class="form-control{{ $errors->has('contact_firstname') ? ' is-invalid' : '' }}" {{$errors->has('contact_firstname') ? 'autofocus' : ''}} value="{{ old('contact_firstname') }}">
                    @if($errors->has('contact_firstname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact_firstname') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="contactLastName">Last Name</label>
                    <input type="text" name="contact_lastname" id="contactLastName" class="form-control {{ $errors->has('contact_lastname') ? ' is-invalid' : '' }}" {{$errors->has('contact_lastname') ? 'autofocus' : ''}} value="{{ old('contact_lastname') }}">
                    @if($errors->has('contact_lastname'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('contact_lastname') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="contactEmail">Email</label>
                <input type="text" name="contact_email" class="form-control {{ $errors->has('contact_email') ? ' is-invalid' : '' }}" {{ $errors->has('contact_email') ? 'autofocus' : '' }} id="contactEmail" value="{{ old('contact_email') }}">
                @if($errors->has('contact_email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('contact_email') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label for="contactMessage">Message</label>
                <textarea class="form-control {{ $errors->has('contact_message') ? ' is-invalid' : '' }}" name="contact_message" id="contactMessage" rows="3" {{ $errors->has('contact_message') ? 'autofocus' : '' }}>{{ old('contact_message') }}</textarea>
                @if($errors->has('contact_message'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('contact_message') }}</strong>
                    </span>
                @endif
            </div>
            <button class="btn btn-primary" type="submit">Submit</button>
        </form>

    </section>
    <section class="welcome-footer">
        Address: <br>
        Asian Institute of Management ??? Dado Banatao Incubator <br>
        123 Paseo de Roxas, Legazpi Village, Makati, 1229 Metro Manila <br>
        <br>
        Agrabah Marketplace &copy; 2019
    </section>
</div>
@endsection

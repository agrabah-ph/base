@extends('layouts.app')

@section('style')
<link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="parallax-wrapper">
    <section class="parallax bg1" style="height:100vh;">
        <img src="{{ url('/images/logo/200x200.png') }}" width="200px" height="200px" style="margin: calc(50vh - 100px) calc(50% - 100px) 0 calc(50% - 100px)" alt="Agrabah Marketplace">
        <p style="text-align:center; margin-top:0; font-size:1rem;">Bridging the gap in Agricultural supply</p>
    </section>
    <section class="section static">
        test
    </section>
    <section class="section parallax bg2">
        test1
    </section>
    <section class="section static">
        test2
    </section>
</div>
@endsection
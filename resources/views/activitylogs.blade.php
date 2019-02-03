@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="accordion" id="accordionLogs">
                <div class="card">
                    <div class="card-header" id="headingLogin">
                        <h4 class="mb-0">
                            <a href="#0" class="d-block" data-toggle="collapse" data-target="#collapseLogin" aria-expanded="true" aria-controls="collapseLogin">
                                <i class="fas fa-angle-down float-right"></i>Login Activity
                            </a>
                        </h4>
                    </div>
                    <div id="collapseLogin" class="collapse show" aria-labelledby="headingLogin" data-parent="#accordionLogs">
                        <div class="card-body"> 
                            @if(count($loginActivities))
                            <div class="responsiveTable">
                                <table class="col-md-12 table-striped table-condensed clearfix">
                                    <thead class="clearfix">
                                        <tr>
                                            <th>User Agent</th>
                                            <th>Ip Address</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($loginActivities as $loginActivity)
                                        <tr>
                                            <td data-title="User Agent">{{ $loginActivity->user_agent }}</td>
                                            <td data-title="Ip Address" class="pr-2">{{ $loginActivity->ip_address }}</td>
                                            <td data-title="Date" nowrap>{{ date_format($loginActivity->created_at, "M d, Y H:i:s") }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h4 class="mb-0">
                            <a href="#0" class="d-block" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                <i class="fas fa-angle-down float-right"></i>Collapse#2
                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionLogs">
                        <div class="card-body">
                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h4 class="mb-0">
                            <a href="#0" class="d-block" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                <i class="fas fa-angle-down float-right"></i>Collapse#3
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="collapse show" aria-labelledby="headingThree" data-parent="#accordionLogs">
                    <div class="card-body">
                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    /*angle rotation*/
    .card-header .fas {
        transition: .3s transform ease-in-out;
    }
    .card-header .collapsed .fas {
        transform: rotate(90deg);
    }

    @media only screen and (max-width: 800px) {
    
        /* Force table to not be like tables anymore */
        .responsiveTable table, 
        .responsiveTable thead, 
        .responsiveTable tbody, 
        .responsiveTable th, 
        .responsiveTable td, 
        .responsiveTable tr { 
            display: block; 
        }
    
        /* Hide table headers (but not display: none;, for accessibility) */
        .responsiveTable thead tr { 
            position: absolute;
            top: -9999px;
            left: -9999px;
        }
    
        .responsiveTable tr { border: 1px solid #ccc; }
    
        .responsiveTable td { 
            /* Behave  like a "row" */
            border: none;
            border-bottom: 1px solid #eee; 
            position: relative;
            padding-left: 50%; 
            white-space: normal;
            text-align:left;
        }
    
        .responsiveTable td:before { 
            /* Now like a table header */
            position: absolute;
            /* Top/left values mimic padding */
            top: 6px;
            left: 6px;
            width: 45%; 
            padding-right: 10px; 
            white-space: nowrap;
            text-align:left;
            font-weight: bold;
        }
    
        /*
        Label the data
        */
        .responsiveTable td:before { content: attr(data-title); }
    }
</style>

@extends('layouts.app')
@section('content')
<div class="main" style="background-image: url({{asset($bg)}});background-repeat: no-repeat;background-size: cover;opacity: 100%">

    <main class="content">
        <div class="container-fluid p-0">
            <div class="row mb-2 mb-xl-3">
                <div class="col-md-3 ">
                    <h3 class="text-white"><strong style="float: left;">{{ $greeting }} {{ Auth::user()->name }}</strong></h3>
                </div>
                <div class="col-md-6 d-none d-sm-block"></div>
                <div class="col-md-3 d-none d-sm-block">
                    <h3 class="text-white"><strong style="float: center;" id="tdate"></strong><strong style="float: right;" id="clock"></strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{route('registration.index')}}">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">Net Metering Registration</h5>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{route('registration2.index')}}">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">New Connections Registration</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="users"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                @if(auth()->user()->role == 'admin')
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{route('settings.user.index')}}">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">Settings</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="settings"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (in_array('CustomerDatabase',$accessRightsModule))
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="/customerdatabase">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">Customer Database</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="message-circle"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (in_array('OmniChannel',$accessRightsModule))
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="/omni-channel">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">Omni Channel</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="message-circle"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (in_array('Outages',$accessRightsModule))
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="/outages">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">Outages</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="zap-off"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (in_array('NotificationManagement',$accessRightsModule))
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="/notification-management">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">Notifications</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="bell"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (in_array('IncidentManagement',$accessRightsModule))
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="/incidentmanagement">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">Incident Management</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="hash"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (in_array('SystemAdministration',$accessRightsModule))
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="/systemadministration">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">System Administration</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="settings"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if (in_array('KnowledgeBase',$accessRightsModule))
                <div class="col-xl-4 col-xxl-4 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{route ('knowledgebase-dashboard')}}">
                                    <div class="card" style="background-color: rgba(255, 255, 255, 0.5);">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col mt-0">
                                                    <h5 class="card-title text-black">Knowledge Base</h5>
                                                </div>

                                                <div class="col-auto">
                                                    <div class="stat text-primary">
                                                        <i class="align-middle" data-feather="file"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
        </div>
        </div>
    </main>
</div>
@endsection
@push('js')
    <script>
        function updateClock() {
        var currentTime = new Date();
        var hours = currentTime.getHours();
        var minutes = currentTime.getMinutes();
        var seconds = currentTime.getSeconds();
        const currentDate = new Date();
        console.log(currentDate);
        // Format the time
        var formattedTime = hours.toString().padStart(2, '0') + ':' +
                            minutes.toString().padStart(2, '0') + ':' +
                            seconds.toString().padStart(2, '0');
        // Update the clock element
        var clockElement = document.getElementById('clock');
        clockElement.textContent = formattedTime;
        }
        // Update the clock immediately
        updateClock();
        const currentDate = new Date();
        const options = { weekday: 'short', day: 'numeric', month: 'long', year: 'numeric' };
        const formattedDate = currentDate.toLocaleString('en-US', options);
        document.getElementById('tdate').textContent = formattedDate;

        // Update the clock every second (1000 milliseconds)
        setInterval(updateClock, 1000);
    </script>
@endpush

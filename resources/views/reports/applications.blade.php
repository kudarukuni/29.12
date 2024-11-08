@extends('layouts.app')

@section('content')
    <div class="card m-2 p-2">


        <livewire:reports.application-table :state="'all'"/>

    </div>


@endsection

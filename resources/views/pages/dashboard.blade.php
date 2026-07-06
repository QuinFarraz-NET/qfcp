@extends('layouts.app')

@section('content')

<div class="flex">

    @include('partials.sidebar')

    <div class="flex-1">

        @include('partials.topbar')

        <main class="space-y-6 p-6">

            <livewire:dashboard.health-header />

            <livewire:dashboard.resource-cards />

            <div class="grid gap-6 xl:grid-cols-2">

                <livewire:dashboard.service-health />

                <livewire:dashboard.security-panel />

            </div>

            <div class="grid gap-6 xl:grid-cols-2">

                <livewire:dashboard.vpn-panel />

                <livewire:dashboard.activity-panel />

            </div>

        </main>

    </div>

</div>

@endsection

@extends('admin.layout')

@section('title', 'Dashboard')

@section('content')
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card admin-card text-center">
            <div class="card-body">
                <i class="fas fa-users text-success" style="font-size: 2.5rem;"></i>
                <h3 class="mt-3">{{ $joinPilotsCount ?? 0 }}</h3>
                <p class="text-muted mb-0">Join Pilot Submissions</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card admin-card text-center">
            <div class="card-body">
                <i class="fas fa-envelope text-primary" style="font-size: 2.5rem;"></i>
                <h3 class="mt-3">{{ $stayUpdatedCount ?? 0 }}</h3>
                <p class="text-muted mb-0">Stay Updated Subscriptions</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card admin-card text-center">
            <div class="card-body">
                <i class="fas fa-calendar-check text-info" style="font-size: 2.5rem;"></i>
                <h3 class="mt-3">Recent</h3>
                <p class="text-muted mb-0">Activity Overview</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card admin-card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Recent Join Pilot Applications</h5>
            </div>
            <div class="card-body">
                @if($recentJoinPilots && $recentJoinPilots->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentJoinPilots as $application)
                            <tr>
                                <td>{{ $application->id }}</td>
                                <td>{{ $application->name }}</td>
                                <td>{{ $application->email }}</td>
                                <td>{{ $application->mobile }}</td>
                                <td>{{ $application->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="text-muted text-center mb-0">No recent applications found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
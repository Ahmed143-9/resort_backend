@extends('admin.layout')

@section('title', 'Join Pilot Applications')

@section('content')
<div class="card admin-card">
    <div class="card-header bg-success text-white">
        <h5 class="mb-0"><i class="fas fa-users me-2"></i>Join Pilot Applications ({{ $joinPilots->count() ?? 0 }})</h5>
    </div>
    <div class="card-body">
        @if($joinPilots && $joinPilots->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($joinPilots as $application)
                    <tr id="application-{{ $application->id }}">
                        <td>{{ $application->id }}</td>
                        <td>{{ $application->name }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->mobile }}</td>
                        <td>
                            @if($application->message)
                                <button class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="{{ $application->message }}">
                                    <i class="fas fa-comment"></i>
                                </button>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $application->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteApplication({{ $application->id }})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-4">
            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">No applications found</h5>
            <p class="text-muted">There are currently no join pilot applications.</p>
        </div>
        @endif
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function deleteApplication(id) {
    if (confirm('Are you sure you want to delete this application?')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url: '/admin/join-pilots/' + id,
            type: 'DELETE',
            success: function(response) {
                if (response.success) {
                    // Remove the row from the table
                    $('#application-' + id).fadeOut(300, function() {
                        $(this).remove();
                        // Update the count
                        var countElement = $('.card-header h5').first();
                        var currentText = countElement.text();
                        var match = currentText.match(/\((\d+)\)/);
                        if (match) {
                            var count = parseInt(match[1]);
                            var newCount = count - 1;
                            var newText = currentText.replace(/\(\d+\)/, '(' + newCount + ')');
                            countElement.text(newText);
                        }
                    });
                    
                    // Show success message
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Error deleting application: ' + xhr.responseJSON.message || 'Something went wrong');
            }
        });
    }
}

// Initialize tooltips
$(document).ready(function(){
    $('[data-bs-toggle="tooltip"]').tooltip();
});
</script>
@endsection
@extends('admin.layout')

@section('title', 'Stay Updated Subscriptions')

@section('content')
<div class="card admin-card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-envelope me-2"></i>Stay Updated Subscriptions ({{ $stayUpdatedList->count() ?? 0 }})</h5>
    </div>
    <div class="card-body">
        @if($stayUpdatedList && $stayUpdatedList->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stayUpdatedList as $subscription)
                    <tr id="subscription-{{ $subscription->id }}">
                        <td>{{ $subscription->id }}</td>
                        <td>{{ $subscription->email }}</td>
                        <td>{{ $subscription->created_at->format('M d, Y H:i') }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger" onclick="deleteSubscription({{ $subscription->id }})">
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
            <h5 class="text-muted">No subscriptions found</h5>
            <p class="text-muted">There are currently no stay updated subscriptions.</p>
        </div>
        @endif
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function deleteSubscription(id) {
    if (confirm('Are you sure you want to delete this subscription?')) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url: '/admin/stay-updated/' + id,
            type: 'DELETE',
            success: function(response) {
                if (response.success) {
                    // Remove the row from the table
                    $('#subscription-' + id).fadeOut(300, function() {
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
                alert('Error deleting subscription: ' + xhr.responseJSON.message || 'Something went wrong');
            }
        });
    }
}
</script>
@endsection
@extends('admin.layout')

@section('title', 'About Us Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card admin-card">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>About Us Content Management</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.about.us.update') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="english_content" class="form-label fw-bold">
                                    <i class="fas fa-language me-1"></i>English Content
                                </label>
                                <textarea 
                                    class="form-control" 
                                    id="english_content" 
                                    name="english_content" 
                                    rows="8" 
                                    placeholder="Enter English about us content..."
                                    required
                                >{{ old('english_content', $englishContent->content ?? '') }}</textarea>
                                @error('english_content')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="bangla_content" class="form-label fw-bold">
                                    <i class="fas fa-language me-1"></i>Bangla Content
                                </label>
                                <textarea 
                                    class="form-control" 
                                    id="bangla_content" 
                                    name="bangla_content" 
                                    rows="8" 
                                    placeholder="বাংলা সম্পর্কে আমাদের বিষয়বস্তু লিখুন..."
                                    required
                                >{{ old('bangla_content', $banglaContent->content ?? '') }}</textarea>
                                @error('bangla_content')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-success px-4 py-2">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Preview Section -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card admin-card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-eye me-2"></i>Preview</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-success">English Preview:</h6>
                        <div class="border p-3 bg-light rounded">
                            <div id="english-preview">{{ $englishContent->content ?? 'No English content available' }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-success">Bangla Preview:</h6>
                        <div class="border p-3 bg-light rounded">
                            <div id="bangla-preview">{{ $banglaContent->content ?? 'No Bangla content available' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const englishTextarea = document.getElementById('english_content');
    const banglaTextarea = document.getElementById('bangla_content');
    const englishPreview = document.getElementById('english-preview');
    const banglaPreview = document.getElementById('bangla-preview');
    
    // Real-time preview
    englishTextarea.addEventListener('input', function() {
        englishPreview.textContent = this.value || 'No English content available';
    });
    
    banglaTextarea.addEventListener('input', function() {
        banglaPreview.textContent = this.value || 'No Bangla content available';
    });
});
</script>
@endsection
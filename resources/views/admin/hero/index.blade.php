@extends('admin.layout')

@section('title', 'Hero Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card admin-card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-star me-2"></i>Hero Management</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- English Content Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-primary text-white">
                                <h6 class="mb-0">English Content</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="en_subtitle" class="form-control" value="{{ $englishHero ? $englishHero->subtitle : '' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <textarea name="en_title" class="form-control" rows="3">{{ $englishHero ? $englishHero->title : '' }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="en_description" class="form-control" rows="4">{{ $englishHero ? $englishHero->description : '' }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="en_is_active" class="form-check-input" value="1" {{ ($englishHero && $englishHero->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label">Active (Display on website)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bengali Content Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-info text-white">
                                <h6 class="mb-0">Bengali Content</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Subtitle</label>
                                    <input type="text" name="bn_subtitle" class="form-control" value="{{ $bengaliHero ? $bengaliHero->subtitle : '' }}">
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Title</label>
                                    <textarea name="bn_title" class="form-control" rows="3">{{ $bengaliHero ? $bengaliHero->title : '' }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <label class="form-label">Description</label>
                                    <textarea name="bn_description" class="form-control" rows="4">{{ $bengaliHero ? $bengaliHero->description : '' }}</textarea>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input type="checkbox" name="bn_is_active" class="form-check-input" value="1" {{ ($bengaliHero && $bengaliHero->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label">Active (Display on website)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Shared Image and Submit Section -->
                        <div class="card mb-4">
                            <div class="card-header bg-warning text-dark">
                                <h6 class="mb-0">Shared Settings</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Background Image (Used for both languages)</label>
                                    <input type="file" name="background_image" class="form-control" accept="image/*">
                                    @if(($englishHero && $englishHero->background_image) || ($bengaliHero && $bengaliHero->background_image))
                                        @php
                                            $imageToShow = $englishHero && $englishHero->background_image ? $englishHero->background_image : ($bengaliHero && $bengaliHero->background_image ? $bengaliHero->background_image : null);
                                        @endphp
                                        @if($imageToShow)
                                            <div class="mt-2">
                                                <p>Current Image:</p>
                                                <img src="{{ Storage::url($imageToShow) }}" alt="Current Background" style="max-width: 200px; max-height: 150px;" class="img-thumbnail">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                
                                <button type="submit" class="btn btn-success w-100 py-3">
                                    <i class="fas fa-save me-2"></i>Save All Content
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Instructions:</strong> Update the hero content for both English and Bengali languages using the forms above. The image will be shared between both languages. 
                        Select the language from the navigation bar on the website to view the corresponding content.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
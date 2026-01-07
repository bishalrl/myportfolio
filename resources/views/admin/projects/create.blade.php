<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .form-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><i class="bi bi-plus-circle"></i> Create Project</span>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="form-container">
            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Short Description *</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="long_description" class="form-label">Long Description</label>
                    <textarea class="form-control @error('long_description') is-invalid @enderror" id="long_description" name="long_description" rows="5">{{ old('long_description') }}</textarea>
                    @error('long_description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Project Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Tech Stack (Press Enter after each technology)</label>
                    <input type="text" class="form-control" id="tech-input" placeholder="e.g., Flutter, Laravel, Firebase">
                    <div id="tech-stack-display" class="mt-2"></div>
                    <input type="hidden" name="tech_stack" id="tech_stack" value="">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="apple_store_url" class="form-label">Apple Store URL</label>
                        <input type="url" class="form-control @error('apple_store_url') is-invalid @enderror" id="apple_store_url" name="apple_store_url" value="{{ old('apple_store_url') }}">
                        @error('apple_store_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="google_play_url" class="form-label">Google Play URL</label>
                        <input type="url" class="form-control @error('google_play_url') is-invalid @enderror" id="google_play_url" name="google_play_url" value="{{ old('google_play_url') }}">
                        @error('google_play_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="website_url" class="form-label">Website URL</label>
                        <input type="url" class="form-control @error('website_url') is-invalid @enderror" id="website_url" name="website_url" value="{{ old('website_url') }}">
                        @error('website_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="github_url" class="form-label">GitHub URL</label>
                        <input type="url" class="form-control @error('github_url') is-invalid @enderror" id="github_url" name="github_url" value="{{ old('github_url') }}">
                        @error('github_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Featured Project</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="order" class="form-label">Display Order</label>
                        <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                        @error('order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Create Project
                    </button>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let techStack = [];
        const techInput = document.getElementById('tech-input');
        const techStackDisplay = document.getElementById('tech-stack-display');
        const techStackHidden = document.getElementById('tech_stack');

        techInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const tech = this.value.trim();
                if (tech && !techStack.includes(tech)) {
                    techStack.push(tech);
                    updateTechStackDisplay();
                    this.value = '';
                }
            }
        });

        function updateTechStackDisplay() {
            techStackDisplay.innerHTML = techStack.map((tech, index) => 
                `<span class="badge bg-primary me-2 mb-2">${tech} <button type="button" class="btn-close btn-close-white ms-1" onclick="removeTech(${index})"></button></span>`
            ).join('');
            techStackHidden.value = JSON.stringify(techStack);
        }

        function removeTech(index) {
            techStack.splice(index, 1);
            updateTechStackDisplay();
        }
    </script>
</body>
</html>



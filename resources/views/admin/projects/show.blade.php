<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Project - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .content-card {
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
            <span class="navbar-brand mb-0 h1"><i class="bi bi-eye"></i> View Project</span>
            <div>
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-light btn-sm me-2">
                    <i class="bi bi-pencil"></i> Edit
                </a>
                <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-light btn-sm">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="content-card">
            <h2 class="mb-4">{{ $project->title }}</h2>
            
            @if($project->image)
                <div class="mb-4">
                    <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="img-fluid rounded" style="max-height: 400px;">
                </div>
            @endif

            <div class="mb-4">
                <h5>Description</h5>
                <p>{{ $project->description }}</p>
            </div>

            @if($project->long_description)
                <div class="mb-4">
                    <h5>Long Description</h5>
                    <p>{!! nl2br(e($project->long_description)) !!}</p>
                </div>
            @endif

            @if($project->tech_stack && count($project->tech_stack) > 0)
                <div class="mb-4">
                    <h5>Tech Stack</h5>
                    @foreach($project->tech_stack as $tech)
                        <span class="badge bg-primary me-2 mb-2">{{ $tech }}</span>
                    @endforeach
                </div>
            @endif

            <div class="mb-4">
                <h5>Links</h5>
                <div class="d-flex flex-wrap gap-2">
                    @if($project->apple_store_url)
                        <a href="{{ $project->apple_store_url }}" target="_blank" class="btn btn-sm btn-outline-dark">
                            <i class="bi bi-apple"></i> App Store
                        </a>
                    @endif
                    @if($project->google_play_url)
                        <a href="{{ $project->google_play_url }}" target="_blank" class="btn btn-sm btn-outline-success">
                            <i class="bi bi-google-play"></i> Google Play
                        </a>
                    @endif
                    @if($project->website_url)
                        <a href="{{ $project->website_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-globe"></i> Website
                        </a>
                    @endif
                    @if($project->github_url)
                        <a href="{{ $project->github_url }}" target="_blank" class="btn btn-sm btn-outline-dark">
                            <i class="bi bi-github"></i> GitHub
                        </a>
                    @endif
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <strong>Featured:</strong> {{ $project->is_featured ? 'Yes' : 'No' }}
                </div>
                <div class="col-md-6">
                    <strong>Display Order:</strong> {{ $project->order }}
                </div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-primary">
                    <i class="bi bi-pencil"></i> Edit Project
                </a>
                <a href="{{ route('projects.show', $project->id) }}" target="_blank" class="btn btn-outline-primary">
                    <i class="bi bi-eye"></i> View on Site
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



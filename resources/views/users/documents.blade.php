@extends('layouts.user')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Manage Documents for {{ $user->name }}</h1>
 
    <!-- Section: Upload New Document -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h2 class="card-title mb-3">Upload a New Document</h2>
            <form action="{{ route('user.documents.store', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="document" class="form-label">Upload Document or Take Photo</label>
                    <input 
                        type="file" 
                        id="document" 
                        name="document" 
                        accept="image/*,application/pdf" 
                        capture="camera" 
                        class="form-control" 
                        required
                    >
                </div>
                <div class="mb-3">
                    <label for="document_type" class="form-label">Document Type</label>
                    <input 
                        type="text" 
                        id="document_type" 
                        name="document_type" 
                        placeholder="e.g., ID, License" 
                        class="form-control" 
                        required
                    >
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-upload"></i> Upload
                </button>
            </form>
        </div>
    </div>

    <!-- Section: Display Uploaded Documents -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h2 class="card-title mb-3">Uploaded Documents</h2>
            @if($documents->isEmpty())
                <p class="text-muted">This user hasn't uploaded any documents yet.</p>
            @else
                <ul class="list-group">
                    @foreach($documents as $document)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                @if(in_array(pathinfo($document->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                    <img 
                                        src="{{ asset('storage/' . $document->file_path) }}" 
                                        alt="Document Preview" 
                                        class="img-thumbnail me-3" 
                                        style="width: 50px; height: 50px; object-fit: cover;"
                                    >
                                @elseif(pathinfo($document->file_path, PATHINFO_EXTENSION) === 'pdf')
                                    <i class="bi bi-file-earmark-pdf text-danger me-3" style="font-size: 2rem;"></i>
                                @else
                                    <i class="bi bi-file-earmark me-3" style="font-size: 2rem;"></i>
                                @endif
                                <div>
                                    <strong>{{ $document->document_type }}</strong>
                                    <br>
                                    <small class="text-muted">Uploaded on
                                        {{ $document->created_at->toFormattedDateString() }}</small>
                                    <br>
                                    <small class="text-muted">Status:
                                        @if ($document->is_approved === null)
                                            <span class="badge bg-secondary">Pending</span>
                                        @elseif($document->is_approved)
                                            <span class="badge bg-success">Valid</span>
                                        @else
                                            <span class="badge bg-danger">Invalid</span>
                                        @endif
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex">
                                <a 
                                    href="{{ asset('storage/' . $document->file_path) }}" 
                                    target="_blank" 
                                    class="btn btn-sm btn-secondary me-2"
                                >
                                    View
                                </a>
                                <a 
                                    href="{{ asset('storage/' . $document->file_path) }}" 
                                    download 
                                    class="btn btn-sm btn-primary me-2"
                                >
                                    Download
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('user.documents.destroy', ['user' => $user->id, 'document' => $document->id]) }}" method="POST" class="ms-3">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this document?')">
                                        <i class="bi bi-x-circle"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

</div>
@endsection

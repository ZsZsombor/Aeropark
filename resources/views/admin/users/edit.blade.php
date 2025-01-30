@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Permissions for {{ $user->name }}</h1>


        <!-- Card 1: Access Card Expiration Date -->
        <div class="row">
            <!-- Card 1: Access Card Expiration -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title mb-3">Access Card Expiration Date</h2>
                        <p>
                            This user's access card expiration date is:
                            <strong>
                                {{ $user->name }}
                            </strong>
                        </p>


                        <form action="{{ route('user.update.access_card', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="accessCardExpirationDate" class="form-label">Set New Expiration Date</label>
                                <input type="date" id="accessCardExpirationDate" name="access_card_expiration_date"
                                    value="{{ old('access_card_expiration_date', $user->access_card_expiration_date ? $user->access_card_expiration_date->format('Y-m-d') : '') }}"
                                    class="form-control @error('access_card_expiration_date') is-invalid @enderror"
                                    aria-describedby="accessCardHelp" required>

                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-calendar-check"></i> Update Expiration Date
                            </button>

                        </form>
                    </div>
                </div>
            </div>

            <!-- Card 2: Criminal Record Paper -->
            <div class="col-md-6">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h2 class="card-title mb-3">Criminal Record Date</h2>
                        <p>
                            This users criminal record paper expiration date is:
                            <strong>{{ $user->criminal_record_expiration_date ? $user->criminal_record_expiration_date->toFormattedDateString() : 'Not Set' }}</strong>
                        </p>

                        <form action="{{ route('user.update.criminal_record', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="criminalRecordDocument" class="form-label">Set New Expiration Date</label>
                                <input type="date" id="criminalRecordDocument" name="criminal_record_expiration_date"
                                    value="{{ old('criminal_record_expiration_date', $user->access_card_expiration_date ? $user->access_card_expiration_date->format('Y-m-d') : '') }}"
                                    class="form-control @error('criminal_record_document') is-invalid @enderror"
                                    aria-describedby="criminalRecordHelp" required>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-calendar-check"></i> Update Expiration Date
                            </button>

                        </form>
                    </div>
                </div>
            </div>


            <!-- Section: Display Uploaded Documents -->
            <div class="card mb-4 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title mb-3">Uploaded Documents</h2>
                    @if ($documents->where('is_approved', true)->isNotEmpty())
                        <a href="{{ route('user.documents.download-valid', $user->id) }}" class="btn btn-success mb-4">
                            <i class="bi bi-cloud-download"></i> Download Valid Documents as ZIP
                        </a>
                    @endif
                    @if ($documents->isEmpty())
                        <p class="text-muted">This user hasn't uploaded any documents yet.</p>
                    @else
                        <ul class="list-group">
                            @foreach ($documents as $document)
                                <li class="list-group-item d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        @if (in_array(pathinfo($document->file_path, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']))
                                            <img src="{{ asset('storage/' . $document->file_path) }}" alt="Document Preview"
                                                class="img-thumbnail me-3"
                                                style="width: 50px; height: 50px; object-fit: cover;">
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
                                        <a href="{{ asset('storage/' . $document->file_path) }}" target="_blank"
                                            class="btn btn-sm btn-secondary me-2">
                                            View
                                        </a>

                                        <!-- Form for Updating Document Status -->
                                        <form
                                            action="{{ route('admin.documents.update', ['user' => $user->id, 'document' => $document->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_approved" value="1">
                                            <button type="submit" class="btn btn-sm btn-success me-2"
                                                {{ $document->is_approved === 1 ? 'disabled' : '' }}>
                                                Mark Valid
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('admin.documents.update', ['user' => $user->id, 'document' => $document->id]) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="is_approved" value="0">
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                {{ $document->is_approved === 0 ? 'disabled' : '' }}>
                                                Mark Invalid
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

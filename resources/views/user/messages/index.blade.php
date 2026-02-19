@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="fw-bold text-blue">My Messages</h2>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Type</th>
                                <th>Correspondent</th>
                                <th>Property</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($messages as $message)
                                <tr>
                                    <td>
                                        @if($message->sender_id == auth()->id())
                                             <span class="badge bg-primary">Sent</span>
                                        @else
                                             <span class="badge bg-success">Received</span>
                                        @endif
                                    </td>
                                    <td class="fw-bold text-blue">
                                        {{ $message->sender_id == auth()->id() ? ($message->receiver->name ?? 'Admin') : $message->sender->name }}
                                    </td>
                                    <td>
                                        @if($message->property)
                                            <a href="{{ route('available-properties.show', $message->property->id) }}"
                                                class="text-decoration-none fw-bold text-dark">
                                                {{ Str::limit($message->property->headline, 30) }}
                                            </a>
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($message->message, 50) }}</td>
                                    <td class="text-muted small">{{ $message->created_at->format('d M Y H:i') }}</td>
                                    <td>
                                        @if($message->property)
                                            <button type="button" class="btn btn-sm btn-outline-primary" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#messageModal{{ $message->id }}">
                                                <i class="bi bi-reply-fill"></i> Reply
                                            </button>

                                            <!-- Reply Modal -->
                                            <div class="modal fade" id="messageModal{{ $message->id }}" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-bold">Reply</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ route('property.message.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="property_id" value="{{ $message->property->id }}">
                                                            <div class="modal-body">
                                                                <p class="small text-muted mb-2">To: {{ $message->sender_id == auth()->id() ? ($message->receiver->name ?? 'Admin') : $message->sender->name }}</p>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Message</label>
                                                                    <textarea name="message" class="form-control" rows="5" required placeholder="Type your reply here..."></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Send Reply</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5 text-muted">
                                        <i class="bi bi-chat-dots fs-1 mb-3 d-block"></i>
                                        No messages found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $messages->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
    <div class="card shadow-sm h-100" style="min-height: calc(100vh - 140px);">
        <div class="row g-0 h-100">
            <!-- Sidebar: Conversation List -->
            <div class="col-md-4 col-lg-3 border-end bg-white d-flex flex-column h-100">
                <div class="p-3 border-bottom bg-light">
                    <input type="text" class="form-control" placeholder="Search conversations..." id="searchConversations">
                </div>
                <div class="list-group list-group-flush overflow-auto flex-grow-1" id="conversationList">
                    @forelse($conversations as $conversation)
                        <a href="#" class="list-group-item list-group-item-action py-3 conversation-item"
                            data-property-id="{{ $conversation->property->id }}"
                            data-other-user-id="{{ $conversation->other_user->id }}"
                            data-headline="{{ $conversation->property->headline }}"
                            data-username="{{ $conversation->other_user->name }}">
                            <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                <strong class="text-truncate"
                                    style="max-width: 140px;">{{ $conversation->other_user->name }}</strong>
                                <small class="text-muted">{{ $conversation->last_message->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1 text-truncate small text-muted">{{ $conversation->property->headline }}</p>
                            @if($conversation->unread_count > 0)
                                <span class="badge bg-danger rounded-pill float-end">{{ $conversation->unread_count }}</span>
                            @endif
                        </a>
                    @empty
                        <div class="p-4 text-center text-muted">
                            <i class="bi bi-chat-square-dots fs-1 mb-2"></i>
                            <p>No conversations yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Main: Chat Window -->
            <div class="col-md-8 col-lg-9 d-flex flex-column h-100 bg-white">
                <!-- Chat Header -->
                <div class="p-3 border-bottom bg-white d-flex align-items-center justify-content-between" id="chatHeader"
                    style="display: none !important;">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3"
                            style="width: 40px; height: 40px; font-weight: bold;" id="chatAvatar">
                            ?
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold" id="chatUserName">Select a conversation</h6>
                            <small class="text-muted" id="chatPropertyTitle"></small>
                        </div>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary d-md-none" id="backToConversations">
                        <i class="bi bi-arrow-left"></i> Back
                    </button>
                </div>

                <!-- Empty State -->
                <div class="d-flex flex-column align-items-center justify-content-center flex-grow-1 text-muted"
                    id="emptyState">
                    <i class="bi bi-chat-dots fs-1 mb-3 text-secondary op-50"></i>
                    <h5>Select a conversation to start chatting</h5>
                </div>

                <!-- Messages Area -->
                <div class="flex-grow-1 p-3 overflow-auto" id="messagesContainer"
                    style="display: none; background-color: #f8f9fa;">
                    <!-- Messages will be injected here via JS -->
                </div>

                <!-- Input Area -->
                <div class="p-3 border-top bg-white" id="inputArea" style="display: none;">
                    <form id="messageForm" class="d-flex gap-2">
                        @csrf
                        <input type="hidden" name="property_id" id="inputPropertyId">
                        <input type="hidden" name="recipient_id" id="inputRecipientId">
                        <input type="text" class="form-control" name="message" id="messageInput"
                            placeholder="Type a message..." required autocomplete="off">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send-fill"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const conversationList = document.getElementById('conversationList');
            const emptyState = document.getElementById('emptyState');
            const messagesContainer = document.getElementById('messagesContainer');
            const inputArea = document.getElementById('inputArea');
            const chatHeader = document.getElementById('chatHeader');
            const chatUserName = document.getElementById('chatUserName');
            const chatPropertyTitle = document.getElementById('chatPropertyTitle');
            const chatAvatar = document.getElementById('chatAvatar');
            const backToConversations = document.getElementById('backToConversations');
            const messageForm = document.getElementById('messageForm');
            const messageInput = document.getElementById('messageInput');

            let currentPropertyId = null;
            let currentOtherUserId = null;
            let pollInterval = null;

            // Mobile Back Button
            if (backToConversations) {
                backToConversations.addEventListener('click', function() {
                    chatHeader.style.setProperty('display', 'none', 'important');
                    messagesContainer.style.display = 'none';
                    inputArea.style.display = 'none';
                    emptyState.style.display = 'flex';
                    
                    // Clear active state
                    document.querySelectorAll('.conversation-item').forEach(el => el.classList.remove('active'));
                    
                    // Stop polling
                    if (pollInterval) clearInterval(pollInterval);
                    
                    // Scroll to top to see list
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            // Click on Conversation
            conversationList.addEventListener('click', function (e) {
                const item = e.target.closest('.conversation-item');
                if (!item) return;
                e.preventDefault();

                // Set Active State
                document.querySelectorAll('.conversation-item').forEach(el => el.classList.remove('active'));
                item.classList.add('active');

                // Get Data
                currentPropertyId = item.dataset.propertyId;
                currentOtherUserId = item.dataset.otherUserId;
                const headline = item.dataset.headline;
                const username = item.dataset.username;

                // Update Header
                chatUserName.textContent = username;
                chatPropertyTitle.textContent = headline;
                chatAvatar.textContent = username.charAt(0).toUpperCase();

                // Show Chat Interface
                emptyState.style.display = 'none';
                chatHeader.style.setProperty('display', 'flex', 'important');
                messagesContainer.style.display = 'block';
                inputArea.style.display = 'block';

                // Set Form Data
                document.getElementById('inputPropertyId').value = currentPropertyId;
                document.getElementById('inputRecipientId').value = currentOtherUserId;

                // Fetch Messages immediately
                fetchMessages();

                // Start Polling
                if (pollInterval) clearInterval(pollInterval);
                pollInterval = setInterval(fetchMessages, 3000); // Poll every 3 seconds

                // Scroll to bottom
                messagesContainer.scrollTop = messagesContainer.scrollHeight;
            });

            // Send Message
            messageForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const message = messageInput.value.trim();
                if (!message) return;

                // Optimistic UI Update (optional, but good for UX)
                // appendMessage(message, true); // True = me

                fetch("{{ route('admin.messages.send') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        property_id: currentPropertyId,
                        recipient_id: currentOtherUserId,
                        message: message
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            messageInput.value = '';
                            fetchMessages(); // Refresh to show new message properly with timestamp
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });

            function fetchMessages() {
                if (!currentPropertyId || !currentOtherUserId) return;

                fetch("{{ route('admin.messages.fetch') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        property_id: currentPropertyId,
                        other_user_id: currentOtherUserId
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        renderMessages(data.messages, data.auth_id);
                    })
                    .catch(error => console.error('Error fetching messages:', error));
            }

            function renderMessages(messages, authId) {
                messagesContainer.innerHTML = '';

                let lastDate = null;

                messages.forEach(msg => {
                    const isMe = msg.sender_id == authId;
                    const msgDate = new Date(msg.created_at).toLocaleDateString();

                    // Date Separator if needed
                    if (msgDate !== lastDate) {
                        const dateDiv = document.createElement('div');
                        dateDiv.className = 'text-center my-3';
                        dateDiv.innerHTML = `<span class="badge bg-light text-muted fw-normal border">${msgDate}</span>`;
                        messagesContainer.appendChild(dateDiv);
                        lastDate = msgDate;
                    }

                    const msgDiv = document.createElement('div');
                    msgDiv.className = `d-flex mb-3 ${isMe ? 'justify-content-end' : 'justify-content-start'}`;

                    const time = new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                    msgDiv.innerHTML = `
                        <div class="d-flex flex-column ${isMe ? 'align-items-end' : 'align-items-start'}" style="max-width: 75%;">
                            <div class="px-3 py-2 rounded-3 ${isMe ? 'bg-primary text-white' : 'bg-white border text-dark shadow-sm'}">
                                ${msg.message}
                            </div>
                            <small class="text-muted mt-1" style="font-size: 0.7rem;">${time}</small>
                        </div>
                    `;

                    messagesContainer.appendChild(msgDiv);
                });

                // Auto-scroll if near bottom or first load
                // messagesContainer.scrollTop = messagesContainer.scrollHeight;
            }
        });

        // Simple search filter
        document.getElementById('searchConversations').addEventListener('keyup', function () {
            const value = this.value.toLowerCase();
            document.querySelectorAll('.conversation-item').forEach(item => {
                const text = item.textContent.toLowerCase();
                item.style.display = text.includes(value) ? 'block' : 'none';
            });
        });
    </script>

    <style>
        .conversation-item.active {
            background-color: #e9ecef;
            border-right: 3px solid var(--primary-pink);
        }

        #messagesContainer::-webkit-scrollbar {
            width: 6px;
        }

        #messagesContainer::-webkit-scrollbar-thumb {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 4px;
        }
    </style>
@endpush
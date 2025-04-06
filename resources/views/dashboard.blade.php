<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>

        <!-- Notification Button -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <button class="btn btn-primary" id="showNotifications">
                Show Notifications
                <span class="badge bg-danger" id="notificationCount">
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
            </button>
        </div>

        <!-- Notification Modal -->
        <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="notificationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notifications</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group" id="notificationList">
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <li class="list-group-item">
                                    {{ $notification->data['message'] }}
                                    <br>
                                    <small class="text-muted">Completed by: {{ $notification->data['completed_by'] }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-success" id="markAllAsRead">Mark All as Read</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap 5.3 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
   document.getElementById('markAllAsRead').addEventListener('click', function () {
    fetch('{{ route("notifications.readAll") }}', {
        method: 'POST',  // ✅ Ensure this is POST, not GET
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',  // ✅ CSRF Token is required for Laravel POST requests
            'Content-Type': 'application/json'
        }
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              document.getElementById('notificationList').innerHTML = '<li class="list-group-item text-muted">No new notifications</li>';
              document.getElementById('notificationCount').innerText = '0';
          }
      }).catch(error => console.error('Error:', error));
});

    </script>

</x-app-layout>

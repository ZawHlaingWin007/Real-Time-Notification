@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Groups') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            @forelse ($groups as $group)
                                <div class="col-md-4 my-2">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4><strong>{{ $group->name }}</strong></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="card-title">
                                                <ul class="list-group mb-3">
                                                    @forelse ($group->users as $user)
                                                        <li class="list-group-item">{{ $user->name }}</li>
                                                    @empty
                                                        <p class="text-danger text-center">
                                                            <strong>
                                                                <small>Please Join this group!</small>
                                                            </strong>
                                                        </p>
                                                    @endforelse
                                                </ul>
                                                <div class="d-flex justify-content-between">
                                                    @can('join-group', $group)
                                                        <a href="{{ route('groups.joinGroup', $group) }}" id="joinGroupButton"
                                                            class="btn btn-sm btn-primary"
                                                            data-group-id="{{ $group->id }}">Join Group</a>
                                                    @else
                                                        <a href="{{ route('groups.leaveGroup', $group) }}" id="leaveGroupButton"
                                                            class="btn btn-sm btn-danger"
                                                            data-group-id="{{ $group->id }}">Leave Group</a>
                                                    @endcan
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom_scripts')
    <script>
        // ...
        // Subscribe to the group channel
        $(document).on('click', '#joinGroupButton', function(e) {
            // e.preventDefault();
            let groupId = $(this).data('group-id');
            Echo.private(`group.${groupId}`)
                .listen('.group-notification', (event) => {
                    console.log(event);
                    alert(event.message);
                });
        });
        // const groupJoinButtons = document.querySelectorAll('#joinGroupButton');
        // groupJoinButtons.forEach((button) => {
        //     const groupId = button.getAttribute('data-group-id');

        //     Echo.private('group.' + groupId)
        //         .listen('GroupJoinedNotificationEvent', (event) => {
        //             // Handle the notification event here
        //             console.log(event);
        //             alert(event.message);

        //             // Store the notification in LocalStorage
        //             const notifications = JSON.parse(localStorage.getItem('notifications')) || [];
        //             notifications.push(event.message);
        //             localStorage.setItem('notifications', JSON.stringify(notifications));

        //             // Update the notification count
        //             const countElement = document.getElementById('notification-count');
        //             const count = parseInt(countElement.innerText);
        //             countElement.innerText = count + 1;

        //             // Add the notification message to the dropdown
        //             const dropdown = document.querySelector('.notification-dropdown');
        //             const notificationElement = document.createElement('p');
        //             notificationElement.className = 'dropdown-item mb-1 alert alert-primary';
        //             notificationElement.innerText = event.message;
        //             dropdown.appendChild(notificationElement);
        //         });
        // });
    </script>
@endpush

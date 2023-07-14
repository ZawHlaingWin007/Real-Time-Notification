@extends('layouts.app')

@section('content')
    <h1>{{ $group->name }}</h1>
    <div id="notificationContainer"></div>
@endsection

@push('custom_scripts')
    <script>
        let groupId = {{ $group->id }};
        Echo.join(`group.${groupId}`)
            .here((users) => {
                console.log(users)
            })
            .joining((user) => {
                console.log(user.name);
            })
            .leaving((user) => {
                console.log(user.name);
            })
            .listen('.group-notification', (e) => {
                console.log(e.message)
                var notification = $('<div>')
                    .addClass('notification alert alert-info')
                    .append(
                        $('<span>').addClass('message').text(e.message),
                        $('<button>').addClass('mark-as-read btn btn-primary btn-sm').text('Mark as Read')
                    );

                $('#notificationContainer').prepend(notification);
                notification.fadeIn();
                // setTimeout(function() {
                //     notification.fadeOut(function() {
                //         $(this).remove();
                //     });
                // }, 5000);
            })
            .error((error) => {
                console.error(error);
            });

        $(document).on('click', '.mark-as-read', function () {
            $(this).parent().fadeOut()
        })
    </script>
@endpush

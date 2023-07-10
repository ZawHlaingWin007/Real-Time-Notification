<!DOCTYPE html>
<html>

<head>
    <title>Real-time Notifications</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .notification {
            border-bottom: 1px solid #e3e3e3;
            padding: 10px;
        }

        .notification .message {
            display: inline-block;
        }

        .notification .mark-as-read {
            float: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Real-time Notifications</h1>
        <div id="notificationContainer"></div>

        <button id="sendNotificationBtn" class="btn btn-primary">Send Notification</button>
    </div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Listen for new notifications
        Echo.channel('notifications')
            .listen('.send-noti', (e) => {
                // Create notification element
                console.log("Wop This is not need to referesh")
                var notification = $('<div>')
                    .addClass('notification alert alert-info')
                    .attr('data-notification-id', e.notification.id)
                    .append(
                        $('<span>').addClass('message').text(e.notification.message),
                        $('<button>').addClass('mark-as-read btn btn-primary btn-sm').text('Mark as Read')
                    );

                // Append notification to container
                $('#notificationContainer').prepend(notification);

                // Display the notification with a fade-in effect
                // notification.fadeIn();

                // Automatically remove the notification after a few seconds
                // setTimeout(function() {
                //     notification.fadeOut(function() {
                //         $(this).remove();
                //     });
                // }, 5000);

                // Handle "Mark as Read" button click
                notification.on('click', '.mark-as-read', function() {
                    var notificationId = $(this).closest('.notification').data('notification-id');
                    $(this).closest('.notification').fadeOut();
                });
            });

        // Send notification on button click
        $('#sendNotificationBtn').on('click', function() {
            $.ajax({
                url: '/send-notification', // Update with your Laravel route
                method: 'POST',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    </script>
</body>

</html>

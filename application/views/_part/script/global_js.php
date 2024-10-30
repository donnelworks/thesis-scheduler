<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script type="text/javascript">
    var BASE_URL = '<?= base_url() ?>';
    var VIEW_DATA = <?= json_encode($view_data) ?>;

    // PUSHER
    // Pusher.logToConsole = false; // Enable pusher logging - don't include this in production

    // var PUSHER = new Pusher('35b474ece0d9963ea9fa', {
    //     cluster: 'ap1',
    //     forceTLS: true
    // });
    // var CHANNEL = PUSHER.subscribe('sijaga');

    // var BEAMS_CLIENT = new PusherPushNotifications.Client({
    //     instanceId: "29a1c07c-00b4-4ab7-8f8d-a8f66a994883",
    // });
</script>
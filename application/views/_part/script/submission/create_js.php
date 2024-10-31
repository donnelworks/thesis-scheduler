<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script type="text/javascript">
    $(document).ready(() => {

        // Select
        $(".select").select2({
            theme: "bootstrap4",
        });

        // Submit
        $(document).on('submit', '#formData', function(e) {
            e.preventDefault();

            loadingScreenOn();

            let form = $('#formData')[0];
            let data = new FormData(form);
            let req = requestUploadAjax('<?= site_url('submission/submit_data') ?>', data);
            req.done((res) => {
                if (res.success) {
                    
                }
            }).always(() => {
                loadingScreenOff();
            });
        });

    });
</script>
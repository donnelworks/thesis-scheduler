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
            removeInvalidValidation();
            let form = $('#formData')[0];
            let data = new FormData(form);
            let req = requestUploadAjax('<?= site_url('submission/submit_data') ?>', data);
            req.done((res) => {
                if (res.success) {

                } else {
                    if (res.status_message === "FORM_VALIDATION_ERROR") {
                        formValidation(res.data.error);
                    }
                    if (res.status_message === "ERROR_UPLOAD") {
                        $(`[name="${res.data.field}"]`).parents('.form-group').append(res.data.message);
                    }
                }
            }).always(() => {
                loadingScreenOff();
            });
        });

    });
</script>
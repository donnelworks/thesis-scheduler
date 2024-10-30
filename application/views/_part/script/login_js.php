<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script type="text/javascript">
    $(document).ready(async () => {
        $('#formLogin').submit(function(e) {
            e.preventDefault();
    
            loadingScreenOn();
            $('.alert').remove();
    
            let req = requestAjax('<?= site_url('auth/login') ?>', $(this).serialize());
    
            req.done((res) => {
                removeInvalidValidation();
    
                if (res.success) {
                    window.location.href = "<?= site_url('dashboard') ?>";
                } else {
                    loadingScreenOff();
                    if (res.status_message === "AUTH_ERROR") {
                        $('#formLogin').before(res.data);
                    }
                    if (res.status_message === "FORM_VALIDATION_ERROR") {
                        formValidation(res.data);
                    }
                }
            });
        });
    });
</script>
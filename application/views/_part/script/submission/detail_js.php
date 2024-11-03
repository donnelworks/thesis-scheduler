<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script type="text/javascript">
    $(document).ready(() => {

        // Select
        $(".select").select2({
            theme: "bootstrap4",
        });

        // Select Status
        $(document).on('click', '[name="status"]', function() {
            
            if ($('#radioRevisedSubmission').is(':checked')) {
                $('#statusNotes').parents('.form-group').slideDown();
            } else {
                $('#statusNotes').val("");
                $('#statusNotes').parents('.form-group').slideUp();
            }
        });

        // Preview File
        $(document).on('click', '.preview-data', function(e) {
            e.preventDefault();
            let file = $(this).data('file');
            
            if (file) {
                window.open(`<?= base_url() ?>assets/files/submissions/${file}`, '_blank');
            }
        });

        // Submit
        $(document).on('submit', '#formData', function(e) {
            e.preventDefault();

            loadingScreenOn();
            removeInvalidValidation();
            let form = $('#formData')[0];
            let data = new FormData(form);
            let req = requestUploadAjax('<?= site_url('submission/update_data') ?>', data);
            req.done((res) => {
                if (res.success) {
                    $('#formData').trigger('reset');
                    $('.btn-save').prop('disabled', true);
                    $('#mdlSuccess').modal({backdrop: 'static'});
                    $('#mdlSuccess h5').text(res.data.message);
                    $('#mdlSuccess #btnDone').text("Selesai");
                    $('#mdlSuccess #btnDone').attr('href', '<?= site_url('submission') ?>');
                } else {
                    if (res.status_message === "ERROR_SUBMISSION_IS_EXIST") {
                        toast("error", res.data);
                    }
                    if (res.status_message === "FORM_VALIDATION_ERROR") {
                        toast("error", "Pengajuan gagal diubah. Silahkan cek kembali form pengajuan Anda");
                        formValidation(res.data.error);
                    }
                    if (res.status_message === "ERROR_UPLOAD") {
                        toast("error", "Pengajuan gagal diubah. Silahkan cek kembali form pengajuan Anda");
                        $(`[name="${res.data.field}"]`).parents('.form-group').append(res.data.message);
                    }
                }
            }).always(() => {
                loadingScreenOff();
            });
        });

    });
</script>
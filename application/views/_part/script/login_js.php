<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script type="text/javascript">
    $(document).ready(async () => {

        loadTable();

        // Set Periode
        setPeriode('.periode-filter', false);

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

    function loadTable() {
        let tblShedule = $('#tblShedule').datatable({
            url: "<?= site_url('login/load_table') ?>",
            formFilter: "#formFilter",
            data: function(d) {
                let formData = $('#formFilter').serializeArray();
                $.each(formData, function(key, val) {
                    d[val.name] = val.value;
                });
            },
            pageLength: {
                length: 25,
                lengthChange: true,
            },
            info: false,
            order: [
                [2, 'asc'],
            ],
            rowReorder: {
                enable: false,
            },
            columns: [{
                    data: null,
                    className: 'dtr-control',
                    orderable: false,
                    searchable: false,
                    defaultContent: '',
                    width: '20'
                },
                {
                    data: 'colleger_nim',
                    className: 'min-tablet-l text-truncate-dt'
                },
                {
                    data: 'colleger_name',
                    className: 'all text-truncate-dt'
                },
                {
                    data: 'study_program_name',
                    className: 'min-tablet-l text-truncate-dt'
                },
                {
                    data: 'date',
                    className: 'min-tablet-l text-truncate-dt',
                    render: function(data, type, row) {
                        return `${dateTime(data, "date-string-full", " ")} ${row.start_time?.split(':')[0]}:${row.start_time?.split(':')[1]} - ${row.end_time?.split(':')[0]}:${row.end_time?.split(':')[1]} WIB`;
                    }
                },
                {
                    data: 'lead_tester_name',
                    className: 'none',
                },
                {
                    data: 'main_tester_name',
                    className: 'none',
                },
                {
                    data: 'secondary_tester_name',
                    className: 'none',
                },
            ],
            emptyTable: `<img style="width: 20rem; margin: 20px 0;" src="<?= base_url() ?>assets/img/empty-image.svg">
                            <h5>Tidak ada jadwal ditemukan</h5>
                        <p class="text-gray">Silahkan hubungi Admin</p>`
        });

        return tblShedule;
    }
</script>
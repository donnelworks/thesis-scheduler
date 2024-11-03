<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script type="text/javascript">
    $(document).ready(() => {

        var SUBMIT_ACTION;

        loadTable();

        // Periode
        setPeriode('.periode-filter', false);

        // Time
        $('#startTime').datetimepicker({
            format: 'HH:mm',
        });
        $('#endTime').datetimepicker({
            format: 'HH:mm',
        });

        // Date
        $('.date').datepicker({
            autoclose: true,
            orientation: 'auto bottom',
            format: 'dd-mm-yyyy',
            language: 'id',
            startDate: new Date(),
            templates: {
                leftArrow: '<i class="bx bx-chevron-left"></i>',
                rightArrow: '<i class="bx bx-chevron-right"></i>',
            }
        }).datepicker('setDate', new Date());


        // Select
        $(".select").select2({
            theme: "bootstrap4",
        });

        // Add Modal
        $(document).on('click', '.btn-add', function() {
            SUBMIT_ACTION = "create";
            removeInvalidValidation();
            $('#formData').trigger('reset');
            $('.select').val("").trigger('change.select2');
            $('#mdlFormData .modal-title').text("Tambah Data");
            $('#mdlFormData .btn-submit').text("Simpan");
            $('#mdlFormData').modal({
                backdrop: 'static'
            });
            $('#mdlFormData').on('shown.bs.modal', function() {
                $('#number').focus();
            });
        });

        // Edit Modal
        $(document).on('click', '.edit-data', function() {
            let data = $(this).data();
            $('#id').val(data.id);
            $('#number').val(data.number);
            $('#date').val(data.date);
            $('#startTime').val(data.starttime);
            $('#endTime').val(data.endtime);
            $('#submission').val(data.submission).trigger('change.select2');
            $('#leadTester').val(data.leadtester).trigger('change.select2');
            $('#mainTester').val(data.maintester).trigger('change.select2');
            $('#secondaryTester').val(data.secondarytester).trigger('change.select2');

            SUBMIT_ACTION = "update";
            $('#mdlFormData .modal-title').text("Ubah Data");
            $('#mdlFormData .btn-submit').text("Ubah");
            $('#mdlFormData').modal({
                backdrop: 'static'
            });
            $('#mdlFormData').on('shown.bs.modal', function() {
                $('#number').bliur();
            });
            removeInvalidValidation();
        });

        // Delete Modal
        $(document).on('click', '.delete-data', function() {
            let data = $(this).data();
            $('#deleteKey').val(data.id);
            $('#mdlDelete').modal();
        });

        // Submit
        $(document).on('submit', '#formData', function(e) {
            e.preventDefault();

            loadingScreenOn();
            let req = requestAjax('<?= site_url('schedule/submit_data') ?>', `${$(this).serialize()}&submit_action=${SUBMIT_ACTION}`);
            req.done((res) => {
                if (res.success) {
                    reloadDatatable('#tblData');
                    removeInvalidValidation();
                    $('#number').focus();
                    $('#formData').trigger('reset');
                    $('.select').val("").trigger('change.select2');
                    toast("success", res.data.message);
                    if (SUBMIT_ACTION === "update") {
                        $('#mdlFormData').modal('hide');
                    }
                } else {
                    if (res.status_message === "FORM_VALIDATION_ERROR") {
                        formValidation(res.data.error);
                    }
                }
            }).always(() => {
                loadingScreenOff();
            });
        });

        // Delete
        $(document).on('submit', '#formDelete', function(e) {
            e.preventDefault();

            loadingScreenOn();
            let req = requestAjax('<?= site_url('schedule/delete_data') ?>', $(this).serialize());
            req.done((res) => {
                if (res.success) {
                    reloadDatatable('#tblData');
                    removeInvalidValidation();
                    $('#formDelete').trigger('reset');
                    $('#mdlDelete').modal('hide');
                    toast("success", res.data.message);
                }
            }).always(() => {
                loadingScreenOff();
            });
        });

        // Print
        $(document).on('click', '.print-data', function() {
            let data = $(this).data();
            window.open("<?= site_url('schedule/print?type="+data.type+"&id="+data.id+"') ?>", '_blank').focus();
        });

    });

    function loadTable() {
        let tblData = $('#tblData').datatable({
            url: "<?= site_url('schedule/load_table') ?>",
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
                [9, 'asc'],
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
                    data: 'number',
                    className: 'min-tablet-l text-truncate-dt'
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
                {
                    data: 'created_date',
                    className: 'none',
                    render: function(data, type, row) {
                        return row.created_date !== null ? `${dateTime(data, "datetime-string", " ")} (${row.created_name})` : "-";
                    }
                },
                {
                    data: 'updated_date',
                    className: 'none',
                    render: function(data, type, row) {
                        return row.updated_date !== null ? `${dateTime(data, "datetime-string", " ")} (${row.updated_name})` : "-";
                    }
                },
                {
                    data: "id",
                    className: 'all text-nowrap',
                    orderable: false,
                    searchable: false,
                    width: '100',
                    render: function(data, type, row) {
                        return `
                        <div class="text-center">
                            <a data-toggle="dropdown" class="text-gray" href="javascript:void(0)">
                                <i class="bx bx-dots-horizontal-rounded bx-sm"></i>
                            </a>
                            <div class="dropdown-menu rounded-lg border-0 shadow-lg">
                                <a class="dropdown-item print-data" href="javascript:void(0)" data-id="${data}" data-type="ta">
                                <i class="bx bx-printer"></i> Cetak Surat Tugas</a>
                                <a class="dropdown-item print-data" href="javascript:void(0)" data-id="${data}" data-type="ba">
                                <i class="bx bx-printer"></i> Cetak Berita Acara</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item edit-data" href="javascript:void(0)" data-id="${data}" data-number="${row.number}" data-date="${row.date}" data-starttime="${row.start_time}" data-endtime="${row.end_time}" data-submission="${row.submission_id}" data-leadtester="${row.lead_tester}" data-maintester="${row.main_tester}" data-secondarytester="${row.secondary_tester}">
                                <i class="bx bx-pencil"></i> Ubah</a>
                                <a class="dropdown-item delete-data" href="javascript:void(0)" data-id="${data}">
                                <i class="bx bx-trash"></i> Hapus</a>
                            </div>
                        </div>`;
                    }
                },
            ],
            emptyTable: `<img style="width: 20rem; margin: 20px 0;" src="<?= base_url() ?>assets/img/empty-image.svg">
                            <h5>Tidak ada data ditemukan</h5>
                        <p class="text-gray">Belum ada data? Tambah/buat data kamu sekarang!</p>`
        });

        return tblData;
    }
</script>
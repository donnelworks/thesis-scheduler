<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script type="text/javascript">
    $(document).ready(() => {

        var SUBMIT_ACTION;

        loadTable();

        // Select
        $(".select").select2({
            theme: "bootstrap4",
        });

        // Add Modal
        $(document).on('click', '.btn-add', function() {
            SUBMIT_ACTION = "create";
            removeInvalidValidation();
            $('#formData').trigger('reset');
            $('#formData .select').val("").trigger('change.select2');
            $('#mdlFormData .modal-title').text("Tambah Data");
            $('#mdlFormData .btn-submit').text("Simpan");
            $('#mdlFormData').modal({
                backdrop: 'static'
            });
            $('#mdlFormData').on('shown.bs.modal', function() {
                $('#nim').focus();
            });
        });

        // Edit Modal
        $(document).on('click', '.edit-data', function() {
            let data = $(this).data();
            $('#id').val(data.id);
            $('#nim').val(data.nim);
            $('#name').val(data.name);
            $('#address').val(data.address);
            $('#phone').val(data.phone);
            $('#studyProgram').val(data.study).trigger('change.select2');
            $('#classroom').val(data.class).trigger('change.select2');

            SUBMIT_ACTION = "update";
            $('#mdlFormData .modal-title').text("Ubah Data");
            $('#mdlFormData .btn-submit').text("Ubah");
            $('#mdlFormData').modal({
                backdrop: 'static'
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
            let req = requestAjax('<?= site_url('colleger/submit_data') ?>', `${$(this).serialize()}&submit_action=${SUBMIT_ACTION}`);
            req.done((res) => {
                if (res.success) {
                    reloadDatatable('#tblData');
                    removeInvalidValidation();
                    $('#nim').focus();
                    $('#formData').trigger('reset');
                    $('#formData .select').val("").trigger('change.select2');
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
            let req = requestAjax('<?= site_url('colleger/delete_data') ?>', $(this).serialize());
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

    });

    function loadTable() {
        let tblData = $('#tblData').datatable({
            url: "<?= site_url('colleger/load_table') ?>",
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
                [7, 'asc'],
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
                    data: 'nim',
                    className: 'min-tablet-l text-truncate-dt'
                },
                {
                    data: 'name',
                    className: 'all text-truncate-dt'
                },
                {
                    data: 'address',
                    className: 'min-tablet-l text-truncate-dt',
                    render: function(data) {
                        return data ?? "-";
                    }
                },
                {
                    data: 'phone',
                    className: 'min-tablet-l text-truncate-dt',
                    render: function(data) {
                        return data ?? "-";
                    }
                },
                {
                    data: 'study_program_name',
                    className: 'min-tablet-l text-truncate-dt'
                },
                {
                    data: 'classroom_name',
                    className: 'min-tablet-l text-truncate-dt'
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
                                <a class="dropdown-item edit-data" href="javascript:void(0)" data-id="${data}" data-nim="${row.nim}" data-name="${row.name}" data-address="${row.address}" data-phone="${row.phone}" data-study="${row.study_program_id}" data-class="${row.classroom_id}">
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
<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script type="text/javascript">
    $(document).ready(() => {

        loadTable();

        // Select
        $(".select").select2({
            theme: "bootstrap4",
        });

        // Add Data
        $(document).on('click', '.btn-add', function() {
            window.location.href = "<?= site_url('submission/create') ?>";
        });

        // Delete Modal
        $(document).on('click', '.delete-data', function() {
            let data = $(this).data();
            $('#deleteKey').val(data.id);
            $('#mdlDelete').modal();
        });

        // Delete
        $(document).on('submit', '#formDelete', function(e) {
            e.preventDefault();

            loadingScreenOn();
            let req = requestAjax('<?= site_url('submission/delete_data') ?>', $(this).serialize());
            req.done((res) => {
                if (res.success) {
                    reloadDatatable('#tblData');
                    removeInvalidValidation();
                    $('#formDelete').trigger('reset');
                    $('#mdlDelete').modal('hide');
                    $('.btn-add').prop('disabled', false);
                    toast("success", res.data.message);
                }
            }).always(() => {
                loadingScreenOff();
            });
        });

    });

    function loadTable() {
        let tblData = $('#tblData').datatable({
            url: "<?= site_url('submission/load_table') ?>",
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
                [8, 'asc'],
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
                    data: 'status',
                    className: 'min-tablet-l text-truncate-dt',
                    render: function(data) {
                        return (data === "0" ? '<span class="badge bg-soft-warning">Pengajuan</span>' : (data === "1" ? '<span class="badge bg-soft-success">Disetujui</span>' : (data === "2" ? '<span class="badge bg-soft-info">Revisi</span>' : '<span class="badge bg-soft-dark">Ditolak</span>')))
                    }
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
                    data: 'title',
                    className: 'min-tablet-l text-truncate-dt'
                },
                {
                    data: 'study_program_name',
                    className: 'min-tablet-l text-truncate-dt'
                },
                {
                    data: 'main_lecturer_name',
                    className: 'none'
                },
                {
                    data: 'secondary_lecturer_name',
                    className: 'none'
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
                                <a class="dropdown-item detail-data" href="submission/detail/${data}" data-id="${data}">
                                <i class="bx bx-search"></i> Detail</a>
                                ${row.status === "0" ?
                                `<div class="dropdown-divider"></div>
                                <a class="dropdown-item delete-data" href="javascript:void(0)" data-id="${data}">
                                <i class="bx bx-trash"></i> Hapus</a>` : ''}
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
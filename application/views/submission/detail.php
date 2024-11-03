<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center mb-2">
            <div class="col-md-8">
                <a href="<?= site_url('submission') ?>" class="text-muted">Daftar Pengajuan</a>
                <h1 class="m-0 font-weight-bold"><?= $title ?></h1>
            </div>
        </div>
    </div>
</div>

<!-- Content Body -->
<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <?php if ($this->app->user()->role === "2") { ?>
                    <div class="alert rounded-lg <?= ($data->status === "0" ? 'alert-info' : ($data->status === "1" ? 'alert-success' : ($data->status === "2" ? 'alert-warning' : 'alert-dark'))) ?>" data-file="<?= $data->submission_form ?>" <?= $data->submission_form !== NULL ? '' : 'disabled' ?>>
                        <i class="icon <?= ($data->status === "0" ? 'fas fa-info' : ($data->status === "1" ? 'fas fa-check' : ($data->status === "2" ? 'fas fa-exclamation-triangle' : 'fas fa-ban'))) ?>"></i>
                        <?= ($data->status === "0" ? 'Pengajuan Anda sedang dalam proses.' : ($data->status === "1" ? 'Selamat! Pengajuan Anda sudah disetujui.' : ($data->status === "2" ? 'Pengajuan Anda telah direvisi. Silahkan ajukan kembali setelah direvisi sesuai arahan/catatan.' : 'Mohon maaf, pengajuan Anda ditolak.'))) ?>
                    </div>
                <?php } ?>
                <div class="card shadow-none rounded-lg border pt-2">
                    <form id="formData" autocomplete="off" enctype="multipart/form-data">
                        <?php if ($this->app->user()->role === "1") { ?>
                            <div class="sticky-top">
                                <div class="card-header bg-white" hidden>
                                    <p class="m-0"><a href="<?= site_url('submission') ?>" class="text-muted">Daftar Pengajuan</a></p>
                                    <h3 class="card-title font-weight-bold"><?= $title ?></h3>
                                </div>
                                <div class="card-body bg-white border-bottom">
                                    <button type="submit" class="btn btn-secondary btn-lg rounded btn-save"><i class="bx bx-save"></i> Ubah Status Pengajuan</button>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($data->status === "2" && $this->app->user()->role === "2") { ?>
                            <div class="sticky-top">
                                <div class="card-header bg-white" hidden>
                                    <p class="m-0"><a href="<?= site_url('submission') ?>" class="text-muted">Daftar Pengajuan</a></p>
                                    <h3 class="card-title font-weight-bold"><?= $title ?></h3>
                                </div>
                                <div class="card-body bg-white border-bottom">
                                    <button type="submit" class="btn btn-secondary btn-lg rounded btn-save"><i class="bx bx-paper-plane"></i> Buat Pengajuan Kembali</button>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if ($data->status === "2" && $this->app->user()->role === "2") { ?>
                            <div class="card-body border-bottom">
                                <label>Catatan Revisi:</label>
                                <p class="m-0"><?= $data->status_notes !== NULL ? nl2br($data->status_notes) : "-" ?></p>
                            </div>
                        <?php } ?>
                        <?php if ($this->app->user()->role === "1") { ?>
                            <div class="card-body border-bottom">
                                <label>Status Pengajuan:</label>
                                <div class="form-group clearfix">
                                    <div class="d-block m-0">
                                        <div class="icheck-primary d-inline mr-3">
                                            <input type="radio" id="radioConfirmedSubmission" name="status" value="1" <?= $data->status === "1" ? 'checked' : '' ?>>
                                            <label for="radioConfirmedSubmission">Disetujui
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline mr-3">
                                            <input type="radio" id="radioRevisedSubmission" name="status" value="2" <?= $data->status === "2" ? 'checked' : '' ?>>
                                            <label for="radioRevisedSubmission">Direvisi
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioRejectedSubmission" name="status" value="3" <?= $data->status === "3" ? 'checked' : '' ?>>
                                            <label for="radioRejectedSubmission">Ditolak
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label>Catatan Revisi:</label>
                                    <textarea name="status_notes" id="statusNotes" class="form-control bg-light rounded" rows="3" maxlength="200"><?= $data->status_notes ?></textarea>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="card-body">
                            <input type="hidden" name="id" id="id" value="<?= $data->id ?>" readonly>
                            <div class="form-group">
                                <label>Judul Skripsi/Tugas Akhir</label>
                                <?php if ($data->status !== "2") { ?>
                                    <h4 class="m-0"><strong><?= $data->title ?></strong></h4>
                                <?php } else { ?>
                                    <input type="text" value="<?= $data->title ?>" name="title" id="title" class="form-control form-control-lg form-control-border bg-light rounded-0" maxlength="100">
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Pembimbing Utama</label>
                                    <?php if ($data->status !== "2") { ?>
                                        <p class="m-0"><?= $data->main_lecturer_name ?></p>
                                    <?php } else { ?>
                                        <select name="main_lecturer" id="mainLecturer" class="form-control rounded bg-light select">
                                            <option value="">Pilih Pembimbing Utama</option>
                                            <?php foreach ($lectures->result() as $lecturer) { ?>
                                                <option value="<?= $lecturer->id ?>" <?= $data->main_lecturer === $lecturer->id ? 'selected' : '' ?>><?= $lecturer->name ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Pembimbing Pendamping</label>
                                    <?php if ($data->status !== "2") { ?>
                                        <p class="m-0"><?= $data->secondary_lecturer_name ?></p>
                                    <?php } else { ?>
                                        <select name="secondary_lecturer" id="secondaryLecturer" class="form-control rounded bg-light select">
                                            <option value="">Pilih Pembimbing Pendamping</option>
                                            <?php foreach ($lectures->result() as $lecturer) { ?>
                                                <option value="<?= $lecturer->id ?>" <?= $data->secondary_lecturer === $lecturer->id ? 'selected' : '' ?>><?= $lecturer->name ?></option>
                                            <?php } ?>
                                        </select>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>No. Tlp.</label>
                                    <?php if ($data->status !== "2") { ?>
                                        <p class="m-0"><?= $data->phone ?></p>
                                    <?php } else { ?>
                                        <input type="text" value="<?= $data->phone ?>" name="phone" id="phone" class="form-control bg-light rounded" maxlength="20">
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Formulir Pengajuan</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->submission_form !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->submission_form ?>" <?= $data->submission_form !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->submission_form !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->submission_form !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedSubmissionForm" name="submission_form_status" checked>
                                                <label for="radioConfirmedSubmissionForm">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedSubmissionForm" name="submission_form_status">
                                                <label for="radioRejectedSubmissionForm">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->submission_form_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="submission_form" class="custom-file-input" id="submissionForm" accept=".pdf">
                                            <label class="custom-file-label" id="labelSubmissionForm" for="submissionForm">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>KTM</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->ktm !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->ktm ?>" <?= $data->ktm !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->ktm !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->ktm !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedKTM" name="ktm_status" checked>
                                                <label for="radioConfirmedKTM">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedKTM" name="ktm_status">
                                                <label for="radioRejectedKTM">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->ktm_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="ktm" class="custom-file-input" id="ktm" accept=".pdf,.jpg,.jpeg,.png">
                                            <label class="custom-file-label" id="labelKTM" for="ktm">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>KTP</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->ktp !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->ktp ?>" <?= $data->ktp !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->ktp !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->ktp !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedKTP" name="ktp_status" checked>
                                                <label for="radioConfirmedKTP">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedKTP" name="ktp_status">
                                                <label for="radioRejectedKTP">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->ktp_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="ktp" class="custom-file-input" id="ktp" accept=".pdf,.jpg,.jpeg,.png">
                                            <label class="custom-file-label" id="labelKTP" for="ktp">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Kartu Rencana Studi (KRS)</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->krs !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->krs ?>" <?= $data->krs !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->krs !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->krs !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedKRS" name="krs_status" checked>
                                                <label for="radioConfirmedKRS">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedKRS" name="krs_status">
                                                <label for="radioRejectedKRS">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->krs_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="krs" class="custom-file-input" id="krs" accept=".pdf,.jpg,.jpeg,.png">
                                            <label class="custom-file-label" id="labelKRS" for="krs">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Buku bimbingan Tugas Akhir</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->ta_guide_book !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->ta_guide_book ?>" <?= $data->ta_guide_book !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->ta_guide_book !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->ta_guide_book !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedTaGuideBook" name="ta_guide_book_status" checked>
                                                <label for="radioConfirmedTaGuideBook">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedTaGuideBook" name="ta_guide_book_status">
                                                <label for="radioRejectedTaGuideBook">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->ta_guide_book_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="ta_guide_book" class="custom-file-input" id="taGuideBook" accept=".pdf">
                                            <label class="custom-file-label" id="labelTaGuideBook" for="taGuideBook">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Transkrip Nilai Sementara</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->temp_transcripts !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->temp_transcripts ?>" <?= $data->temp_transcripts !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->temp_transcripts !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->temp_transcripts !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedTempTranscripts" name="temp_transcripts_status" checked>
                                                <label for="radioConfirmedTempTranscripts">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedTempTranscripts" name="temp_transcripts_status">
                                                <label for="radioRejectedTempTranscripts">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->temp_transcripts_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="temp_transcripts" class="custom-file-input" id="tempTranscripts" accept=".pdf">
                                            <label class="custom-file-label" id="labelTempTranscripts" for="tempTranscripts">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Berita Acara Ujian Komprehensif</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->comprehensive_exam_ba !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->comprehensive_exam_ba ?>" <?= $data->comprehensive_exam_ba !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->comprehensive_exam_ba !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->comprehensive_exam_ba !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedComprehensiveExamBa" name="comprehensive_exam_ba_status" checked>
                                                <label for="radioConfirmedComprehensiveExamBa">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedComprehensiveExamBa" name="comprehensive_exam_ba_status">
                                                <label for="radioRejectedComprehensiveExamBa">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->comprehensive_exam_ba_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="comprehensive_exam_ba" class="custom-file-input" id="comprehensiveExamBa" accept=".pdf">
                                            <label class="custom-file-label" id="labelComprehensiveExamBa" for="comprehensiveExamBa">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Berita Acara Seminar Hasil</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->seminar_result_ba !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->seminar_result_ba ?>" <?= $data->seminar_result_ba !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->seminar_result_ba !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->seminar_result_ba !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedSeminarResultBa" name="seminar_result_ba_status" checked>
                                                <label for="radioConfirmedSeminarResultBa">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedSeminarResultBa" name="seminar_result_ba_status">
                                                <label for="radioRejectedSeminarResultBa">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->seminar_result_ba_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="seminar_result_ba" class="custom-file-input" id="seminarResultBa" accept=".pdf,.jpg,.jpeg,.png">
                                            <label class="custom-file-label" id="labelSeminarResultBa" for="seminarResultBa">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sertifikat PBAK</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->pbak_certificate !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->pbak_certificate ?>" <?= $data->pbak_certificate !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->pbak_certificate !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->pbak_certificate !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedPbakCertificate" name="pbak_certificate_status" checked>
                                                <label for="radioConfirmedPbakCertificate">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedPbakCertificate" name="pbak_certificate_status">
                                                <label for="radioRejectedPbakCertificate">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->pbak_certificate_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="pbak_certificate" class="custom-file-input" id="pbakCertificate" accept=".pdf,.jpg,.jpeg,.png">
                                            <label class="custom-file-label" id="labelPbakCertificate" for="pbakCertificate">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sertifikat TOEFL Skor 400</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->toefl_certificate !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->toefl_certificate ?>" <?= $data->toefl_certificate !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->toefl_certificate !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->toefl_certificate !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <!-- <?php if ($this->app->user()->role === "1") { ?>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline mr-3">
                                                <input type="radio" id="radioConfirmedToeflCertificate" name="toefl_certificate_status" checked>
                                                <label for="radioConfirmedToeflCertificate">Disetujui
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioRejectedToeflCertificate" name="toefl_certificate_status">
                                                <label for="radioRejectedToeflCertificate">Direvisi
                                                </label>
                                            </div>
                                        </div>
                                    <?php } ?> -->
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->toefl_certificate_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="toefl_certificate" class="custom-file-input" id="toeflCertificate" accept=".pdf">
                                            <label class="custom-file-label" id="labelToeflCertificate" for="toeflCertificate">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sertifikat TOAFL</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->toafl_certificate !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->toafl_certificate ?>" <?= $data->toafl_certificate !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->toafl_certificate !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->toafl_certificate !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->toafl_certificate_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="toafl_certificate" class="custom-file-input" id="toaflCertificate" accept=".pdf">
                                            <label class="custom-file-label" id="labelToaflCertificate" for="toaflCertificate">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Bukti Hafalan</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->proof_of_memorization !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->proof_of_memorization ?>" <?= $data->proof_of_memorization !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->proof_of_memorization !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->proof_of_memorization !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->proof_of_memorization_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="proof_of_memorization" class="custom-file-input" id="proofOfMemorization" accept=".pdf">
                                            <label class="custom-file-label" id="labelProofOfMemorization" for="proofOfMemorization">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sertifikat IT</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->it_certificate !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->it_certificate ?>" <?= $data->it_certificate !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->it_certificate !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->it_certificate !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->it_certificate_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="it_certificate" class="custom-file-input" id="itCertificate" accept=".pdf">
                                            <label class="custom-file-label" id="labelItCertificate" for="itCertificate">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Sertifikat KUKERTA</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->kukerta_certificate !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->kukerta_certificate ?>" <?= $data->kukerta_certificate !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->kukerta_certificate !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->kukerta_certificate !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->kukerta_certificate_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="kukerta_certificate" class="custom-file-input" id="kukertaCertificate" accept=".pdf">
                                            <label class="custom-file-label" id="labelKukertaCertificate" for="kukertaCertificate">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Surat Bebas Laboratorium Fakultas Sains</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->free_lab !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->free_lab ?>" <?= $data->free_lab !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->free_lab !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->free_lab !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->free_lab_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="free_lab" class="custom-file-input" id="freeLab" accept=".pdf">
                                            <label class="custom-file-label" id="labelFreeLab" for="freeLab">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Bukti Turnitin</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->turnitin !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->turnitin ?>" <?= $data->turnitin !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->turnitin !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->turnitin !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->turnitin_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="turnitin" class="custom-file-input" id="turnitin" accept=".pdf">
                                            <label class="custom-file-label" id="labelTurnitin" for="turnitin">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Draft TA yang disetujui pembimbing</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->draft_ta !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->draft_ta ?>" <?= $data->draft_ta !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->draft_ta !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->draft_ta !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->draft_ta_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="draft_ta" class="custom-file-input" id="draftTa" accept=".pdf">
                                            <label class="custom-file-label" id="labelDraftTa" for="draftTa">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>LOA e-journal (skema TA skripsi)</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->loa_thesis !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->loa_thesis ?>" <?= $data->loa_thesis !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->loa_thesis !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->loa_thesis !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->loa_thesis_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="loa_thesis" class="custom-file-input" id="loaThesis" accept=".pdf">
                                            <label class="custom-file-label" id="labelLoaThesis" for="loaThesis">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>LOA e-journal (skema TA non skripsi/jurnal)</label>
                                    <div class="alert preview-data rounded-lg border-dashed <?= $data->loa_non_thesis !== NULL ? 'alert-info border-info' : 'alert-dark border-dark' ?>" data-file="<?= $data->loa_non_thesis ?>" <?= $data->loa_non_thesis !== NULL ? '' : 'disabled' ?>>
                                        <i class="icon <?= $data->loa_non_thesis !== NULL ? 'fa fa-search' : 'fas fa-exclamation-triangle' ?>"></i>
                                        <?= $data->loa_non_thesis !== NULL ? 'Lihat File' : 'File Tidak Tersedia' ?>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->loa_non_thesis_status === "0") { ?>
                                        <div class="custom-file">
                                            <input type="file" name="loa_non_thesis" class="custom-file-input" id="loaNonThesis" accept=".pdf">
                                            <label class="custom-file-label" id="labelLoaNonThesis" for="loaNonThesis">Cari File</label>
                                        </div>
                                        <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="form-group">
                                <label>Jurnal Publikasi (bagi skema TA non skripsi)</label>
                                <?php if ($data->status !== "2") { ?>
                                    <p class="m-0"><?= $data->publication_journal ?? "-" ?></p>
                                <?php } else { ?>
                                    <p>Tuliskan:</p>
                                    <ol>
                                        <li>
                                            <strong>Informasi publikasi jurnal</strong> (nama jurnal, vol, halaman, indeksasi jurnal dll)
                                        </li>
                                        <li>
                                            <strong>Penulis artikel</strong> (penulis pertama, kedua, dst)
                                        </li>
                                    </ol>
                                    <textarea name="publication_journal" id="publicationJournal" class="form-control bg-light rounded" rows="3" maxlength="200"><?= $data->publication_journal ?></textarea>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <?php $this->load->view('_part/modal/success_modal'); ?>
</section>
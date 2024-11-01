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
                <div class="card shadow-none rounded-lg border pt-2">
                    <form id="formData" autocomplete="off" enctype="multipart/form-data">
                        <?php if ($data->status === "2") { ?>
                            <div class="sticky-top">
                                <div class="card-header bg-white" hidden>
                                    <p class="m-0"><a href="<?= site_url('submission') ?>" class="text-muted">Daftar Pengajuan</a></p>
                                    <h3 class="card-title font-weight-bold"><?= $title ?></h3>
                                </div>
                                <div class="card-body bg-white border-bottom">
                                    <button type="submit" class="btn btn-secondary btn-lg rounded btn-save"><i class="bx bx-paper-plane"></i> Buat Pengajuan</button>
                                </div>
                            </div>
                        <?php } ?>
                        <div class="card-body">
                            <input type="hidden" name="id" id="id" value="<?= $data->id ?>" readonly>
                            <div class="form-group">
                                <label>Judul Skripsi/Tugas Akhir</label>
                                <h4 class="m-0"><strong><?= $data->title ?></strong></h4>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Pembimbing Utama</label>
                                    <p class="m-0"><?= $data->main_lecturer_name ?></p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Pembimbing Pendamping</label>
                                    <p class="m-0"><?= $data->secondary_lecturer_name ?></p>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>No. Tlp.</label>
                                    <p class="m-0"><?= $data->phone ?></p>
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
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline mr-3">
                                            <input type="radio" id="radioPrimary1" name="r1" checked="">
                                            <label for="radioPrimary1">Disetujui
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary2" name="r1">
                                            <label for="radioPrimary2">Direvisi
                                            </label>
                                        </div>
                                    </div>
                                    <?php if ($this->app->user()->role === "2" && $data->status === "2" && $data->submission_form_status === "1") { ?>
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
                                    <?php if ($data->ktm_status === "1") { ?>
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
                                    <?php if ($data->ktp_status === "1") { ?>
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
                                    <?php if ($data->krs_status === "1") { ?>
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
                                    <?php if ($data->ta_guide_book_status === "1") { ?>
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
                                    <?php if ($data->temp_transcripts_status === "1") { ?>
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
                                    <?php if ($data->comprehensive_exam_ba_status === "1") { ?>
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
                                    <?php if ($data->seminar_result_ba_status === "1") { ?>
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
                                    <?php if ($data->pbak_certificate_status === "1") { ?>
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
                                    <?php if ($data->toefl_certificate_status === "1") { ?>
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
                                    <?php if ($data->toafl_certificate_status === "1") { ?>
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
                                    <?php if ($data->proof_of_memorization_status === "1") { ?>
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
                                    <?php if ($data->it_certificate_status === "1") { ?>
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
                                    <?php if ($data->kukerta_certificate_status === "1") { ?>
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
                                    <?php if ($data->free_lab_status === "1") { ?>
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
                                    <?php if ($data->turnitin_status === "1") { ?>
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
                                    <?php if ($data->draft_ta_status === "1") { ?>
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
                                    <?php if ($data->loa_thesis_status === "1") { ?>
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
                                    <?php if ($data->loa_non_thesis_status === "1") { ?>
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
                                <p class="m-0"><?= $data->publication_journal ?? "-" ?></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
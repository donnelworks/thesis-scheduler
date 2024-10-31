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
                <div class="card shadow-none rounded-lg border">
                    <div class="card-body">
                        <div class="alert alert-primary rounded-lg">
                            <ol style="list-style-type:upper-alpha; font-weight:700;  padding-left: 20px;">
                                <li>Persyaratan Akademik</li>
                                <ol style="font-weight:400; padding-left: 15px;">
                                    <li>Berstatus sebagai mahasiswa pada tahun akademik bersangkutan.</li>
                                    <li>Mahasiswa telah menyelesaikan mata kuliah minimal 110 sks dengan indeks prestasi kumulatif minimal 2,75; (Lampirkan transkrip nilai sementara).</li>
                                    <li>Tidak ada nilai akhir TL dari minimal 110 sks yang telah diambil.</li>
                                    <li>Total SKS dengan nilai C- tidak lebih dari 10% dari beban kredit total atau setara dengan 11 SKS.</li>
                                </ol>

                                <li>Persyaratan Administratif</li>
                                <ol style="font-weight:400; padding-left: 15px;">
                                    <li>Berstatus sebagai mahasiswa pada tahun akademik bersangkutan.</li>
                                    <li>Mahasiswa telah menyelesaikan mata kuliah minimal 110 sks dengan indeks prestasi kumulatif minimal 2,75; (Lampirkan transkrip nilai sementara).</li>
                                    <li>Tidak ada nilai akhir TL dari minimal 110 sks yang telah diambil.</li>
                                    <li>Total SKS dengan nilai C- tidak lebih dari 10% dari beban kredit total atau setara dengan 11 SKS.</li>
                                </ol>
                            </ol>
                        </div>
                    </div>
                    <form id="formData" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" readonly>
                        <div class="card-body border-top">
                            <div class="form-group">
                                <label>Judul Skripsi/Tugas Akhir</label>
                                <input type="text" name="title" id="title" class="form-control form-control-lg form-control-border bg-light rounded-0" maxlength="100">
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Pembimbing Utama</label>
                                    <select name="main_lecturer" id="mainLecturer" class="form-control rounded bg-light select">
                                        <option value="">Pilih Pembimbing Utama</option>
                                        <?php foreach ($lectures->result() as $lecturer) { ?>
                                            <option value="<?= $lecturer->id ?>"><?= $lecturer->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Pembimbing Pendamping</label>
                                    <select name="secondary_lecturer" id="secondaryLecturer" class="form-control rounded bg-light select">
                                        <option value="">Pilih Pembimbing Pendamping</option>
                                        <?php foreach ($lectures->result() as $lecturer) { ?>
                                            <option value="<?= $lecturer->id ?>"><?= $lecturer->name ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>No. Tlp.</label>
                                    <input type="text" name="phone" id="phone" class="form-control bg-light rounded" maxlength="20">
                                </div>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="form-group">
                                <label>UPLOAD Formulir Pengajuan</label>
                                <div class="custom-file">
                                    <input type="file" name="submission_form" class="custom-file-input" id="submissionForm" accept=".pdf">
                                    <label class="custom-file-label" id="labelSubmissionForm" for="submissionForm">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD KTM</label>
                                <div class="custom-file">
                                    <input type="file" name="ktm" class="custom-file-input" id="ktm" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="custom-file-label" id="labelKTM" for="ktm">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD KTP</label>
                                <div class="custom-file">
                                    <input type="file" name="ktp" class="custom-file-input" id="ktp" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="custom-file-label" id="labelKTP" for="ktp">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Kartu Rencana Studi (KRS) yang mencantumkan mata kuliah Skripsi/Tugas Akhir dan telah ditandatangani oleh pembimbing akademik (wajib terstempel)</label>
                                <div class="custom-file">
                                    <input type="file" name="krs" class="custom-file-input" id="krs" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="custom-file-label" id="labelKRS" for="krs">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Buku bimbingan Tugas Akhir</label>
                                <div class="custom-file">
                                    <input type="file" name="ta_guide_book" class="custom-file-input" id="taGuideBook" accept=".pdf">
                                    <label class="custom-file-label" id="labelTaGuideBook" for="taGuideBook">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Transkrip Nilai Sementara</label>
                                <div class="custom-file">
                                    <input type="file" name="temp_transcripts" class="custom-file-input" id="tempTranscripts" accept=".pdf">
                                    <label class="custom-file-label" id="labelTempTranscripts" for="tempTranscripts">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Berita Acara Ujian Komprehensif</label>
                                <div class="custom-file">
                                    <input type="file" name="comprehensive_exam_ba" class="custom-file-input" id="comprehensiveExamBa" accept=".pdf">
                                    <label class="custom-file-label" id="labelComprehensiveExamBa" for="comprehensiveExamBa">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Berita Acara Ujian Komprehensif</label>
                                <div class="custom-file">
                                    <input type="file" name="comprehensive_exam_ba" class="custom-file-input" id="comprehensiveExamBa" accept=".pdf">
                                    <label class="custom-file-label" id="labelComprehensiveExamBa" for="comprehensiveExamBa">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Berita Acara Seminar Hasil</label>
                                <div class="custom-file">
                                    <input type="file" name="seminar_result_ba" class="custom-file-input" id="seminarResultBa" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="custom-file-label" id="labelSeminarResultBa" for="seminarResultBa">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Sertifikat <span class="text-info">PBAK</span></label>
                                <div class="custom-file">
                                    <input type="file" name="pbak_certificate" class="custom-file-input" id="pbakCertificate" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="custom-file-label" id="labelPbakCertificate" for="pbakCertificate">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF, JPG/JPEG/PNG. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Sertifikat <span class="text-info">TOEFL Skor 400</span></label>
                                <div class="custom-file">
                                    <input type="file" name="toefl_certificate" class="custom-file-input" id="toeflCertificate" accept=".pdf">
                                    <label class="custom-file-label" id="labelToeflCertificate" for="toeflCertificate">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Sertifikat <span class="text-info">TOAFL</span></label>
                                <div class="custom-file">
                                    <input type="file" name="toafl_certificate" class="custom-file-input" id="toaflCertificate" accept=".pdf">
                                    <label class="custom-file-label" id="labelToaflCertificate" for="toaflCertificate">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Bukti Hafalan</label>
                                <div class="custom-file">
                                    <input type="file" name="proof_of_memorization" class="custom-file-input" id="proofOfMemorization" accept=".pdf">
                                    <label class="custom-file-label" id="labelProofOfMemorization" for="proofOfMemorization">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Sertifikat <span class="text-info">IT</span></label>
                                <div class="custom-file">
                                    <input type="file" name="it_certificate" class="custom-file-input" id="itCertificate" accept=".pdf">
                                    <label class="custom-file-label" id="labelItCertificate" for="itCertificate">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD Sertifikat <span class="text-info">KUKERTA</span></label>
                                <div class="custom-file">
                                    <input type="file" name="kukerta_certificate" class="custom-file-input" id="kukertaCertificate" accept=".pdf">
                                    <label class="custom-file-label" id="labelKukertaCertificate" for="kukertaCertificate">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD <span class="text-info">Surat Bebas Laboratorium Fakultas Sains</span></label>
                                <div class="custom-file">
                                    <input type="file" name="free_lab" class="custom-file-input" id="freeLab" accept=".pdf">
                                    <label class="custom-file-label" id="labelFreeLab" for="freeLab">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD bukti cek plagiarism dan similarity melalui Turnitin (maksimal similarity 20%)</label>
                                <div class="custom-file">
                                    <input type="file" name="turnitin" class="custom-file-input" id="turnitin" accept=".pdf">
                                    <label class="custom-file-label" id="labelTurnitin" for="turnitin">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD <span class="text-info">Draft TA yang disetujui pembimbing</span></label>
                                <div class="custom-file">
                                    <input type="file" name="draft_ta" class="custom-file-input" id="draftTa" accept=".pdf">
                                    <label class="custom-file-label" id="labelDraftTa" for="draftTa">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD <span class="text-info">(Letter of Acceptance) LOA e-journal (opsional bagi skema TA skripsi)</span></label>
                                <div class="custom-file">
                                    <input type="file" name="loa_thesis" class="custom-file-input" id="loaThesis" accept=".pdf">
                                    <label class="custom-file-label" id="labelLoaThesis" for="loaThesis">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                            <div class="form-group">
                                <label>UPLOAD <span class="text-info">(Letter of Acceptance) LOA e-journal (Wajib bagi skema TA non skripsi/jurnal)</span></label>
                                <div class="custom-file">
                                    <input type="file" name="loa_non_thesis" class="custom-file-input" id="loaNonThesis" accept=".pdf">
                                    <label class="custom-file-label" id="labelLoaNonThesis" for="loaNonThesis">Cari File</label>
                                </div>
                                <p class="text-muted m-0"><em>Supported File: PDF. Max 10 MB</em></p>
                            </div>
                        </div>
                        <div class="card-body border-top">
                            <div class="form-group">
                                <label>Jurnal Publikasi (bagi skema TA non skripsi)</label>
                                <p>Tuliskan:</p>
                                <ol>
                                    <li>
                                        <strong>Informasi publikasi jurnal</strong> (nama jurnal, vol, halaman, indeksasi jurnal dll)
                                    </li>
                                    <li>
                                        <strong>Penulis artikel</strong> (penulis pertama, kedua, dst)
                                    </li>
                                </ol>
                                <textarea name="publication_journal" id="publicationJournal" class="form-control bg-light rounded" rows="3" maxlength="200"></textarea>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-secondary rounded btn-save"><i class="bx bx-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <?php $this->load->view('_part/modal/delete_modal'); ?>
</section>
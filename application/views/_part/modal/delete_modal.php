<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="modal fade" id="mdlDelete">
    <div class="modal-dialog modal-sm">
        <div class="modal-content rounded-lg">
            <form id="formDelete">
                <div class="modal-body">
                    <h5 class="mb-1 text-center">Hapus data?</h5>
                    <input type="hidden" name="delete_key" id="deleteKey">
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default rounded border-0" data-dismiss="modal">Tidak</button>
                    <button type="submit" id="btnDelete" class="btn btn-secondary rounded">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
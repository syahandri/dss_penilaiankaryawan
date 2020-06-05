</div>
<!-- End of Main Content -->
</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Log Out</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Yakin akan keluar?.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Keluar</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap-->
<script src="<?= base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/js/popper.min.js"></script>
<script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>

<!-- Data Tables -->
<script src="<?= base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/fixedHeader.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/vendor/datatables/fixedColumns.bootstrap4.min.js"></script>


<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Script sb admin-->
<script src="<?= base_url(); ?>assets/js/sb-admin-2.min.js"></script>

<!-- Sweetalert2 -->
<script src="<?= base_url(); ?>assets/js/sweetalert2.all.js"></script>

<!-- Font Awesome -->
<script src="<?= base_url(); ?>assets/vendor/fontawesome-free/js/all.min.js"></script>


<!-- Script data processing -->
<script src="<?= base_url(); ?>assets/js/kriteriaScript.js"></script>
<script src="<?= base_url(); ?>assets/js/subkriteriaScript.js"></script>
<script src="<?= base_url(); ?>assets/js/karyawanScript.js"></script>



<!-- Page level plugins -->
<!-- <script src="vendor/chart.js/Chart.min.js"></script> -->

<!-- Page level custom scripts -->
<!-- <script src="js/demo/chart-area-demo.js"></script> -->
<!-- <script src="js/demo/chart-pie-demo.js"></script> -->

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  let fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  $('#imgFoto').attr('src', fileName);
});
</script>

</body>

</html>
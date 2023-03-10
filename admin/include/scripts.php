<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="../js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="../vendor/chart.js/Chart.min.js"></script>
<script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>
<!--<!-- Page level custom scripts -->
<!--<script src="js/demo/chart-area-demo.js"></script>-->
<!--<script src="js/demo/chart-pie-demo.js"></script>-->

<script>
    async function AsyncAjax(sURL, objData = {}) {
        let responseReturn = "";
        await $.ajax({
            url:        sURL,
            type:       "POST",
            data:       {},
            success:    function(response) {
                responseReturn = response;
            },
            error: function(e) {

            }
        });
        return responseReturn;
    }
</script>
<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();

    });
</script>

<?php

$footer = "
  </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class='scroll-to-top rounded' href='#page-top'>
    <i class='fas fa-angle-up'></i>
  </a>

  <!-- Logout Modal-->
  <div class='modal fade' id='logoutModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog' role='document'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title' id='exampleModalLabel'>ALERT?</h5>
          <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>×</span>
          </button>
        </div>
        <div class='modal-body'>Selectionner 'Deconnexion' si vous avez finis avec cette session.</div>
        <div class='modal-footer'>
          <button class='btn btn-secondary' type='button' data-dismiss='modal'>Annuler</button>
          <a class='btn btn-primary' href='?cl=EmploierControlleur&mt=deconnexionAction'>Deconnexion</a>
        </div>
      </div>
    </div>
  </div>

 <!-- Bootstrap core JavaScript-->
  <script src='Vue/theme/vendor/jquery/jquery.min.js'></script>
  <script src='Vue/theme/vendor/bootstrap/js/bootstrap.bundle.min.js'></script>

  <!-- Core plugin JavaScript-->
  <script src='Vue/theme/vendor/jquery-easing/jquery.easing.min.js'></script>

  <!-- Custom scripts for all pages-->
  <script src='Vue/theme/js/sb-admin-2.min.js'></script>

  <!-- Page level plugins -->
  <script src='Vue/theme/vendor/chart.js/Chart.min.js'></script>

  <!-- Page level custom scripts -->
  <script src='Vue/theme/js/demo/chart-area-demo.js'></script>
  <script src='Vue/theme/js/demo/chart-pie-demo.js'></script>
  <script src='Vue/theme/Vendor/pnotify/dist/pnotify.js'></script>
<script src='Vue/theme/Vendor/pnotify/dist/pnotify.buttons.js'></script>
<script src='Vue/theme/Vendor/pnotify/dist/pnotify.nonblock.js'></script>
<script src='Vue/theme/Vendor/notify/notify.js'></script>

 <!-- Page level plugins -->
  <script src='Vue/theme/vendor/datatables/jquery.dataTables.min.js'></script>
  <script src='Vue/theme/vendor/datatables/dataTables.bootstrap4.min.js'></script>

  <!-- Page level custom scripts -->
  <script src='Vue/theme/js/demo/datatables-demo.js'></script>
  
<script>
  
</script>


</body>

</html>



";

echo $footer;
<footer>
    Copyright © 2018 UJIM - Todos los derechos reservados.
</footer>

<script src="<?= base_url('assets/libs/jquery/jquery.js') ?>"></script>
<script src="<?= base_url('assets/libs/bootstrap-4.1.1-dist/js/bootstrap.min.js') ?>"></script>

<script>
    base_url = '<?= base_url() ?>';
</script>

<?php if ($controller === 'home') { ?>
    <script src="<?= base_url('assets/js/home.js') ?>"></script>
<?php } elseif ($controller === 'register') { ?>
    <script src="<?= base_url('assets/libs/select2/js/select2.min.js') ?>"></script>
    <script src="<?= base_url('assets/libs/select2/js/i18n/es.js') ?>"></script>
    <script src="<?= base_url('assets/libs/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/register.js') ?>"></script>
<?php } elseif ($controller === 'competition') { ?>
    <script src="<?= base_url('assets/js/competition.js') ?>"></script>
<?php } elseif ($controller === 'information') { ?>

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <script type="text/javascript" src="assets/libs/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="assets/libs/datatables/js/dataTables.bootstrap.min.js"></script>

    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="<?= base_url('assets/js/information.js') ?>"></script>
    <script>
        $(function() {
            $('input[type="checkbox"]').bootstrapToggle();
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#table2").DataTable({
            });
            $('input[type="checkbox"]').bootstrapToggle();
        });
    </script>
<?php } elseif ($controller === 'registerHosts') { ?>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="<?php echo base_url('assets/libs/jquery/jquery.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrapV/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables/js/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    <script src="<?= base_url('assets/js/registerHosts.js') ?>"></script>
<?php }elseif ($controller === 'reports') { ?>
    <script src="<?php echo base_url('assets/libs/jquery/jquery.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/jspdf/jspdf.min.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/jspdf/jspdf.plugin.autotable.min.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap-4.1.1-dist/js/bootstrap.min.js')?>"></script>
    <script src="<?= base_url('assets/js/reports.js') ?>"></script>
<?php }elseif ($controller === 'updateUsers') { ?>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script src="<?php echo base_url('assets/libs/jquery/jquery.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrapV/js/bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables/js/jquery.dataTables.min.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/datatables/js/dataTables.bootstrap.min.js')?>"></script>
    <script src="<?php echo base_url('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    <script src="<?= base_url('assets/js/updateUsers.js') ?>"></script>
<?php } ?>


</body>

</html>
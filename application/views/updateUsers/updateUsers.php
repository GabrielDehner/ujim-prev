
    <div class="container">
        <h1>Usuarios Registrados</h1>

        <h3>Person Data</h3>
        <br />

        <br />
        <br />
        <div class="table-responsive">
            <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Apellido</th>
                    <th>Tel&eacute;fono</th>
                    <th>Sexo</th>
                    <th>Fecha Nacimiento</th>
                    <th>Email</th>

                    <th style="width:140px;">Acci&oacute;n</th>
                </tr>
                </thead>

                <tbody id="tbody1">

                <?php
                foreach($usrs as $usr){
                    $idUsr = $usr->idUsr;
                    $name = $usr->name;
                    $surname = $usr->surname;
                    $telephone = $usr->telephone;
                    $sex = $usr->sex;
                    $birthday = $usr->birthday;
                    $email = $usr->email;
                    echo '<tr id=fil"'.$idUsr.'">';
                    echo '<td>'.$name.'</td>';
                    echo '<td>'.$surname.'</td>';
                    echo '<td>'.$telephone.'</td>';
                    echo '<td>'.$sex.'</td>';
                    echo '<td>'.$birthday.'</td>';
                    echo '<td>'.$email.'</td>';
                    echo '<td><div>'.'<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$idUsr."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$idUsr."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'.'</div></td>';

                    echo '</tr>';

                }


                ?>


                </tbody>


                <tfoot>
                <tr>
                    <th>Nombres</th>
                    <th>Apellido</th>
                    <th>Tel&eacute;fono</th>
                    <th>Sexo</th>
                    <th>Fecha Nacimiento</th>
                    <th>Email</th>

                    <th style="width:140px;">Acci&oacute;n</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>



<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Registrar Hospedadores</h3>
            </div>




            <div class="modal-body form">

                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="idUsr" id="idUsr"/>
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Nombres</label>
                            <div class="col-md-9">
                                <input name="name" id="name" placeholder="Nombres" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Apellido</label>
                            <div class="col-md-9">
                                <input name="surname" id="surname" placeholder="Apellido" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Tel&eacute;fono</label>
                            <div class="col-md-9">
                                <input name="telephone" id="telephone" placeholder="Tel&eacute;fono" class="form-control" type="tel">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Sexo</label>
                            <div class="col-md-9">
                                <input name="sex" id="sex" value="0" class="form-control" type="text" required>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Fecha Nacimiento</label>
                            <div class="col-md-9">
                                <input name="birthday" id="birthday" value="0" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" id="email" value="0" class="form-control" type="email">
                                <span class="help-block"></span>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<!--

SELECT h.idHost, h.name, h.surname, ifnull(cons1.cantMujeres,0) cantMujeres, ifnull(cons2.cantHombres,0) cantHombres, ifnull(cons3.cantAmbos,0) cantAmbos
FROM host h
LEFT JOIN (
			SELECT d.quantity cantMujeres, h.idHost
			FROM host h INNER JOIN disponibility d ON h.idHost=d.idHost
			WHERE d.sex='F') cons1 ON cons1.idHost=h.idHost
LEFT JOIN (
			SELECT d.quantity cantHombres, h.idHost
			FROM host h INNER JOIN disponibility d ON h.idHost=d.idHost
			WHERE d.sex='M') cons2 ON cons2.idHost=h.idHost
LEFT JOIN (
			SELECT d.quantity cantAmbos, h.idHost
			FROM host h INNER JOIN disponibility d ON h.idHost=d.idHost
			WHERE d.sex='A') cons3 ON cons3.idHost=h.idHost
-->
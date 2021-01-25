<h1 class="text-center"> Tabla resumen acerca del hospedaje </h1>
<hr>

<div class="container" style="margin-top : 28px">

    <div class="table-responsive">
            <table id="table1" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <td>Apellido y Nombre</td>
                        <td>Sexo</td>
                        <td>Localidad</td>
                        <td>Iglesia</td>
                        <td>Hospedaje</td>
                        <td>Hospedador</td> <!-- Ninguno, o cualquier otro.. ver como hacemos para controlar los lugares!! si por php o por sql-->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($usrsConf as $row){
                            $idUsr=$row->idUsr;
                            $name = ucwords(mb_strtolower($row->name));
                            $surname = ucwords(mb_strtolower($row->surname));
                            $sex = $row->sex;
                            $desccity = ucwords(mb_strtolower($row->desccity));
                            $descchurch = $row->descchurch;
                            $place = $row->bkPlace;
                            $siHost = $row->siHost;
                            $nameh = $row->nameh;
                            $surnameh = $row->surnameh;
                            if($place=='NO') {
                                echo '<tr class="text-danger">';
                            }else{
                                echo '<tr class="text-success">';
                            }
                            echo '<td>'.$surname." ". $name.'</td>';
                            echo '<td id="sex'.$idUsr.'">'.$sex.'</td>';
                            echo '<td>'.$desccity.'</td>';
                            echo '<td>'.$descchurch.'</td>';
                            if($place=='NO') {
                                echo '<td id="place'.$idUsr.'">' . '<input id="ck' . $row->idUsr . '" type="checkbox" 
                                    data-toggle="toggle" 
                                    data-on="Si" 
                                    data-off="No" 
                                    data-onstyle="success" 
                                    data-offstyle="danger">' .$place. '</td>';
                            }else{
                                echo '<td id="place'.$idUsr.'">' . '<input id="ck' . $row->idUsr . '" type="checkbox" checked
                                    data-toggle="toggle" 
                                    data-on="Si" 
                                    data-off="No" 
                                    data-onstyle="success" 
                                    data-offstyle="danger">' .$place. '</td>';
                            }
                            if($place=='NO') {//en realidad hay q hacer con place
                                echo '<td>' . '<select id="select' . $idUsr . '" class="form-control" style="height: 33px; width: 300px;" name="descriptionChurch">';
                                //echo '<option value="'.$siHost.'">Ninguno</option>';
                                if($sex=='F'){
                                    echo '<option value="' . $siHost . '">Ninguno</option>';
                                    foreach($disponibilityF as $disponibF){
                                        $idHostDF = $disponibF->idHost;
                                        $nameDF = $disponibF->name;
                                        $surnameDF = $disponibF->surname;
                                        echo '<option value="'.$idHostDF.'">'.$nameDF.' '.$surnameDF.'</option>';
                                    }
                                }else{
                                    echo '<option value="' . $siHost . '">Ninguno</option>';
                                    foreach($disponibilityM as $disponibM){
                                        $idHostDM = $disponibM->idHost;
                                        $nameDM = $disponibM->name;
                                        $surnameDM = $disponibM->surname;
                                        echo '<option value="'.$idHostDM.'">'.$nameDM.' '.$surnameDM.'</option>';
                                    }
                                }
                            }else{
                                if($siHost=='Ninguno') {
                                    echo '<td>' . '<select disabled id="select' . $idUsr . '" class="form-control" style="height: 33px; width: 300px;" name="descriptionChurch">';
                                    echo '<option value="' . $siHost . '">No hace falta</option>';
                                }else{
                                    echo '<td>' . '<select disabled id="select' . $idUsr . '" class="form-control" style="height: 33px; width: 300px;" name="descriptionChurch">';
                                    echo '<option value="' . $siHost . '">'.$nameh.' '.$surnameh.'</option>';

                                }
                            }


                            echo '</select>';/*aca se deben poner los datos buscando si lodgin,con ese idUsr tiene
                                                o no hospedaje, si es =null entonces ninguno, caso contrario, se pone el nombre*/
                            '</td>';
                            echo '</tr>';
                        }


                    ?>
                </tbody>
            </table>
    </div>

</div>
<br>
<hr>

<h1 class="text-center"> Informaci&oacute;n acerca del hospedaje </h1>
<hr>
<div class="container">
  <h4 align="left"><b>Resumen Hospedaje: Personas que a&uacute;n no tienen lugar</b></h4>
  <div class="table-responsive">
      <table id="table2" class="table table-hover">
        <thead>
          <tr>
            <th>Localidad</th>
            <th>Iglesia</th>
            <th>Cantidad Mujeres</th>
            <th>Cantidad Hombres</th>
            <th>Total</th>
          </tr>
        </thead>
        <tbody>
            <?php
            $totalSinHospedaje=0;
            $MujeresSinHospedaje=0;
            $HombresSinHospedaje=0;
            foreach ($lodging as $row) {
                $city = $row->desccity;
                $church = $row->descchurch;
                $cMuj = $row->mujeres;
                $cHom= $row->hombres;
                $cTot = $cMuj + $cHom;
                $totalSinHospedaje+= $cTot;
                $MujeresSinHospedaje+= $cMuj;
                $HombresSinHospedaje+= $cHom;
                if($cMuj == 0 && $cHom == 0){
                    echo '<tr class="text-success">';//class="text-success"
                }else{
                    echo '<tr>';
                }
                echo '<td>'. $city .'</td>';
                echo '<td>'. $church .'</td>';
                echo '<td>'. $cMuj .'</td>';
                echo '<td>'. $cHom .'</td>';
                echo '<td>'. $cTot .'</td>';
                echo '</tr>';

            }
            echo '<tr>';
            echo '<td>'. ' ' .'</td>';
            echo '<td><b><big>'. ' Total ' .'</big></b></td>';
            echo '<td><b>'. $MujeresSinHospedaje .'</b></td>';
            echo '<td><b>'. $HombresSinHospedaje .'</b></td>';
            echo '<td><b>'. $totalSinHospedaje .'</b></td>';
            echo '</tr>';

            ?>
        </tbody>
      </table>
  </div>
</div>
<p>Cantidad de personas registradas: <?php echo $usrcount->cont; ?></p>

<hr>
<h1 class="text-center"> Informaci&oacute;n Registrados </h1>
<hr>

<?php
/*highlight_string('<?php $cities =' . var_export($cities, true) . ';?>');*/
$i = 0;
while ($i < count($cities)) {
    $idCity = $cities[$i]->idCity;
    $cityAux = $idCity;
    /*echo $cities[$i]->city*/?>

    <p>
        <button class="btn form-control btn-primary" type="button" width="100" data-toggle="collapse"
                data-target="#city<?= $idCity ?>" aria-expanded="false"
                aria-controls="city<?= $idCity ?>">
            <?= strtoupper($cities[$i]->city) ?>
        </button>
    </p>
    <div class="collapse" id="city<?= $idCity?>">
        <div class="card card-body">

            Iglesias
            <?php while ($cityAux == $idCity) { ?>

                <p>
                    <button class="btn btn-success form-control btnCollapseChurch collapsed" data-id="<?= $cities[$i]->idChurch ?>" type="button" data-toggle="collapse"
                            data-target="#church<?= $cities[$i]->idChurch ?>" aria-expanded="false"
                            aria-controls="church<?= $cities[$i]->idChurch ?>">
                        <?= $cities[$i]->church ?>
                    </button>
                </p>
                <div class="collapse collapse-church" id="church<?= $cities[$i]->idChurch ?>">
                    <div class="card card-body">
                        Usuarios
                        <div class="users<?= $cities[$i]->idChurch ?>"></div>
                    </div>
                </div>

            <?php
                $i++;
                if ($i < count($cities)) {
                    $cityAux = $cities[$i]->idCity;
                } else {
                    $cityAux = null;
                }
            } ?>

        </div>
        <!-- /.card-->
    </div>
    <!-- /.collapse-->


<?php }?>


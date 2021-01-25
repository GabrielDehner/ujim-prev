<h1 class="text-center"> Reportes </h1>
<hr>

<div>
    <div class="form-group col-sm-6">
        <label for="city">Realizar el reporte por ciudad</label>
        <select id="city" class="form-control" name="descriptionCity">
    <?php
        foreach($citys as $city){
            echo '<option value="'.$city->idCity.'">'.strtoupper($city->description).'</option>';
        }
    ?>

        </select>
    </div>
    <button type="submit" class="btn btn-success" id="btnGenerate">Generar Reporte</button>
    <br>
    <br>
    <div class="form-group col-sm-6">
        <label for="host">Realizar el reporte por Hospedador/Hospedado</label>
        <select id="host" class="form-control" name="descriptionHost">
            <option value="host">Por orden de Hospedador</option>;
            <option value="lodging">Por orden de Hospedado</option>;

        </select>
    </div>
    <button type="submit" class="btn btn-success" id="btnGenerateHost">Generar Reporte</button>
    <br>
    <br>
</div>


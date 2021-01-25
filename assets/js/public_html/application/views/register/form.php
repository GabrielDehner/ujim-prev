<div class="container mb-3 mt-3">
    <h3>Registrate para venir a la conferencia!</h3>

    <br>

    <form id="form">
        <div class="form-row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre"
                           maxlength="40" required>
                    <div class=""></div>
                </div>
            </div>
            <div class="col-sm">
                <div class="form-group">
                    <label for="surname">Apellido</label>
                    <input type="text" class="form-control" id="surname" name="surname" placeholder="Apellido" required>
                    <div class=""></div>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="col-sm">
                <div class="form-group">
                    <label for="masculino">Sexo</label>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="sex" id="masculino" value="M" checked>
                        <label class="form-check-label" for="masculino">Masculino</label>
                    </div>
                    <div class="form-check ">
                        <input class="form-check-input" type="radio" name="sex" id="femenino" value="F">
                        <label class="form-check-label" for="femenino">Femenino</label>
                    </div>
                </div>
            </div>

            <div class="col-sm">
                <div class="form-group">
                    <label for="birthday">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                    <div class=""></div>
                </div>
            </div>


            <div class="col-sm">
                <div class="form-group">
                    <label for="telephone">Teléfono celular</label>
                    <input type="number" class="form-control" id="telephone" name="telephone"
                           placeholder="p. ej. 3764112233" required>
                    <div class=""></div>
                    <small id="telephoneHelp" class="form-text text-muted">Si no tenés celular agrega el de algún
                        familiar.
                    </small>
                </div>
            </div>
        </div>

        <div class="form-row">
            <div class="col-sm col-md-3">
                <div class="form-group">
                    <label for="country">País</label>
                    <select class="form-control" id="country" name="descriptionCountry"
                            required></select>
                </div>
            </div>
            <div class="col-sm col-md-3">
                <div class="form-group">
                    <label for="province">Provincia</label>
                    <select class="form-control" id="province" name="descriptionProvince" required></select>
                </div>
            </div>
            <div class="col-sm col- col-md-3" id="placeForCity">
                <div class="form-group">
                    <label for="city">Ciudad</label>
                    <select class="form-control" id="city" name="descriptionCity" required></select>
                    <div class=""></div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <img src="./assets/img/procesando1.gif" name="cargandoMail" alt="Procesando" hidden
                 style="width:27px;height:27px;float:left;margin-left: 4px;">
            <input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required
                   onfocus="onFocusEmail()" onblur="onBlurEmail()">
            <div class=""></div>
        </div>


        <div class="form-group">
            <label for="disease">¿Ten&eacute;s alguna enfermedad que requiera alguna atenci&oacute;n especial?</label>
            <input type="text" class="form-control" id="disease" name="disease" placeholder="Informanos... ">
            <div class=""></div>
        </div>
        <br>
        <hr>
        <br>

        <div id="churchGral" class="form-row align-items-center">
            <div class="form-group col-sm">
                <label for="church">Iglesia a la que asistís</label>
                <select id="church" class="form-control" name="descriptionChurch">
                    <?php foreach ($churches as $church) {
                        if ($church->state == 'T') { ?>
                            <option value="<?= $church->idChurch ?>"><?= $church->description ?></option>
                        <?php }
                    } ?>
                </select>
            </div>
            <div class="col-auto church-anda-un-poquito-pa-abajo">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="0" id="churchOtrosCheck">
                    <label class="form-check-label" for="churchOtrosCheck">
                        Otra iglesia
                    </label>
                </div>
            </div>
            <div class="col church-anda-un-poquito-pa-abajo">
                <label class="sr-only" for="churchOtrosInput">Otra iglesia</label>
                <input id="churchOtrosInput" name="descriptionOtros" class="form-control" type="text"
                       placeholder="Especificá el nombre de tu iglesia" disabled required>
            </div>
        </div>

        <label class="placeChurchLabel" style="display: none">Dónde se ubica tu iglesia?</label>
        <div class="form-row placeChurch" style="display: none">
            <div class="col-sm col-md-3">
                <div class="form-group">
                    <label for="countryChurch">País</label>
                    <select class="form-control" id="countryChurch" name="countryChurch"
                            required></select>
                </div>
            </div>
            <div class="col-sm col-md-3">
                <div class="form-group">
                    <label for="provinceChurch">Provincia</label>
                    <select class="form-control" id="provinceChurch" name="provinceChurch" required></select>
                </div>
            </div>
            <div class="col-sm col- col-md-3" id="placeForCityChurch">
                <div class="form-group">
                    <label for="cityChurch">Ciudad</label>
                    <select class="form-control" id="cityChurch" name="cityChurch"></select>
                    <div class=""></div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="ministry1">Ministerios en los que trabaja</label>
            <div class="form-row">
                <div class="col-sm-4 col-lg-3 col-md-3">
                    <?php foreach ($ministries as $index => $ministry) {
                        if ($index < 4) { ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?= $ministry->idMinistry ?>"
                                       id="ministry<?= $index ?>" name="ministry">
                                <label class="form-check-label" for="ministry<?= $index ?>">
                                    <?= $ministry->description ?>
                                </label>
                            </div>
                        <?php }
                    } ?>
                </div>
                <div class="col-sm-6">
                    <?php foreach ($ministries as $index => $ministry) {
                        if ($index > 3) { ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="<?= $ministry->idMinistry ?>"
                                       id="ministry<?= $index ?>" name="ministry">
                                <label class="form-check-label" for="ministry<?= $index ?>">
                                    <?= $ministry->description ?>
                                </label>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
            <div class="form-row align-items-center">
                <div class="col-auto">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="0" id="ministryOtrosCheck"
                               name="ministry">
                        <label class="form-check-label" for="ministryOtrosCheck">
                            Otros
                        </label>
                    </div>
                </div>
                <div class="col">
                    <label class="sr-only" for="ministryOtrosInput">Otros ministerios</label>
                    <input id="ministryOtrosInput" name="descriptionOtros" class="form-control" type="text"
                           placeholder="Especificá otro ministerio" disabled>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="assistance1">A qué conferencias viniste?</label>
            <div class="form-row">
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assistance2" value="2011" name="assistance">
                        <label class="form-check-label" for="assistance2">2011</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assistance3" value="2012" name="assistance">
                        <label class="form-check-label" for="assistance3">2012</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assistance4" value="2013" name="assistance">
                        <label class="form-check-label" for="assistance4">2013</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assistance5" value="2014" name="assistance">
                        <label class="form-check-label" for="assistance5">2014</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assistance6" value="2015" name="assistance">
                        <label class="form-check-label" for="assistance6">2015</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assistance7" value="2016" name="assistance">
                        <label class="form-check-label" for="assistance7">2016</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="assistance8" value="2017" name="assistance">
                        <label class="form-check-label" for="assistance8">2017</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="lodging1">Ya tenés hospedaje?</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="lodging" id="lodging1" value="PO" checked>
                <label class="form-check-label" for="lodging1">
                    Soy de Posadas
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="lodging" id="lodging2" value="SI">
                <label class="form-check-label" for="lodging2">
                    Si
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="lodging" id="lodging3" value="NO">
                <label class="form-check-label" for="lodging3">
                    No
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary" id="btnRegistrar">Registrame!</button>
    </form>
</div>
$(function() {

    // Evento de cuando abro una iglesia asi cargo los usuarios correspondientes
    $('.btnCollapseChurch').on('click', function () {
        if ($(this).hasClass('collapsed')) {
            const idChurch = $(this).data('id');

            $.ajax({
                url: 'information/searchUsrs',
                method: 'POST',
                data: {idChurch},
                dataType: 'json',
                success: function (users) {
                    console.log(users);

                    $(`.users${idChurch}`).html('');

                    let html = `<div class="accordion" id="accordionUsers">`;

                    users.forEach((user, index, array) => {
                        html += `
                            <div class="card" width="100%">
                              <div class="card-header" id="headerUser${user.idUsr}">
                                <h5 class="mb-0">
                                  <button class="btn btn-link collapsed" type="button" data-toggle="collapse" 
                                    data-target="#user${user.idUsr}" aria-expanded="false">
                                    <b><big>${user.surname}, ${user.name}</big></b> <br><i><small><small>(${user.desccity})</small></small></i>
                                  </button>
                                </h5>
                              </div>
                              <div id="user${user.idUsr}" class="collapse" aria-labelledby="headerUser${user.idUsr}" 
                                data-parent="#accordionUsers">
                                <div class="card-body">
                                  
                                  <b>Email:</b> ${user.email} <br>
                                  <b>Teléfono:</b> ${user.telephone} <br>
                                  <b>Sexo:</b> ${user.sex} <br>
                                  <b>Iglesia:</b> ${user.descchurch} <br>
                                  <b>Ciudad:</b> ${user.desccity} <br>
                                  <b>Registro:</b> ${user.log} <br>
                                  <b>Hospedaje:</b>`;
                                  if(user.place=='NO'){
                        html += `<input id="check${user.idUsr}" type="checkbox" 
                                    data-toggle="toggle" 
                                    data-on="Si" 
                                    data-off="No" 
                                    data-onstyle="success" 
                                    data-offstyle="danger">`;
                                  }else{
                        html += `<input id="check${user.idUsr}" type="checkbox" checked 
                                    data-toggle="toggle" 
                                    data-on="Si" 
                                    data-off="No" 
                                    data-onstyle="success" 
                                    data-offstyle="danger">`;
                                  }/*<b>Hospedaje:</b> ${user.place} <br>*/
                        html += `</div>
                              </div>
                            </div>
                        `;
                    });

                    html += `</div>`;

                    $(`.users${idChurch}`).html(html);

                    $('input[type="checkbox"]').bootstrapToggle();
                },
                error: () => {
                }
            });
        }
    });

//estos son los check de abajo, mejor creo q sacar
    $('body').on('change', 'input[type="checkbox"]', function () {
        //console.log($(this).prop('id'));
        idUsr = String($(this).prop('id')).replace("check","");
        var place='NO';
        if($(this).prop('checked')){
          place='SI';

        }
        //console.log(place);
        //console.log(idUsr);
        $.ajax({
                url: 'information/changeValuePlace',
                method: 'POST',
                data: {place, idUsr},
                dataType: 'json'
        });
    });
    $('body').on('change', 'input[type="checkbox"]', function () {
        //console.log($(this).prop('id'));
        idUsr = String($(this).prop('id')).replace("ck","");
        var place='NO';
        if($(this).prop('checked')){
            place='SI';
            //bloqueo del combo
            $("#select"+idUsr).attr('disabled', 'disabled');
        }else{
            $("#select"+idUsr).removeAttr('disabled');
        }
        //console.log(place);
        //console.log(idUsr);
        $.ajax({
            url: 'information/changeValuePlace',
            method: 'POST',
            data: {place, idUsr},
            dataType: 'json'
        });
    });

    $('body').on('change', 'select', function(){
        //alert('ok');
        //aca hay que hacer un alter table para cambiar en lodging,
        //actualizar todos los combos, considerando cada usuario
        //poner un un SI cambiando el valor del check

        var idUsr = String($(this).prop('id')).replace("select","");
        var idHost = $(this).val();
        if(String(idHost)=='0'){
            idHost=null;
            console.log('llego');
        }
        //console.log(valueSelect);

        $('#ck'+idUsr).bootstrapToggle('on');
        $("#select"+idUsr).attr('disabled', 'disabled');


        /*$('#place'+idUsr).html("");
        $('#place'+idUsr).append('<td id="place'+idUsr+'">' + '<input id="ck' +idUsr + '" type="checkbox" checked'+
        'data-toggle="toggle"  data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger">SI</td>');
        $(function() {
            $('#ck'+idUsr).bootstrapToggle();
        })*/

       $.ajax({
            url: 'information/alterLodgingWithHost',
            method: 'POST',
            data: {idUsr, idHost},
            dataType: 'json',

        });



        var x = document.getElementsByTagName("select");
        var i=-1;
        var array=[];
        h=0;
        for(i=0;i<x.length;i++){

            if(!$('#ck'+String(x[i].id).replace("select","")).is(':checked')) {
                //console.log(x[i].id);//actualizar tooodos estos mediante ajax, por eso primero la otra consulta
                array[h]=String(x[i].id).replace("select","");
                h++;
            }

            //muestra todos los de la pagina, pero cuando se apreta el Next, entonces de esa pagina hay que
            //todos los elementos de tipo select hay q actualizarlos si son igual a NO
        }
        array.pop();
        array.shift();
        //console.log(array);
        updateCombos(array);






       /* var idUsr=String($(this).prop('id')).replace("select","");
        var sex=$('#sex'+idUsr).html();
        //$(this).parents("tr").find("td")
        //alert(idUsr);
        //alert(sex);
        $.ajax({
            url: 'information/searchDisponibility',
            method: 'POST',
            data: {sex},
            dataType: 'json',
            success: function (disponibility) {
                $('#select' + idUsr).html('');
                $('#select' + idUsr).append('<option value="Ninguno">Ninguno</option>');
                for(var i=0;i<disponibility.length;i++){

                    // $('#select' + idUsr).html(disponibility[i].name).fadeIn();
                    $('#select' + idUsr).append('<option value='+disponibility[i].idHost+'>'+disponibility[i].name+' '+disponibility[i].surname+'</option>');
                    //console.log(disponibility[i].name);
                }

                console.log(disponibility);
            }
        });*/
    });

    $('#table1').DataTable({

        drawCallback: function(){
            $('.paginate_button', this.api().table().container())
                .on('click', function(){
                    var x = document.getElementsByTagName("select");
                    var array=[];
                    var h=0;
                    for(i=0;i<x.length;i++){

                        if(!$('#ck'+String(x[i].id).replace("select","")).is(':checked')) {

                            array[h]=String(x[i].id).replace("select","");
                            h++;
                        }
                    }
                    //alert("hola2");
                    array.pop();
                    array.shift();
                    updateCombos(array);
                });
            $('.sorting', this.api().table().container())
                .on('click', function(){
                    var x = document.getElementsByTagName("select");
                    var array=[];
                    var h=0;
                    for(i=0;i<x.length;i++){

                        if(!$('#ck'+String(x[i].id).replace("select","")).is(':checked')) {
                            array[h]=String(x[i].id).replace("select","");
                            h++;
                        }
                    }
                    //alert("hola");
                    array.pop();
                    array.shift();
                    updateCombos(array);
                });
                //DataTables_Table_0_previous
        }



    });

    function updateCombos(array){
        //var idUsr=String($(this).prop('id')).replace("select","");
        //var sex=$('#sex'+idUsr).html();
        //$(this).parents("tr").find("td")
        //alert(idUsr);
        //alert(sex);

        ajaxDisponibility(array);

        //ajaxDisponibility2(array);


    }

    function ajaxDisponibility(array){
        sex='M';
        //console.log(sex);
        $.ajax({
            url: 'information/searchDisponibility',
            method: 'POST',
            data: {sex},
            dataType: 'json',
            success: function (disponibility) {
                console.log(array);
                for(var j=0; j<array.length;j++) {
                    sexoArray= String($('#sex'+array[j]).html());
                    //console.log(sexoArray+"=="+sex);
                    //console.log(sex);
                    //console(String("indic j:"+j+" ind i:"+i));
                    console.log(disponibility);
                    if(sexoArray==sex) {
                        //console.log('#select' + array[j]);
                        $('#select' + array[j]).html('');
                        $('#select' + array[j]).append('<option value="Ninguno">Ninguno</option>');
                        for (var i = 0; i < disponibility.length; i++) {
                            $('#select' + array[j]).append('<option value=' + disponibility[i].idHost + '>' + disponibility[i].name + ' ' + disponibility[i].surname + '</option>');
                        }
                    }
                }
                sex='F';
                //console.log(sex);
                $.ajax({
                    url: 'information/searchDisponibility',
                    method: 'POST',
                    data: {sex},
                    dataType: 'json',
                    success: function (disponibility) {
                        //console.log(array);
                        for(var j=0; j<array.length;j++) {
                            sexoArray= String($('#sex'+array[j]).html());
                            //console.log(sexoArray+"=="+sex);
                            //console.log(sex);
                            //console(String("indic j:"+j+" ind i:"+i));

                            if(sexoArray==sex) {
                                console.log('#select' + array[j]);
                                $('#select' + array[j]).html('');
                                $('#select' + array[j]).append('<option value="Ninguno">Ninguno</option>');
                                for (var i = 0; i < disponibility.length; i++) {
                                    $('#select' + array[j]).append('<option value=' + disponibility[i].idHost + '>' + disponibility[i].name + ' ' + disponibility[i].surname + '</option>');
                                }
                            }
                        }

                        //console.log(disponibility);
                    }
                });

                //console.log(disponibility);
            }
        });
    }

    //que en si y no de los check los combos se habiliten o deshabiliten y colores


});


var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({

        "processing": true

    });

    $("#cantMujeres").focus(function(){
        $("#cantAmbos").prop('disabled', true);
        $("#cantAmbos").val(0);
    });
    $("#cantHombres").focus(function(){
        $("#cantAmbos").prop('disabled', true);
        $("#cantAmbos").val(0);
    });
    $("#cantAmbos").focus(function(){
        $("#cantMujeres").prop('disabled', true);
        $("#cantHombres").prop('disabled', true);
        $("#cantMujeres").val(0);
        $("#cantHombres").val(0);
    });

    $("#cantMujeres").blur(function(){
        console.log(String($("#cantMujeres").val()));
        if(String($("#cantMujeres").val())=='0' && String($("#cantHombres").val())=='0'){
            $("#cantAmbos").prop('disabled', false);
        }
    });
    $("#cantHombres").blur(function(){
        if(String($("#cantMujeres").val())=='0' && String($("#cantHombres").val())=='0'){
            $("#cantAmbos").prop('disabled', false);
        }
    });
    $("#cantAmbos").blur(function(){
        if(String($("#cantAmbos").val())=='0'){
            $("#cantMujeres").prop('disabled', false);
            $("#cantHombres").prop('disabled', false);
        }
    });



});



function add_person()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Agregar Hospedadores'); // Set Title to Bootstrap modal title
}

function edit_person(idHost) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "registerHosts/ajax_edit/" + idHost,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="idHost"]').val(data.idHost);
            $('[name="name"]').val(data.name);
            $('[name="surname"]').val(data.surname);
            $('[name="telephone"]').val(data.telephone);
            $('[name="cantMujeres"]').val(data.cantMujeres);
            $('[name="cantHombres"]').val(data.cantHombres);
            $('[name="cantAmbos"]').val(data.cantAmbos);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Hospedador'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}







function reload_table(data){
    //table.ajax.reload(null,false); //reload datatable ajax
    if(save_method == 'update') {
        $('#table').dataTable().fnClearTable();
        //$('')
        //alert($('#tbody1').id);
        //$('#tbody1').append('<div id="dbody1"></div>');

        for (var i = 0; i < data.length; i++) {


            //console.log(data);

            $idHost = data[i].idHost;
            $name = data[i].name;
            $surname = data[i].surname;
            $telephone = data[i].telephone;
            $cantMujeres = data[i].cantMujeres;
            $cantHombres = data[i].cantHombres;
            $cantAmbos = data[i].cantAmbos;

            $('#table').dataTable().fnAddData([
                $name,
                $surname,
                $telephone,
                $cantMujeres,
                $cantHombres,
                $cantAmbos,
                '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' + "'" + $idHost + "'" + ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>' +
                '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' + "'" + $idHost + "'" + ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>']);

            /* $('#tbody1').append(
                 '<tr id=fil"'+$idHost+'">'+
                 '<td>'+$name+'</td>'+
                 '<td>'+$surname+'</td>'+
                 '<td>'+$telephone+'</td>'+
                 '<td>'+$cantMujeres+'</td>'+
                 '<td>'+$cantHombres+'</td>'+
                 '<td>'+$cantAmbos+'</td>'+
                 '<td><div>'+'<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('+"'"+$idHost+"'"+')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>'+
         '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('+"'"+$idHost+"'"+')"><i class="glyphicon glyphicon-trash"></i> Delete</a>'+'</div></td>'+

             '</tr>'
             );*/
        }
    }else{
        $idHost = data.idHost;
        $name = data.name;
        $surname = data.surname;
        $telephone = data.telephone;
        $cantMujeres = data.cantMujeres;
        $cantHombres = data.cantHombres;
        $cantAmbos = data.cantAmbos;

        $('#table').dataTable().fnAddData([
            $name,
            $surname,
            $telephone,
            $cantMujeres,
            $cantHombres,
            $cantAmbos,
            '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' + "'" + $idHost + "'" + ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>' +
            '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' + "'" + $idHost + "'" + ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>']);



    }




}

function save(){
    $("#cantMujeres").prop('disabled', false);
    $("#cantHombres").prop('disabled', false);
    $("#cantAmbos").prop('disabled', false);

    if($('#name').val()!='' && $('#surname').val()!='' && $('#telephone').val()!='' && $('#cantMujeres').val()!='' && $('#cantHombres').val()!='' && $('#cantAmbos').val()!='') {

        $('#btnSave').text('Guardando...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable

        var url;

        if (save_method == 'add') {
            url = "registerHosts/ajax_add";
        } else {
            url = "registerHosts/ajax_update";
        }

        //if(save_method == 'add') {
        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function (data) {


                $('#modal_form').modal('hide');
                reload_table(data);


                $('#btnSave').text('Guardar'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable


            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });
        //}else{
        ///alert($('[name="idHost"]').val());
        /*$('[name="idHost"]').val(data.idHost);
        $('[name="name"]').val(data.name);
        $('[name="surname"]').val(data.surname);
        $('[name="telephone"]').val(data.telephone);
        $('[name="cantMujeres"]').val(data.cantMujeres);
        $('[name="cantHombres"]').val(data.cantHombres);
        $('[name="cantAmbos"]').val(data.cantAmbos);*/
        //}
    }else{
        alert("Complete todos los campos");
    }
}

function delete_person(idHost)
{
    if(confirm('Estas seguro de borrar ese Hospedador?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "registerHosts/ajax_delete/"+idHost,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                save_method = 'update';
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table(data);
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}



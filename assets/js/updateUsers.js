var save_method; //for save method string
var table;

$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({

        "processing": true

    });


});



function add_person()
{
    save_method = 'add';

}

function edit_person(idUsr) {
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

    //Ajax Load data from ajax
    $.ajax({
        url : "UpdateUsers/ajax_edit/" + idUsr,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            //alert(data.email);
            $('[name="idUsr"]').val(data.idUsr);
            $('[name="name"]').val(data.name);
            $('[name="surname"]').val(data.surname);
            $('[name="telephone"]').val(data.telephone);
            $('[name="sex"]').val(data.sex);
            $('[name="email"]').val(data.email);
            $('[name="birthday"]').val(data.birthday);
            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Usuario'); // Set title to Bootstrap modal title

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

            $idUsr = data[i].idUsr;
            $name = data[i].name;
            $surname = data[i].surname;
            $telephone = data[i].telephone;
            $sex = data[i].sex;
            $birthday = data[i].birthday;
            $email = data[i].email;

            $('#table').dataTable().fnAddData([
                $name,
                $surname,
                $telephone,
                $sex,
                $birthday,
                $email,
                '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person(' + "'" + $idUsr + "'" + ')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>' +
                '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person(' + "'" + $idUsr + "'" + ')"><i class="glyphicon glyphicon-trash"></i> Delete</a>']);

        }
    }else{
        alert('Else, no if');


    }




}

function save(){

    if($('#name').val()!='' && $('#surname').val()!='' && $('#telephone').val()!='' && $('#sex').val()!='' && $('#birthday').val()!='' && $('#email').val()!='') {

        $('#btnSave').text('Guardando...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable

        var url;

        if (save_method == 'add') {
            url = "noexiste/ajax_add";
        } else {
            url = "UpdateUsers/ajax_update";
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

    }else{
        alert("Complete todos los campos");
    }
}

function delete_person(idUsr)
{
    if(confirm('Estas seguro de borrar ese Usuario?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "UpdateUsers/ajax_delete/"+idUsr,
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



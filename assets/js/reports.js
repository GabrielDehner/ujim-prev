$(function () { // Cuando el documento esta cargado.


    /*
     * Cuando apreto el boton Generar reporte
     */
    $("#btnGenerate").on("click", function(){
        var idCity=$("#city").val();
        $.ajax({
            url: 'Reports/reportForCity',
            type: "POST",
            dataType: "JSON",
            data: {idCity},
            success: function (data) {
                //console.log(data);
                var pdf = new jsPDF();
                var combo = document.getElementById("city");
                var selected = combo.options[combo.selectedIndex].text;

                //pdf.text(20,20,"Resumen de la ciudad de "+selected+'-'+'Cant Total: '+);

                var columns = ["Apellido", "Nombre", "Sexo", /*"Fecha Nacimiento",*/ "Teléfono" ,"Email"];
                var dato=[];
                //surname, name, sex, birthday, telephone, email
                for(var i=0;i<data.length; i++){
                    dato[i] = new Array(6);
                    dato[i][0] = data[i].surname;
                    dato[i][1] = data[i].name;
                    dato[i][2] = data[i].sex;
                    //dato[i][3] = data[i].birthday;
                    dato[i][3] = data[i].telephone;
                    dato[i][4] = data[i].email;
                }
                pdf.autoTable(columns,dato,
                    { margin:{ top: 25  }}
                );
                $.ajax({
                    url: 'Reports/reportForCityCount',
                    type: "POST",
                    dataType: "JSON",
                    data: {idCity},
                    success: function (data2) {
                        //console.log(data);

                        var combo = document.getElementById("city");
                        var selected = combo.options[combo.selectedIndex].text;
                        //console.log(data2);
                        pdf.text(15,20,"Resumen de la ciudad de "+selected+' -'+' Cant Total: '+data2[0].cant);


                        var d = new Date();
                        pdf.save(selected + String(d.getTime()) + '.pdf');
                    },
                });

            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Error de reporte');


            }
        });
        //alert($("#city").val());
       /* var pdf = new jsPDF();
        pdf.text(20,20,"Mostrando una Tabla con JsPDF y el Plugin AutoTable");
        var columns = ["Id", "Nombre", "Domicilio", "Telefono","Email"];
        var data = [
        <?php foreach($data as $d):?>
        [<?php echo $d->id; ?>, "<?php echo $d->name." ".$d->lastname; ?>", "<?php echo $d->address; ?>", "<?php echo $d->phone; ?>","<?php echo $d->email; ?>"],
    <?php endforeach; ?>
    ];
        pdf.autoTable(columns,data,
            { margin:{ top: 25  }}
        );
        pdf.save('mipdf.pdf');*/
    });

    $("#btnGenerateHost").on("click", function(){
        var orden=$("#host").val();
        if(String(orden)=='lodging') {
            $.ajax({
                url: 'Reports/reportForLodging',
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    var pdf = new jsPDF();


                    pdf.text(20,20,"Resumen por orden de Personas hospedadas");//por orden de hospedadores

                    var columns = ["Apellido", "Nombre", "Sexo", "Fecha Nacimiento", "Teléfono", "Apellido Hosp","Nombre Hosp"];
                    var dato = [];

                    for (var i = 0; i < data.length; i++) {
                        dato[i] = new Array(7);
                        dato[i][0] = data[i].surname;
                        dato[i][1] = data[i].name;
                        dato[i][2] = data[i].sex;
                        dato[i][3] = data[i].birthday;
                        dato[i][4] = data[i].telephone;
                        dato[i][5] = data[i].surnameh;
                        dato[i][6] = data[i].nameh;
                    }
                    pdf.autoTable(columns, dato,
                        {margin: {top: 25}}
                    );
                    var d = new Date();
                    pdf.save(String(orden) + String(d.getTime()) + '.pdf');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error de reporte');


                }
            });
        }else{
            $.ajax({
                url: 'Reports/reportForHost',
                type: "POST",
                dataType: "JSON",
                success: function (data) {
                    var pdf = new jsPDF();


                    pdf.text(20,20,"Resumen por orden de Hospedadores");//por orden de hospedadores

                    var columns = ["Apellido Hosp","Nombre Hosp", "Apellido", "Nombre", "Sexo", "Fecha Nacimiento", "Teléfono"];
                    var dato = [];

                    for (var i = 0; i < data.length; i++) {
                        dato[i] = new Array(7);
                        dato[i][0] = data[i].surnameh;
                        dato[i][1] = data[i].nameh;
                        dato[i][2] = data[i].surname;
                        dato[i][3] = data[i].name;
                        dato[i][4] = data[i].sex;
                        dato[i][5] = data[i].birthday;
                        dato[i][6] = data[i].telephone;

                    }
                    pdf.autoTable(columns, dato,
                        {margin: {top: 25}}
                    );
                    var d = new Date();
                    pdf.save(String(orden) + String(d.getTime()) + '.pdf');
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error de reporte');


                }
            });
        }

    });

    /*
     SELECT us.surname, us.name, us.sex, us.birthday, us.telephone, h.surname surnameh, h.name nameh
     FROM usr us INNER JOIN lodging l ON l.idUsr=us.idUsr
     INNER JOIN host h ON h.idHost=l.idHost
     ORDER BY us.surname, us.name
     */
/*
* SELECT h.surname surnameh, h.name nameh, us.surname, us.name, us.sex, us.birthday, us.telephone
FROM usr us INNER JOIN lodging l ON l.idUsr=us.idUsr
INNER JOIN host h ON h.idHost=l.idHost
ORDER BY h.surname, h.name
* */
});
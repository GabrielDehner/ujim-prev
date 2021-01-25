$(function () { // Cuando el documento esta cargado.

    cityElement = null;

    loadCountries();
    loadProvinces();

    /*
     * Cuando apreto el boton REGISTRARME!
     */
    $("#form").submit(function (e) {
        e.preventDefault();
        $("#form").prop('disabled', true);

        // Campos
        const name = $('#name').val();
        const surname = $('#surname').val();
        const sex = $('input[name=sex]:checked').val();
        const birthday = $('#birthday').val();
        const telephone = $('#telephone').val();
        const email = $('#email').val();
        const disease = $('#disease').val();
        const province = $('#province').val();
        const provinceChurch = $('#provinceChurch').val() || null;
        const city = $('#city').val() || null;
        const cityChurch = $('#cityChurch').val() || null;

        let church = $('#church').val();
        const churchOtrosCheck = $('#churchOtrosCheck').is(':checked');

        if (churchOtrosCheck) {
            church = $('#churchOtrosInput').val();
        }

        const ministry = [];
        let ministryOtros = null;

        $('input[name=ministry]:checked').each(function (index, element) {
            // console.log($(this));
            if ($(this).val() === '0') {
                ministryOtros = $('#ministryOtrosInput').val();
            } else {
                ministry.push($(this).val())
            }
        });

        const assistance = [];

        $('input[name=assistance]:checked').each(function (index, element) {
            assistance.push($(this).val())
        });

        const lodging = $('input[name=lodging]:checked').val();

        // AJAX
        // console.log(name);
        // console.log(surname);
        // console.log(sex);
        // console.log(birthday);
        // console.log(telephone);
        // console.log(email);
        // console.log(province);
        // console.log(city);
        // console.log(church);
        // console.log(ministry);
        // console.log(ministryOtros);
        // console.log(assistance);
        // console.log(lodging);
        // console.log(churchOtrosCheck);

        $.ajax({
            url: 'register/saveData',
            method: 'POST',
            data: {
                name,
                surname,
                sex,
                birthday,
                telephone,
                email,
                disease,
                province,
                provinceChurch,
                city,
                cityChurch,
                church,
                ministry,
                ministryOtros,
                assistance,
                lodging,
                churchOtrosCheck
            },
            success: function (response) {
                // console.log(response);
                swal({
                    title: `Te esperamos ${name}!`,
                    html: `
                            <a href="${base_url}concurso">
                                <img class="img-fluid" src="${base_url}assets/images/promo-concurso.jpeg" />
                            </a>
                            Ya entraste en el concurso? Entrá <a href="${base_url}concurso">aquí</a>
                           `,
                    type: 'success',
                    confirmButtonText: 'Participar!'
                }).then((result) => {
                    window.location.href = base_url + 'concurso';
                });
            },
            error: () => {
                swal({
                    title: `Ups! Hubo un error`,
                    text: '',
                    type: 'error'
                });
            }
        });

        return false;
    });

    /*
     * Cuando apreto el check de Otros, activo o desactivo el input.
     */
    $('#ministryOtrosCheck').change(function () {
        if ($('#ministryOtrosCheck').is(':checked')) {
            $('#ministryOtrosInput').prop('disabled', false);
        } else {
            $('#ministryOtrosInput').prop('disabled', true);
        }
    });

    /*
     * Configuración de ciudad (select2).
     * */
    $("#city").select2({
        id: function (e) {
            return e;
        },
        language: 'es',
        minimumInputLength: 3,
        allowClear: true,
        placeholder: "Ingrese una ciudad para buscar",
        ajax: {
            url: "register/loadCitiesByProvince",
            dataType: 'json',
            type: "POST",
            data: function (params) {
                return {
                    term: params.term,
                    idProvince: document.getElementById("province").value || 1,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.description,
                            id: item.idCity
                        }
                    })
                };
            }
        }
    });

    $("#cityChurch").select2({
        id: function (e) {
            return e;
        },
        language: 'es',
        minimumInputLength: 3,
        allowClear: true,
        placeholder: "Ingrese una ciudad para buscar",
        ajax: {
            url: "register/loadCitiesByProvince",
            dataType: 'json',
            type: "POST",
            data: function (params) {
                return {
                    term: params.term,
                    idProvince: document.getElementById("provinceChurch").value || 1,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.description,
                            id: item.idCity
                        }
                    })
                };
            }
        }
    });

    // Interaccion mas linda..
    $('#name').blur(function () {
        if ($('#name').val().length > 0) {
            $('#name').removeClass('is-invalid').addClass('is-valid');
            $('#name').next().removeClass('invalid-feedback').addClass('valid-feedback').html('Que lindo nombre!');
        } else {
            $('#name').removeClass('is-valid').addClass('is-invalid');
            $('#name').next().removeClass('valid-feedback').addClass('invalid-feedback').html('mmm.. debes de tener un nombre!');
        }
    });

    $('#surname').blur(function () {
        if ($('#surname').val().length > 0) {
            $('#surname').removeClass('is-invalid').addClass('is-valid');
            $('#surname').next().removeClass('invalid-feedback').addClass('valid-feedback').html('Buen apellido!');
        } else {
            $('#surname').removeClass('is-valid').addClass('is-invalid');
            $('#surname').next().removeClass('valid-feedback').addClass('invalid-feedback').html('Creo que falta algo aca..');
        }
    });

    $('#telephone').blur(function () {
        if ($('#telephone').val().length > 0) {
            $('#telephone').removeClass('is-invalid').addClass('is-valid');
            $('#telephone').next().removeClass('invalid-feedback').addClass('valid-feedback').html('Genial!');
        } else {
            $('#telephone').removeClass('is-valid').addClass('is-invalid');
            $('#telephone').next().removeClass('valid-feedback').addClass('invalid-feedback').html('No tenés? Anota el de un familiar o amigo!');
        }
    });

    /*
     * Cuando apreto el check de Otros (church), activo o desactivo el input.
     */
    $('#churchOtrosCheck').change(function () {
        if ($('#churchOtrosCheck').is(':checked')) {
            $('#churchOtrosInput').prop('disabled', false);
            $('#church').prop('disabled', true);

            $('.placeChurchLabel').css('display', 'inline-block');
            $('.placeChurch').css('display', 'flex');
            $('#cityChurch').prop('required', true);
        } else {
            $('#churchOtrosInput').prop('disabled', true);
            $('#church').prop('disabled', false);

            $('.placeChurchLabel').css('display', 'none');
            $('.placeChurch').css('display', 'none');
            $('#cityChurch').prop('required', false);
        }
    });

    $('#country').change(function () {
        const country = $(this).val();

        loadProvinces(country).then((response) => {

            // Si es Paraguay voy a esconder el campo de ciudad.
            if (country === '2') {
                cityElement = $('#city').parent().detach();
            } else {
                if (cityElement)
                    cityElement.appendTo('#placeForCity');
            }

            $('#province').html(''); // Primero vacio el listado asi despues agrego los options.

            $.each(response, function (index, element) {
                $('#province').append(`<option value="${element.idProvince}">${element.description}</option>`);
            });
        });
    });

    $('#countryChurch').change(function () {
        const country = $(this).val();

        loadProvinces(country).then((response) => {

            // Si es Paraguay voy a esconder el campo de ciudad.
            if (country === '2') {
                cityElement = $('#cityChurch').parent().detach();
            } else {
                if (cityElement)
                    cityElement.appendTo('#placeForCityChurch');
            }

            $('#provinceChurch').html(''); // Primero vacio el listado asi despues agrego los options.

            $.each(response, function (index, element) {
                $('#provinceChurch').append(`<option value="${element.idProvince}">${element.description}</option>`);
            });
        });
    });

});

//Metodos Imagenes Mail
function onFocusEmail() {
    var imgMailInputHTML = document.getElementsByName("cargandoMail");
    imgMailInputHTML[0].removeAttribute("hidden");
}

function onBlurEmail() {
    var imgMailInputHTML = document.getElementsByName("cargandoMail");
    imgMailInputHTML[0].setAttribute("hidden", true);

    isEmailValidoAjax();
}

function emailValido(message) {
    $('#email').removeClass('is-invalid').addClass('is-valid');
    $('#email').next().removeClass('invalid-feedback').addClass('valid-feedback').html(message);
}

function emailInvalido(error) {
    $('#email').removeClass('is-valid').addClass('is-invalid');
    $('#email').next().removeClass('is-valid').addClass('invalid-feedback').html(error);
}

function isEmailValidoAjax() {
    $.ajax({
        method: "POST",
        url: "register/emailDisponible", //es un metodo definido en controller Register.php
        data: {
            email: document.getElementsByName("email")[0].value
        },
        dataType: 'json', // Establece el tipo de respuesta (Al poner json, convierte el json en objecto).
        success: (response) => {
            // console.log(response);

            if (response.ok) {
                emailValido(response.message);
            } else {
                emailInvalido(response.error);
            }
        }
    });
}

function loadCountries() {
    $.ajax({
        method: "POST",
        url: "register/loadCountries", //es un metodo definido en controller Register.php
        dataType: 'json',
        success: function (response) {
            $.each(response, function (index, element) {
                $('#country').append(`<option value="${element.idCountry}">${element.description}</option>`);
                $('#countryChurch').append(`<option value="${element.idCountry}">${element.description}</option>`);
            });
        }
    });
}

function loadProvinces(country) {
    return new Promise((resolve) => {
        $.ajax({
            method: "POST",
            url: "register/loadProvinces",
            data: {
                // En el caso que pase algo y no cargue primero los paises sino que cargue primero las provincias
                // entonces si no hay valor en el select country que agarre el 1.
                idCountry: country || 1
            },
            dataType: 'json',
            success: function (response) {

                if (country) {
                    return resolve(response);
                } else {
                    $('#province').html(''); // Primero vacio el listado asi despues agrego los options.
                    $('#provinceChurch').html(''); // Primero vacio el listado asi despues agrego los options.

                    $.each(response, function (index, element) {
                        $('#province').append(`<option value="${element.idProvince}">${element.description}</option>`);
                        $('#provinceChurch').append(`<option value="${element.idProvince}">${element.description}</option>`);
                    });
                }
            }
        });
    });


}
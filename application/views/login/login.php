<div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Iniciar Sesi&oacute;n</h5>
            <hr class='my-4'>
            <form class="form-signin" action ="./Login/verifyUser" method="POST"> 
              <div class="form-label-group">
                <input type="text" id="inputUser" name="username" class="form-control" placeholder="Ingrese su Nombre de Usuario" required autofocus>
                <label for="inputUser">Nombre de Usuario</label>
              </div>
              <br>
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="contrasenia" class="form-control" placeholder="Ingrese su Contraseña" required>
                <label for="inputPassword">Contrase&ntilde;a</label>
              </div>

              <br>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Iniciar Sesi&oacute;n</button>
              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
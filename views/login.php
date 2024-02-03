<div class="row my-5 justify-content-center">
    <div class="col col-md-5">

        <h1 class="text-center mb-5 fw-bold">Inciar Sesión</h1>
        
		<div>
			<?=(new Alerta())->get_alertas(); ?>
		</div>
		<form class="navbar-nav ms-auto header__barra barraFondo2" action="admin/actions/auth_login.php" method="POST">
		<div class="col-12 mb-3">
			<label for="nombre_usuario" class="form-label">Nombre de Usuario</label>
			<input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario">
		</div>

		<div class="col-12 mb-3">
			<label for="pass" class="form-label">Password</label>
			<input type="password" class="form-control" id="pass" name="pass">
		</div>

				<button type="submit" class="btn btn-amarillo">Login</button>
	</form>
            

        </div>


    </div>
</div>
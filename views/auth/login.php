<h1>Login</h1><main class="contenedor seccion contenido-centrado">		<h1>Iniciar Sesion</h1>    <?php foreach ($errores as $e) : ?>				<div class="alerta error">            <?php echo $e; ?>				</div>    <?php endforeach; ?>		<form action="/login" class="formulario" method="POST">				<fieldset>						<legend>Email y Password</legend>						<label for="email">Usuario</label>						<input type="email" placeholder="Tu Email" id="email" name='usuario'>						<label for="password">Password</label>						<input type="password" placeholder="Tu Contraseña" id="password" name='password'>				</fieldset>				<input type="submit" value="Iniciar Sesion" class="boton boton-verde">		</form></main>
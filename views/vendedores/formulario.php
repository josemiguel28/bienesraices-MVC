<fieldset>		<legend>Informacion general</legend>		<label for="nombre">Nombre</label>		<input						type="text"						name="vendedor[nombre]"						id="nombre"						placeholder="Nombre Vendedor"						value="<?php echo s($vendedor->nombre); ?>"						class="<?php echo $readonly ? 'readonly' : ''; ?>"        <?php if ($readonly) {            echo "readonly";        } ?>		/>		<label for="apellido">Apellido</label>		<input						type="text"						name="vendedor[apellido]"						id="apellido"						placeholder="Apellido Vendedor"						value="<?php echo s($vendedor->apellido); ?>"						class="<?php echo $readonly ? 'readonly' : ''; ?>"        <?php if ($readonly) {            echo "readonly";        } ?>		>		<label for="telefono">Telefono</label>		<input						type="tel"						name="vendedor[telefono]"						id="telefono"						placeholder="Telefono"						value="<?php echo s($vendedor->telefono) ?>"						class="<?php echo $readonly ? 'readonly' : ''; ?>"        <?php if ($readonly) {            echo "readonly";        } ?>		>		<label for="imagen">Propiedad(es) asociada(s)</label>		<p class="boton boton-amarillo" style="color: white; display: flex; justify-content: center; width: 50%; margin: 0 auto">Propiedades aún no vendidas</p>				<div class="seccion contenedor contenedor-anuncios">				        <?php if (!$propiedades && $readonly) : ?>						<div class="alerta error">Este vendedor no tiene propiedades asociadas</div>        <?php endif; ?>        <?php foreach ($propiedades as $propiedad) : ?>						<div>								<img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="img propiedad" class="imagen-small">								<span class="fw-300"> <?php echo $propiedad->titulo ?> </span>								<a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>						</div>        <?php endforeach; ?>		</div>		<hr>				<p class="boton boton-verde" style="color: white; display: flex; justify-content: center; width: 50%; margin: 0 auto;margin-top: 20px">Propiedades vendidas</p>		<div class="seccion contenedor contenedor-anuncios">								        <?php foreach ($propiedadesVendidas as $propiedad) : ?>						<div>								<img src="/imagenes/<?php echo $propiedad->imagen; ?>" alt="img propiedad" class="imagen-small">								<span class="fw-300"> <?php echo $propiedad->titulo ?> </span>								<a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-amarillo-block">Ver Propiedad</a>						</div>        <?php endforeach; ?>		</div></fieldset>
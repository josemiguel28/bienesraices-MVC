<?php if ($isPropertySell) : ?>
		<div class="boton boton-verde-block">Esta propiedad ha sido vendida</div>
<?php endif; ?>

<fieldset>

		<legend>Informacion general</legend>

		<label for="titulo">Titulo:</label>
		<input type="text"
		       name="propiedad[titulo]"
		       id="titulo"
		       placeholder="Propiedad"
		       value="<?php echo s($propiedad->titulo); ?>"
		       class="<?php echo $readonly ? 'readonly' : ''; ?>"
        <?php if ($readonly) {
            echo "readonly";
        } ?>
		>


		<label for="titulo">Precio:</label>
		<input type="number"
		       name="propiedad[precio]"
		       id="precio"
		       placeholder="Precio propiedad"
		       value="<?php echo s($propiedad->precio); ?>"
		       class="<?php echo $readonly ? 'readonly' : ''; ?>"
        <?php if ($readonly) {
            echo "readonly";
        } ?>
		>


		<label for="imagen">imagen:</label>
		<input type="file"
		       name="propiedad[imagen]"
		       id="propiedad"
		       accept="image/jpeg, image/png"
		       class="<?php echo $readonly ? 'readonly' : ''; ?>"
        <?php if ($readonly) {
            echo "readonly ";
            echo "disabled";
        } ?>
		>

    <?php if ($propiedad->imagen) { ?>
				<div>
						<img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="img propiedad" class="imagen-small">
				</div>
    <?php } ?>
		<label for="descripcion">Descripcion:</label>
		<textarea name="propiedad[descripcion]"
		          id="descripcion"
		          cols="30"
		          rows="10"
		          class="<?php echo $readonly ? 'readonly' : ''; ?>"
          <?php if ($readonly) {
              echo "readonly ";
              echo "disabled";
          } ?>
><?php echo s($propiedad->descripcion); ?>
</textarea>

</fieldset>

<fieldset>
		<legend>Informacion de la propiedad</legend>

		<label for="habitaciones">Habitaciones:</label>
		<input type="number"
		       name="propiedad[habitaciones]"
		       id="habitaciones"
		       placeholder="Ej. 3"
		       min="1"
		       value="<?php echo s($propiedad->habitaciones); ?>"
		       class="<?php echo $readonly ? 'readonly' : ''; ?>"
        <?php if ($readonly) {
            echo "readonly";
        } ?>
		>

		<label for="wc">Baños:</label>
		<input type="number"
		       id="wc"
		       name="propiedad[wc]"
		       placeholder="Ej. 3"
		       min="1"
		       value="<?php echo s($propiedad->wc) ?>"
		       class="<?php echo $readonly ? 'readonly' : ''; ?>"
        <?php if ($readonly) {
            echo "readonly";
        } ?>
		>

		<label for="estacionamiento">Estacionamientos:</label>
		<input type="number"
		       name="propiedad[estacionamiento]"
		       id="estacionamiento"
		       placeholder="Ej. 3"
		       min="1"
		       value="<?php echo s($propiedad->estacionamiento); ?>"
		       class="<?php echo $readonly ? 'readonly' : ''; ?>"
        <?php if ($readonly) {
            echo "readonly";
        } ?>
		>


</fieldset>

<fieldset>
		<legend>Vendedores</legend>

		<label for="vendedor">Selecciona un vendedor</label>
		<select name="propiedad[vendedorId]"
		        id="vendedor"
		        class="<?php echo $readonly ? 'readonly' : ''; ?>"
        <?php if ($readonly) {
            echo "readonly ";
            echo "disabled";
        } ?>
		>

				<option value="">--Seleccione una opcion--</option>

        <?php foreach ($vendedores as $vendedor) { ?>
						<option value="<?php echo $vendedor->id ?>" <?php echo $propiedad->vendedorId == $vendedor->id ? "selected" : ""; ?> > <?php echo s($vendedor->nombre) . " " . s($vendedor->apellido) ?> </option>
        <?php } ?>

		</select>
</fieldset>
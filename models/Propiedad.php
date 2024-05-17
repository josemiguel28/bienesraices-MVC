<?php
namespace Model;

class Propiedad extends ActiveRecord
{
    protected static string $tabla = 'propiedades';

    protected static array $columnaDb = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedorId"];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $creado;
    public $estacionamiento;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar(): array
    {

        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }

        if (!$this->precio) {
            self::$errores[] = "Debes añadir un precio";
        }

        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "Debes añadir una descripcion mayor a 50 caracteres";
        }

        if (!$this->habitaciones) {
            self::$errores[] = "Debes añadir el numero de habitaciones";
        }
        if (!$this->wc) {
            self::$errores[] = "Debes añadir el numero de baños";
        }
        if (!$this->estacionamiento) {
            self::$errores[] = "Debes añadir el numero de estacionamiento(s)";
        }
        if (!$this->vendedorId) {
            self::$errores[] = "Debes selecionar un vendedor";
        }

        if (!$this->imagen) {
            self::$errores[] = "Debes agregar una imagen";
        }

        return self::$errores;
    }


}
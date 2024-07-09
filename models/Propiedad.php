<?php

namespace Model;

class Propiedad extends ActiveRecord
{
    protected static string $tabla = 'propiedades';

    protected static array $columnaDb = ["id", "titulo", "precio", "imagen", "descripcion", "habitaciones", "wc", "estacionamiento", "creado", "vendedorId", "vendida"];

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
    public $vendida = 0;

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
        $this->vendida = 0 ?? '';

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
    
    public static function getUnsellProperties(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE vendida = 0";
        $resultado = self::consultaSQL($query);

        return $resultado;
    }

    //lista las propiedades 
    public static function getUnsellPropertiesWithLimit($limite): array
    {
        $query = "SELECT * FROM " . static::$tabla . " WHERE vendida = 0 LIMIT " . self::$db->escape_string($limite);

        return self::consultaSQL($query);
    }

    public static function getSellProperties()
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE vendida = 1";

        return self::consultaSQL($query);
    }

    public static function getSellPropertyById($id)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE vendida = 1 AND id = $id";
        
        return self::consultaSQL($query);
    }

    //obtener una propiedad random 
    public static function isPropertySell($id)
    {
        $query = "UPDATE " . self::$tabla . " SET vendida= " . "1" . " WHERE id = $id ";
        
        return self::$db->query($query);

    }

    public static function findUnsellPropertyByVendor($id)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE vendedorId = $id AND vendida = 0";
        $resultado = self::consultaSQL($query);

        return $resultado;
    }

    public static function findSellPropertyByVendor($id)
    {
        $query = "SELECT * FROM " . self::$tabla . " WHERE vendedorId = $id AND vendida = 1";
        $resultado = self::consultaSQL($query);

        return $resultado;
    }

}
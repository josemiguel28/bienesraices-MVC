<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{

    // mantiene la misma instancia del router que esta en el index 
    public static function index(Router $router)
    {
        $propiedades = Propiedad::getUnsellProperties();
        $vendedores = Vendedor::getAll();
        //muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin',
            ["propiedades" => $propiedades,
                "resultado" => $resultado,
                "vendedores" => $vendedores]);
    }

    //obtiene los datos del form (POST)
    private static function getPostData()
    {
        $propiedad = new Propiedad();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            /**  CREA UNA NUEVA INSTANCIA */
            $propiedad = new Propiedad($_POST['propiedad']);

            //generar un nombre unico 
            $nombreImagen = md5(uniqid(strval(rand()), true)) . ".jpg";

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                /**  realiza un resize a la imagen con intervention */
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();

            if (empty($errores)) {
                //carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                $image->save(CARPETA_IMAGENES . $nombreImagen);

                $propiedad->crear();
            }
        }
        //retorna la misma instancia 
        return $propiedad;
    }

    public static function crear(Router $router): void
    {
        $vendedores = new Vendedor();
        $propiedad = self::getPostData();

        $viewData = [
            "propiedad" => $propiedad,
            "vendedores" => $vendedores::getAll(),
            "errores" => $propiedad::getErrores()
        ];

        $router->render('propiedades/crear', $viewData);
    }

    public static function actualizar(Router $router)
    {
        $vendedores = new Vendedor();
        $id = validarORedireccionar("/admin");

        $propiedad = Propiedad::find($id);
        $isPropertySell = Propiedad::getSellPropertyById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST['propiedad'];

            $propiedad->sincronizar($args);

            //validacion
            $errores = $propiedad->validar();

            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                //generar un nombre unico 
                $nombreImagen = md5(uniqid(strval(rand()), true)) . ".jpg";

                /**  realiza un resize a la imagen con intervention */
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            if (empty($errores)) {

                if (!$image == null) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar',
            ["propiedad" => $propiedad,
                "isPropertySell" => $isPropertySell,
                "vendedores" => $vendedores::getAll(),
                "errores" => $propiedad::getErrores(),
                "readonly" => $isPropertySell
            ]);
    }

    public static function eliminar(Router $router)
    {
        //eliminar una propiedad
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if (validarTipoContenido($_POST['tipo'])) {

                switch ($_POST['tipo']) {
                    case 'propiedad':
                        $propiedades = Propiedad::find($id);

                        //si la propiedad existe en la bd, elimina la propiedad de la bd
                        if ($propiedades) {
                            $propiedades->eliminarUnRegistro($id);
                        }
                        break;

                    default:
                        debuguear("error");
                }
            }
        }
    }

    public static function marcarComoVendida(Router $router): void
    {
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);
        
        $propiedad = Propiedad::find($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $propiedad->sincronizar();
            
            $vendida = Propiedad::isPropertySell($id);
            
            if($vendida){
                header('Location: /admin?resultado=5');
            }
        }

        $router->render('/propiedades/actualizar',
            ["isPropertySell" => true
            ]);
    }
    
    public static function propiedadesVendidas(Router $router){
        $propiedades = Propiedad::getSellProperties();
        
       
        $router->render('/propiedades/vendidas',
            [
                "propiedades" => $propiedades
            ]
        
        );
    }
}


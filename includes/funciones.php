<?php
define("TEMPLATES_URL", __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define("CARPETA_IMAGENES", $_SERVER["DOCUMENT_ROOT"] . '/imagenes/');

function incluirTemplate(string $template, bool $inicio = false)
{
    include TEMPLATES_URL . "/$template.php";
}

function Autenticado()
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /bienesraices');
    }
}

function debuguear($variable)
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

/**
 * Esta función sanitiza los inputs del HTML.
 *
 * @param string $html El input HTML a sanitizar.
 * @return string El input HTML sanitizado.
 */

function s($html): string
{
    return htmlspecialchars($html);
}


/**
 * Esta función valida el 'value' en el formulario del Admin.
 *
 * @param string $tipo El tipo de contenido a validar.
 * @return bool Verdadero si el tipo de contenido es válido, falso en caso contrario.
 */
function validarTipoContenido(string $tipo): bool
{
    $tipos = ['propiedad', 'vendedor'];

    return in_array($tipo, $tipos);
}

/**
 * Esta función genera un mensaje basado en un código (obtenido de la superglobal $_GET).
 *
 * @param int $codigo El código basado en el cual se genera el mensaje.
 * @return string El mensaje generado.
 */
function mostrarMensaje(int $codigo): string
{
    $mensaje = "";

    switch ($codigo) {
        case 1:
            $mensaje = "Creado Correctamente";
            break;
        case 2:
            $mensaje = "Actualizado Correctamente";
            break;
        case 3:
            $mensaje = "Eliminado Correctamente";
            break;

        case 4:
            $mensaje = "No se puede eliminar, el vendedor esta asignado a una propiedad";
            break;

        case 5:
            $mensaje = "Se realizo la acción correctamente, la casa esta vendida";
            break;
        default:
            $mensaje = "";
    }

    return $mensaje;
}

/**
 * Esta función valida un ID obtenido de la URL y redirige a una URL específica si el ID no es válido.
 *
 * @param string $url La URL a la que se redirige si el ID no es válido.
 * @return int El ID validado.
 */
function validarORedireccionar(string $url): int
{
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: $url");
    }

    return $id;
}

/**
 * Esta función verifica si un vendedor está asociado a alguna propiedad.
 *
 * @param int $vendedorId El ID del vendedor a verificar.
 * @param array $data Un array que contiene las propiedades a verificar.
 * @return bool Verdadero si el vendedor está asociado a alguna propiedad, falso en caso contrario.
 */
function validarVendedorAsociado(int $vendedorId, array $data = []): bool
{
    $isVendorAssociated = false;

    foreach ($data["propiedades"] as $propiedad) {
        $vendedoresAsociados[] = $propiedad->vendedorId;

        if (in_array($vendedorId, $vendedoresAsociados)) {
            $isVendorAssociated = true;
            break;
        };
    }

    return $isVendorAssociated;
}

/**
 * esta funcion revisa si la peticion https es POST.
 *
 * @return bool
 */
function isPostBack(): bool
{
    return $_SERVER["REQUEST_METHOD"] == "POST";
}

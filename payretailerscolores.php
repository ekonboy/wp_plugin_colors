<?php
/*
Plugin Name: PayRetailers Colores
Description: Plugin para seleccionar y aplicar colores a la interfaz de administración.
Version: 1.0
Author: PayRetailers - MARKETING Development 2023 
Author URI: https://www.payretailers.com/es/
Version: 1.0
Text Domain: PayRetailers-Colores
*/


if( !defined('ABSPATH')){
    exit;
}


echo '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">' . PHP_EOL;
echo '<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>' . PHP_EOL;
echo '<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>' . PHP_EOL;
echo '<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet" >' . PHP_EOL;



// Agrega la página de configuración al menú de administración principal
function payretailerscolores_menu() {
    add_menu_page('PayRetailers Colores', 'Colores', 'manage_options', 'payretailerscolores', 'payretailerscolores_pagina_configuracion');
}

// Agrega la página de configuración en la sección de "Ajustes"
function payretailerscolores_ajustes_menu() {
    add_options_page('PayRetailers Colores', 'PayRetailers Colores', 'manage_options', 'payretailerscolores', 'payretailerscolores_pagina_configuracion');
}

// Muestra la página de configuración
function payretailerscolores_pagina_configuracion() {
    ?>
    <div class="wrap">
        <h1>Configuración de Colores</h1>
        <hr>
        Este plugin ha sido creado por el equipo de <b>PayRetailers - Marketing development.</b><br />
        Sirve para cambiar el color de la administración dependiendo del dominio con el que trabajamos.<br />
        Funciona independientemente de "Apariencia/personalizar".<br /><br />
        <a href="https://github.com/ekonboy" target="_blank" rel="nofollow">Descarga el código:</a><br />
        <img src="/wordpress/PR/wp-content/plugins/payretailerscolors/img/github1600.png" width="80" height="80">
                <br />
        <small>Gracias por usar este plugin,<br />
        solo un <b>Super Admin</b> puede verlo.</small>
        <hr>
        
<style>
 .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
</style>

        <form method="post" action="">
            <label><input type="checkbox" name="color" data-toggle="toggle" value="payretailers" data-style="slow" <?php checked(get_option('color'), 'payretailers'); ?>> PayRetailers</label><br>
            <label><input type="checkbox" name="color" data-toggle="toggle" value="kuady" data-style="slow" <?php checked(get_option('color'), 'kuady'); ?>> Kuady</label><br>
            <label><input type="checkbox" name="color" data-toggle="toggle" value="stg" data-style="slow" <?php checked(get_option('color'), 'stg'); ?>> STG</label><br>
            <label><input type="checkbox" name="color" data-toggle="toggle" value="stg2" data-style="slow" <?php checked(get_option('color'), 'stg2'); ?>> demasiado complicado (STG 2)</label><br>
            <label><input type="checkbox" name="color" data-toggle="toggle" value="otro" data-style="slow" <?php checked(get_option('color'), 'otro'); ?>> Other </label><br>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Guarda la configuración cuando se envía el formulario
function payretailerscolores_guardar_configuracion() {
    if (isset($_POST['color'])) {
        update_option('color', sanitize_text_field($_POST['color']));
    }
}

// Engancha las funciones a las acciones correspondientes
add_action('admin_menu', 'payretailerscolores_menu');
add_action('admin_menu', 'payretailerscolores_ajustes_menu');
add_action('admin_init', 'payretailerscolores_guardar_configuracion');


function payretailerscolores_enqueuer() {
    $color = get_option('color');

    if ($color) {
        wp_enqueue_style('color-seleccionado', plugins_url('css/' . $color . '.css', __FILE__), array(), null, 'all');
    }
}

// Engancha la función a la acción admin_enqueue_scripts
add_action('admin_enqueue_scripts', 'payretailerscolores_enqueuer');



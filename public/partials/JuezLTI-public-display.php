<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    JuezLTI
 * @subpackage JuezLTI/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
    function JuezLTIWidgetPublicForm($args, $instance) {
    $title = apply_filters( 'widget_title', $instance['title'] );

    // los argumentos before y after del widget son definidos por el tema
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];

    // Aquí es donde ejecutaremos el código y mostramos la salida
    echo __( 'Apuntate para participar en el proyecto Piloto', 'JuezLTIPiloto_widget_domain' );
    echo $args['after_widget'];
    ?>
    <form class="widget_form_piloto" action="<?php echo esc_url( admin_url('admin-ajax.php') ); ?>" method="post">

        <input type="hidden" name="action" value="JuezLTI_Piloto">

        <p>
        	<label for="nombre">
        		<?php _e('Nombre de la institución:', 'nombre'); ?>
        		<input type="text" name="nombre" id="nombre" value=""/>
        	</label><br>
        	<label for="email">
        		<?php _e('Correo electrónico :', 'nombre'); ?>
        		<input type="email" name="email" id="email" size="22" value="" />
        	</label><br>
        	<label for="logotipo">
        		<?php _e('URL del logotipo de la institución:', 'nombre'); ?>
        		<input type="text" name="logotipo" id="logotipo" value=""/>
        	</label><br>
            	<input type="submit" name="submit" value="<?php _e('Participa', 'subscribe-to-comments'); ?>" />
        </p>
    </form>
<?php
}
?>
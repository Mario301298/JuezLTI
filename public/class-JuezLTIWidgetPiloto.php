<?php

// Registrar y cargar el widget
function JuezLTIPiloto_load_widget() {
    register_widget( 'JuezLTIWidgetPiloto' );
}
add_action( 'widgets_init', 'JuezLTIPiloto_load_widget' );

// Creando el widget
class JuezLTIWidgetPiloto extends WP_Widget {

    function __construct() {
        parent::__construct(

// ID base del widget
            'JuezLTIWidgetPiloto',

// Nombre del widget que aparecerá en la UI
            __('JuezLTI Piloto Widget', 'JuezLTIPiloto_widget_domain'),

// Descripción del widget
            array( 'description' => __( 'Widget que se encarga de recoger las instituciones interesadas en participar en el proyecto piloto, que se desarrollará durante el curso 2022/2023.', 'JuezLTIPiloto_widget_domain' ), )
        );
    }

// Creando la vista del widget del Frontend

    public function widget( $args, $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/JuezLTI-public-display.php';

        JuezLTIWidgetPublicForm($args, $instance);
    }


// Creando la vista del widget del Backend
    public function form( $instance ) {

        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/JuezLTI-admin-display.php';


        JuezLTIWidgetAdminForm($instance, $this);
    }

// Actualizando el widget reemplazando la instancia antigua por la nueva
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class JuezLTIWidgetPiloto ends here
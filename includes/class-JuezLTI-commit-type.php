<?php

if(!class_exists('JuezLTI_commit_type'))
{
    /**
     * Un PostType que almacenará ofertas de empleo con 3 campos meta adicionales
     */
    class JuezLTI_commit_type
    {
        const COMMIT_TYPE = "commit"; // Nombre que le daremos al tipo de post

        // Los metas adicionales que vamos a asociar a las ofertas de empleo
        private $_meta  = array(
            'url_commit',
            'socio',
            'milestone',
        );

        /**
         * El constructor
         */
        public function __construct()
        {
            // registrar las acciones
            add_action('init', array(&$this, 'init'));
            add_action('admin_init', array(&$this, 'admin_init'));
        } // END public function __construct()

        /**
         * hook into WP's init action hook
         */
        public function init()
        {
            // Inicializa el Post Type
            $this->create_post_type();
            add_action('save_post', array(&$this, 'save_post'));
        } // END public function init()

        /**
         * Crea el post type
         */
        public function create_post_type()
        {
            register_post_type(self::COMMIT_TYPE,
                array(
                    'labels' => array(
                        'name' => __(sprintf('%ss', ucwords(str_replace("_", " ", self::COMMIT_TYPE)))),
                        'singular_name' => __(ucwords(str_replace("_", " ", self::COMMIT_TYPE)))
                    ),
                    'public' => true,
                    'has_archive' => true,
                    'description' => __("This is a sample post type meant only to illustrate a preferred structure of plugin development"),
                    'supports' => array(
                        'title', 'editor',
                    ),
                )
            );
        }

        /**
         * Guarda los meta asociados a una oferta de empleo
         */
        public function save_post($commit_id)
        {
            // verify if this is an auto save routine.
            // If it is our form has not been submitted, so we dont want to do anything
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }

            if(isset($_POST['post_type']) && $_POST['post_type'] == self::COMMIT_TYPE && current_user_can('edit_post', $commit_id))
            {
                foreach($this->_meta as $field_name)
                {
                    // Update the post's meta field
                    update_post_meta($commit_id, $field_name, $_POST[$field_name]);
                }
            }
            else
            {
                return;
            } // if($_POST['post_type'] == self::COMMIT_TYPE && current_user_can('edit_post', $commit_id))
        } // END public function save_post($commit_id)

        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
            // Add metaboxes
            add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
        } // END public function admin_init()

        /**
         * hook into WP's add_meta_boxes action hook
         */
        public function add_meta_boxes()
        {
            // Añade este metabox por cada post seleccionado
            add_meta_box(
                sprintf('wp_plugin_template_%s_section', self::COMMIT_TYPE),
                sprintf('%s Information', ucwords(str_replace("_", " ", self::COMMIT_TYPE))),
                array(&$this, 'add_inner_meta_boxes'),
                self::COMMIT_TYPE
            );
        } // END public function add_meta_boxes()

        /**
         * called off of the add meta box
         */
        public function add_inner_meta_boxes($post)
        {
            // Renderiza el job metabox
            require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/commit-type-template-metabox.php';
        } // END public function add_inner_meta_boxes($post)

    } // END class JuezLTI_commit_type
} // END if(!class_exists('JuezLTI_commit_type'))
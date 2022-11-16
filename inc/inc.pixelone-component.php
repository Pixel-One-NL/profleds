<?php
  /**
   * Component base, used to help components creation
   * 
   * @package PixelOne
   * @since 1.0.0
   * @version 1.0.0
   */

  class PONE_Component {
    private $name;
    private $path;
    private $url;

    /**
     * Constructor, create new component
     * 
     * @since 1.0.0
     * @version 1.0.0
     * 
     * @param string $name Component name
     * @return void
     * @throws Exception
     */
    public function __construct( $name ) {
      if( ! $name ) {
        throw new Exception( 'Component name is required' );
      }

      $this->name = $name;
      $this->path = get_template_directory() . '/template-parts/components/' . $name . '.php';
      $this->url = get_template_directory_uri() . '/template-parts/components/' . $name . '.php';
    }

    /**
     * Create a component and render
     * 
     * @param string $name Component name
     * @param array $data Component data
     * @param array $expected Expected data
     * 
     * @return void
     * @throws Exception
     */
    static function render( $name = '', $data = null, $expected = null ) {
      try {
        $component = new PONE_Component( $name );
        $component->render_component( $data, $expected );
      } catch( Exception $e ) {
        echo $e->getMessage();
      }
    }

    /**
     * Get component name
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return string
     */
    public function get_name() {
      return $this->name;
    }

    /**
     * Get component path
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return string
     */
    public function get_path() {
      return $this->path;
    }

    /**
     * Get component url
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return string
     */
    public function get_url() {
      return $this->url;
    }

    /**
     * Render component
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return void
     */
    public function render_component( $data, $expected ) {
      $this->validate_data( $data, $expected );
      get_template_part( 'template-parts/components/' . $this->name, $this->name, $data );
    }

    /**
     * Validate component data
     * 
     * @since 1.0.0
     * @version 1.0.0
     * @return void
     * @throws Exception
     */
    private function validate_data( $data, $expected ) {
      // Expected types can be: string, int, bool, array, object, null, enum
      $expected_types = array( 'string', 'int', 'bool', 'array', 'object', 'null', 'enum' );

      // Check if data is an array
      if( ! is_array( $data ) ) {
        throw new Exception( 'Component data must be an array' );
      }

      // Check if expected is an array
      if( $expected != null && ! is_array( $expected ) ) {
        throw new Exception( 'Component expected data must be an array' );
      }

      // Check if expected data is not empty
      if( $expected != null && empty( $expected ) ) {
        throw new Exception( 'Component expected data must not be empty' );
      }

      // Check if expected data is valid for each key in the data array
      if( $expected != null ) {
        foreach( $data as $key => $value ) {
          $validation_type = $expected[ $key ];

          switch( $validation_type ) {
            case 'string':
              if( ! is_string( $value ) ) {
                throw new Exception( 'Component data key "' . $key . '" must be a string' );
              }
              break;
            case 'int':
              if( ! is_int( $value ) ) {
                throw new Exception( 'Component data key "' . $key . '" must be an integer' );
              }
              break;
            case 'bool':
              if( ! is_bool( $value ) ) {
                throw new Exception( 'Component data key "' . $key . '" must be a boolean' );
              }
              break;
            case 'array':
              if( ! is_array( $value ) ) {
                throw new Exception( 'Component data key "' . $key . '" must be an array' );
              }
              break;
            case 'object':
              if( ! is_object( $value ) ) {
                throw new Exception( 'Component data key "' . $key . '" must be an object' );
              }
              break;
            case 'null':
              if( ! is_null( $value ) ) {
                throw new Exception( 'Component data key "' . $key . '" must be null' );
              }
              break;
            case 'enum':
              if( ! in_array( $value, $expected[ $key ]['values'] ) ) {
                throw new Exception( 'Component data key "' . $key . '" must be one of the following values: ' . implode( ', ', $expected[ $key ]['values'] ) );
              }
              break;
            default:
              throw new Exception( 'Component data key "' . $key . '" must be one of the following types: ' . implode( ', ', $expected_types ) );
          }
        }
      }
    }
  }
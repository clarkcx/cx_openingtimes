<?php
class CXSettingsPageOpeningTimes
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Admin', 
            'Opening Times', 
            'view_opening_times', 
            'cx-openingtimes-admin', 
            array( $this, 'create_admin_page_opening_times' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page_opening_times()
    {
        // Set class property
        $this->options = get_option( 'cx_openingtimes' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Opening times</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'cx_option_group' );   
                do_settings_sections( 'cx-openingtimes-admin' );
                submit_button();
            ?>
            </form>
            <h2>How to display your opening times</h2>
            <p>There are two main ways you can show your opening times on your website. Firstly you can include a table which shows each day along with your opening and closing time. To do this just enter the following shortcode on any page or blog post:</p>
            <p><code>[opening-times]</code></p>
            <p>The second thing you can do is display the opening times for the current day (i.e. the day the website is being viewed, not the day you add the content.) To do this enter the following shortcode</p>
            <p><code>[opening-times-today]</code></p>
            <p>This will display either <em>We are open today from 9.00am to 5pm</em> (with the correct times of course) or <em>Sorry, we're closed today</em> by default.</p><p>You can change the text shown as in the following examples:</p>
            <p><code>[opening-times-today open="Open" closed="Closed today"]</code></p>
            <p><b>Result: </b>Open 9.00am - 5.00pm // Closed today</p>
            <p><code>[opening-times-today open="Open today" to="until"]</code></p>
            <p><b>Result: </b>Open today 9.00am until 5.00pm // Sorry, we're closed today</p>
            <p><code>[opening-times-today open="Hooray! We're open for business today from" to="but we close at" closed="It's our day off today but we'll be open again tomorrow."]</code></p>
            <p><b>Result: </b>Hooray! We're open for business today from 9.00am but we close at 5.00pm // It's our day off today but we'll be open again tomorrow.</p>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'cx_option_group', // Option group
            'cx_openingtimes', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'cx_section_times', // ID
            '', // Title
            array( $this, 'print_section_info' ), // Callback
            'cx-openingtimes-admin' // Page
        );  

        add_settings_field(
            'day_mon', // ID
            'Monday', // Title 
            array( $this, 'day_mon_callback' ), // Callback
            'cx-openingtimes-admin', // Page
            'cx_section_times' // Section           
        );    

        add_settings_field(
            'day_tue', 
            'Tuesday', 
            array( $this, 'day_tue_callback' ), 
            'cx-openingtimes-admin', 
            'cx_section_times'
        );
        add_settings_field(
            'day_wed', 
            'Wednesday', 
            array( $this, 'day_wed_callback' ), 
            'cx-openingtimes-admin', 
            'cx_section_times'
        ); 
        add_settings_field(
            'day_thu', 
            'Thursday', 
            array( $this, 'day_thu_callback' ), 
            'cx-openingtimes-admin', 
            'cx_section_times'
        ); 
        add_settings_field(
            'day_fri', 
            'Friday', 
            array( $this, 'day_fri_callback' ), 
            'cx-openingtimes-admin', 
            'cx_section_times'
        ); 
        add_settings_field(
            'day_sat', 
            'Saturday', 
            array( $this, 'day_sat_callback' ), 
            'cx-openingtimes-admin', 
            'cx_section_times'
        ); 
        add_settings_field(
            'day_sun', 
            'Sunday', 
            array( $this, 'day_sun_callback' ), 
            'cx-openingtimes-admin', 
            'cx_section_times'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['day_mon'] ) )
            $new_input['day_mon'] = sanitize_text_field( $input['day_mon'] );
        
        if( isset( $input['day_mon_close'] ) )
            $new_input['day_mon_close'] = sanitize_text_field( $input['day_mon_close'] );

        if( isset( $input['day_tue'] ) )
            $new_input['day_tue'] = sanitize_text_field( $input['day_tue'] );
        
        if( isset( $input['day_tue_close'] ) )
            $new_input['day_tue_close'] = sanitize_text_field( $input['day_tue_close'] );
        
        if( isset( $input['day_wed'] ) )
            $new_input['day_wed'] = sanitize_text_field( $input['day_wed'] );
        
        if( isset( $input['day_wed_close'] ) )
            $new_input['day_wed_close'] = sanitize_text_field( $input['day_wed_close'] );
        
        if( isset( $input['day_thu'] ) )
            $new_input['day_thu'] = sanitize_text_field( $input['day_thu'] );
        
        if( isset( $input['day_thu_close'] ) )
            $new_input['day_thu_close'] = sanitize_text_field( $input['day_thu_close'] );
            
        if( isset( $input['day_fri'] ) )
            $new_input['day_fri'] = sanitize_text_field( $input['day_fri'] );
        
        if( isset( $input['day_fri_close'] ) )
            $new_input['day_fri_close'] = sanitize_text_field( $input['day_fri_close'] );
            
        if( isset( $input['day_sat'] ) )
            $new_input['day_sat'] = sanitize_text_field( $input['day_sat'] );
         
        if( isset( $input['day_sat_close'] ) )
            $new_input['day_sat_close'] = sanitize_text_field( $input['day_sat_close'] );
        
        if( isset( $input['day_sun'] ) )
            $new_input['day_sun'] = sanitize_text_field( $input['day_sun'] );
        
        if( isset( $input['day_sun_close'] ) )
            $new_input['day_sun_close'] = sanitize_text_field( $input['day_sun_close'] );
        
        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your daily opening and closing times here. If you are closed on any particular day simply leave the fields for that day blank.';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function day_mon_callback()
    {
        printf(
            '<input type="text" id="day_mon" name="cx_openingtimes[day_mon]" value="%s" />',
            isset( $this->options['day_mon'] ) ? esc_attr( $this->options['day_mon']) : ''
        );
        printf(
            '<input type="text" id="day_mon_close" name="cx_openingtimes[day_mon_close]" value="%s" />',
            isset( $this->options['day_mon_close'] ) ? esc_attr( $this->options['day_mon_close']) : ''
        );
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function day_tue_callback()
    {
        printf(
            '<input type="text" id="day_tue" name="cx_openingtimes[day_tue]" value="%s" />',
            isset( $this->options['day_tue'] ) ? esc_attr( $this->options['day_tue']) : ''
        );
        printf(
            '<input type="text" id="day_tue_close" name="cx_openingtimes[day_tue_close]" value="%s" />',
            isset( $this->options['day_tue_close'] ) ? esc_attr( $this->options['day_tue_close']) : ''
        );
    }
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function day_wed_callback()
    {
        printf(
            '<input type="text" id="day_wed" name="cx_openingtimes[day_wed]" value="%s" />',
            isset( $this->options['day_wed'] ) ? esc_attr( $this->options['day_wed']) : ''
        );
        printf(
            '<input type="text" id="day_wed_close" name="cx_openingtimes[day_wed_close]" value="%s" />',
            isset( $this->options['day_wed_close'] ) ? esc_attr( $this->options['day_wed_close']) : ''
        );
    }
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function day_thu_callback()
    {
        printf(
            '<input type="text" id="day_thu" name="cx_openingtimes[day_thu]" value="%s" />',
            isset( $this->options['day_thu'] ) ? esc_attr( $this->options['day_thu']) : ''
        );
        printf(
            '<input type="text" id="day_thu_close" name="cx_openingtimes[day_thu_close]" value="%s" />',
            isset( $this->options['day_thu_close'] ) ? esc_attr( $this->options['day_thu_close']) : ''
        );
    }
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function day_fri_callback()
    {
        printf(
            '<input type="text" id="day_fri" name="cx_openingtimes[day_fri]" value="%s" />',
            isset( $this->options['day_fri'] ) ? esc_attr( $this->options['day_fri']) : ''
        );
        printf(
            '<input type="text" id="day_fri_close" name="cx_openingtimes[day_fri_close]" value="%s" />',
            isset( $this->options['day_fri_close'] ) ? esc_attr( $this->options['day_fri_close']) : ''
        );
    }
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function day_sat_callback()
    {
        printf(
            '<input type="text" id="day_sat" name="cx_openingtimes[day_sat]" value="%s" />',
            isset( $this->options['day_sat'] ) ? esc_attr( $this->options['day_sat']) : ''
        );
        printf(
            '<input type="text" id="day_sat_close" name="cx_openingtimes[day_sat_close]" value="%s" />',
            isset( $this->options['day_sat_close'] ) ? esc_attr( $this->options['day_sat_close']) : ''
        );
    }
    
    /** 
     * Get the settings option array and print one of its values
     */
    public function day_sun_callback()
    {
        printf(
            '<input type="text" id="day_sun" name="cx_openingtimes[day_sun]" value="%s" />',
            isset( $this->options['day_sun'] ) ? esc_attr( $this->options['day_sun']) : ''
        );
        printf(
            '<input type="text" id="day_sun_close" name="cx_openingtimes[day_sun_close]" value="%s" />',
            isset( $this->options['day_sun_close'] ) ? esc_attr( $this->options['day_sun_close']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new CXSettingsPageOpeningTimes();
    
?>
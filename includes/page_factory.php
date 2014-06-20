<?php
class PageFactory{
    //                __  _                 
    //   ____  ____  / /_(_)___  ____  _____
    //  / __ \/ __ \/ __/ / __ \/ __ \/ ___/
    // / /_/ / /_/ / /_/ / /_/ / / / (__  ) 
    // \____/ .___/\__/_/\____/_/ /_/____/  
    //     /_/                              
    private $name;
    private $args;
    private $option_group;
    private $option_name;
    private $setting_sections;
    private $fields; 
    private $html;

    //                    __  __              __    
    //    ____ ___  ___  / /_/ /_  ____  ____/ /____
    //   / __ `__ \/ _ \/ __/ __ \/ __ \/ __  / ___/
    //  / / / / / /  __/ /_/ / / / /_/ / /_/ (__  ) 
    // /_/ /_/ /_/\___/\__/_/ /_/\____/\__,_/____/
    public function __construct($name, $args = array())
    {
        $this->name        = $name;
        $defaults = array(
            'icon_code'   => '',
            'menu_slug'   => $this->getSlug($name),
            'parent_page' => 'themes.php',
            'capability'  => 'administrator',
            'page_title'  => ucwords($name),
            'menu_title'  => ucwords($name));

        $this->args         = array_merge($defaults, $args);
        $this->option_group = sprintf('%s_group', $this->args['menu_slug']);
        $this->option_name  = $this->args['menu_slug'];

        // =========================================================
        // HOOK'S
        // =========================================================
        add_action('admin_menu', array($this, 'addPage'));  
        add_action('admin_print_scripts', array(&$this, 'adminScripts'));      
        wp_enqueue_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css');
    }

    /**
     * Add some script's to admin panel
     */
    public function adminScripts()
    {
        ?>
        <script>
            function setPhoto(obj)
            {
                var input    = jQuery('#' + jQuery(obj).attr('data-name'));
                var input_id = jQuery('#' + jQuery(obj).attr('data-name') + '_id');
                tb_show('Load images', 'media-upload.php?type=image&amp;TB_iframe=true');

                window.send_to_editor = function(html) {
                    
                    var imgurl       = jQuery('img', html).attr('src');
                    var class_string = jQuery('img', html).attr('class');
                    var classes      = class_string.split(/\s+/);
                    var image_id     = 0;

                    for ( var i = 0; i < classes.length; i++ ) {
                        var source = classes[i].match(/wp-image-([0-9]+)/);
                        if ( source && source.length > 1 ) {
                            image_id = parseInt( source[1] );
                        }
                    }
                    input.val(imgurl);
                    input_id.val(image_id);
                    tb_remove();
                }
                return false;
            }
        </script>
        <?php
    }

    /**
     * Add page to menu
     */
    public function addPage()
    {
        if($this->args['parent_page'] != '')
        {
            add_submenu_page($this->args['parent_page'], $this->args['page_title'], $this->args['menu_title'], $this->args['capability'], $this->args['menu_slug'], array(&$this, 'createPage'));     
        }
        else
        {
            add_menu_page($this->args['page_title'], $this->args['menu_title'], $this->args['capability'], $this->args['menu_slug'], array(&$this, 'createPage'));
        }

        if($this->args['icon_code'] != '') add_action('admin_enqueue_scripts', array(&$this, 'addMenuIcon'));
    }

    /**
     * Add Font Awesome icon to menu
     */
    public function addMenuIcon()
    {       
        ?>
        <style>
            #adminmenu #toplevel_page_<?php echo $this->args['menu_slug']; ?> .wp-menu-image:before {
                content: "\<?php echo $this->args['icon_code']; ?>";  
                font-family: 'FontAwesome' !important;
                font-size: 18px !important;
            }
        </style>
        <?php
    }

    /**
     * Render page
     */
    public function createPage()
    {
        ?>
        <h2><?php echo $this->args['page_title']; ?></h2>
        <div class="wrap">
            <?php screen_icon(); ?>                 
            <form method="post" action="options.php">
            <?php                
                settings_fields($this->option_group);   
                do_settings_sections($this->args['menu_slug']);
                if($this->html) echo implode(' ', $this->html);
                if(is_array($this->setting_sections)) submit_button(); 
            ?>

            </form>
        </div>
        <?php
    }

    /**
     * Add section AND his fields
     * @param string $section_name --- Section display name. Example: Theme options, Plugin settings
     * @param array $fields        --- Fields to add in to section. 
     * Example: array(
     *     array('name' => 'some field', 'type' => 'text'), 
     *     array('name' => 'some field 2', 'type' => 'text'));
     */
    public function addFields($section_name, $fields)
    {
        $slug = $this->getSlug($section_name);
        $this->setting_sections[$slug] = array(
            'fields' => $fields,
            'name'   => $section_name,
            'slug'   => $slug);

        add_action('admin_init', array($this, 'pageInit'));
    }

    /**
     * Generate and add table to page
     * @param  array $table --- two-dimensional array
     * @param  array $args  --- options
     */
    public function addTable($table, $args = array())
    {
        if($table)
        {
            $this->html[] = $this->generateTable($table, $args);    
        }
    }

    /**
     * Add HTML to page
     * @param string $html --- HTML Code
     */
    public function addHTML($html)
    {
        $this->html[] = $html;
    }

    /**
     * Generate table HTML from array
     * @param  array $table --- two-dimensional array
     * @param  array $args  --- options
     * @return string       --- html code or false
     */
    public function generateTable($table, $args = array())
    {
        if(!is_array($table) OR !is_array(current($table))) return false;        
        
        $header_str = '';
        $footer_str = '';
        $defaults   = array(
            'class'  => 'widefat fixed',
            'id'     => '',
            'title'  => '',
            'header' => true,
            'footer' => true);
        $args    = array_merge($defaults, $args);
        $classes = $args['class'] != '' ? sprintf('class="%s"', $args['class']) : '';
        $id      = $args['id'] != '' ? sprintf(' id="%s"', $args['id']) : '';
        $title   = $args['title'] == '' ? '' : sprintf('<h3>%s</h3>', $args['title']);          

        $keys       = array_keys($table);
        $keys_count = count($keys);
        $first_key  = $keys[0];
        $last_key   = $keys[$keys_count-1];
        
        if($args['header']) 
        {
            $header = $table[$first_key];
            
            foreach ($header as &$col) 
            {
                $header_str.= sprintf('<th>%s</th>', $col);
            }
            $header_str = sprintf('<thead><tr>%s</tr></thead>', $header_str);
            unset($table[$first_key]);
        }
        if($args['footer'])
        {
            $footer     = $table[$last_key];
            if($footer)
            {
                foreach ($footer as &$col) 
                {
                    $footer_str.= sprintf('<th>%s</th>', $col);
                }    
            }
            $footer_str = sprintf('<tr class="footer">%s</tr>', $footer_str);
            unset($table[$last_key]);
        }

        foreach ($table as &$row) 
        {
            $out.= '<tr>';
            foreach ($row as &$col) 
            {
                $out.= sprintf('<td>%s</td>', $col);
            }
            $out.= '</tr>';
        }

        return sprintf('%s<table %s%s>%s<tbody>%s%s</tbody></table>', $title, $classes, $id, $header_str, $out, $footer_str);
    }

    /**
     * Page initialization
     */
    public function pageInit()
    {    
        $options = $this->getAll();    
        register_setting($this->option_group, $this->option_name, array($this, 'sanitize'));
        foreach ($this->setting_sections as &$section) 
        {
            add_settings_section($section['slug'], $section['name'], null, $this->args['menu_slug']);
            if(is_array($section['fields']))
            {
                foreach ($section['fields'] as &$field) 
                {
                    $field_name = $field['name'];
                    $field_slug = $this->getSlug($field_name);
                    $field_type = sprintf('control%s', ucwords($field['type']));
                    $args       = array(
                        'section_slug' => $section['slug'], 
                        'value'        => $options[$section['slug']][$field_slug],
                        'name'         => $field_name,
                        'slug'         => $field_slug);
                    add_settings_field($field_slug, $field_name, array(&$this, $field_type), $this->args['menu_slug'], $section['slug'], $args);
                }
            }
        }
    }

    /**
     * Get all options from this page
     * @return array
     */
    public function getAll()
    {
        return get_option($this->option_name);
    }

    /**
     * Check fields value
     * @param  array $input --- array to check.
     * @return array        --- array to save.
     */
    public function sanitize($input)
    {
        $save = array();
        if(is_array($input))
        {
            foreach ($input as $section => &$fields) 
            {
                foreach ($fields as $key => &$field) 
                {
                    $type = $this->getFieldType($section, $key);                    
                    if($type)
                    {
                        $callback = sprintf('check%s', ucwords($type));
                        if(method_exists($this, $callback))
                        {
                            $save[$section][$key] = $this->$callback($field);
                        }   
                    }
                }
            }
        }
       
        return $save;
    }

    /**
     * Forming slug name
     * @param  string $name --- Display name. Example: PayPal options
     * @return string       --- Slug name. Example: paypal_options
     */
    private function getSlug($name)
    {
        $name = str_replace(array('(', ')'), '', $name);
        return strtolower(str_replace(' ', '_', $name));
    }

    /**
     * Get fields types from section
     * @param  string $section_slug --- section slug
     * @return array                --- array types. array( field => type )
     */
    private function getFieldTypes($section_slug)
    {
        $types = array();

        if(isset($this->setting_sections[$section_slug]) && isset($this->setting_sections[$section_slug]['fields']))
        {

            foreach ($this->setting_sections[$section_slug]['fields'] as &$field) 
            {
                $slug          = $this->getSlug($field['name']);
                $types[$slug] = $field['type'];
            }
        }
        return $types;
    }

    /**
     * Get field type by section_slug and field_slug
     * @param  string $section_slug --- section slug name
     * @param  string $field_slug   --- field slug name
     * @return mixed                --- if success return type else return false.
     */
    private function getFieldType($section_slug, $field_slug)
    {
        $types = $this->getFieldTypes($section_slug);

        if(isset($types[$field_slug])) return $types[$field_slug];
        return false;
    }

    /**
     * Helper function for checkbox control
     * @param  boolean $yes --- checked or no
     * @return string       --- checked="cheked" | empty
     */
    private function checked($yes)
    {
        return $yes ? 'checked="checked"' : '';
    }

    // =========================================================
    // CONTROL TYPES
    // =========================================================
    
    /**
     * TEXT TYPE
     * @param  array $args --- control properties
     */
    public function controlText($args)
    {
        printf('<input type="text" id="%s" class="regular-text" name="%s[%s][%s]" value="%s" />', $args['slug'], $this->option_name, $args['section_slug'], $args['slug'], $args['value']);
    }

    /**
     * CHECKBOX TYPE
     * @param  array $args --- control properties
     */
    public function controlCheckbox($args)
    {      
        printf('<input type="checkbox" id="%1$s" class="widefat" name="%2$s[%3$s][%1$s]" %4$s/>', $args['slug'], $this->option_name, $args['section_slug'], $this->checked(!empty($args['value'])));
    }

    public function controlImage($args)
    {
        $defaults = array('id' => 0, 'url' => '');
        $args     = array_merge($defaults, $args);

        if($args['value']['id'] != 0)
        {
            echo wp_get_attachment_image($args['value']['id'], 'medium', 0, array('style' => 'display: block;'));
        }
        printf('<input type="hidden" id="%1$s_id" name="%2$s[%3$s][%1$s][id]" value="%4$s">', $args['slug'], $this->option_name, $args['section_slug'], intval($args['value']['id']));
        printf('<input type="text" id="%1$s" class="regular-text" name="%2$s[%3$s][%1$s][url]" value="%4$s" />', $args['slug'], $this->option_name, $args['section_slug'], $args['value']['url']);
        printf('<button type="button" onclick="setPhoto(this);" data-name="%1$s" class="button">%2$s</button>', $args['slug'], __('Upload'));
    }

    /**
     * Textarea TYPE
     * @param  array $args --- control properties
     */
    public function controlTextarea($args)
    {
        printf('<textarea id="%3$s" name="%1$s[%2$s][%3$s]" class="large-text" cols="50" rows="10">%4$s</textarea>', $this->option_name, $args['section_slug'], $args['slug'], $args['value']);
    }

    // =========================================================
    // CHECK TYPES
    // =========================================================
    
    private function checkText($value)
    {
        return trim(strip_tags($value));
    }

    private function checkTextarea($value)
    {
        return trim($value);
    }

    private function checkCheckbox($value)
    {
        return $value;
    }

    private function checkImage($value)
    {
        if($value['url'] == '') return array('url' => '', 'id' => 0);
        return $value;
    }
}
<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_products_categories extends Base_admin
{
    private   $module_page                  = array(
        'index'         => 'index',
        'editor'        => 'editor',
        'table'         => 'table',
        'index_footer'  => 'footer_index',
        'editor_footer' => 'footer_editor',
    );
    protected $module_url_default           = 'mod_products_categories';
    protected $module_base                  = 'mod_products_categories';
    protected $module_table                 = 'products_categories';
    protected $module_table_id              = 'id';
    protected $module_duplicate_check       = array(
        /* -------------------------------------------------------- */
        /*
         * Table is index , value is foreign key on table to check
         * clear array if not use check chain
         *
         * 'column_to_check' => 'Label'
         *
         */
        /* -------------------------------------------------------- */
        "data_name" => "Name"
    );
    protected $module_duplicate_check_chain = array(
        /* -------------------------------------------------------- */
        /*
         * Table is index , value is foreign key on table to check
         * clear array if not use check chain
         *
         * 'table_name' => 'column_foreign_key on table'
         *
         */
        /* -------------------------------------------------------- */
    );
    protected $module_related_dropdown      = array(
        /* -------------------------------------------------------- */
        /*
         * Table is index , value is foreign key on table to check
         * clear array if not use check chain
         *
         * "products_categories" => array(
         *   "table"  => "table_name",
         *   "label"  => "Label",
         *   "name"   => "input_name",
         *   "column" => array(
         *     "id"   => "column_database_id",
         *     "name" => "column_database_name"
         *    )
         * )
         *
         */
        /* -------------------------------------------------------- */
    );
    protected $module_related_join          = array(
        /* -------------------------------------------------------- */
        /*
         * Table for select join. use on data function table to get data
         *
         * "products_categories" => array(
         *  "table"  => "products_categories",
         *  "key_pk" => "id",
         *  "key_fk" => "products_categories_id",
         *  "column" => array(
         *     "products_categories.id as category_id",
         *     "products_categories.data_name as category_name"
         *  )
         * )
         */
        /* -------------------------------------------------------- */
    );

    public function __construct()
    {
        parent::__construct();
        $this->apps_title_module = 'Categories Product';
        $this->apps_breadcrumb[] = array(
            'title' => $this->apps_title_module,
            'link'  => base_url($this->module_url_default)
        );
    }

    protected function set_form_validation($ID = FALSE)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('', '<br/>');
        if ($ID) {
            $this->form_validation->set_rules("{$this->module_table_id}", "ID {$this->module_title}", 'required');
        }
        /* SET FORM VALIDATION RULES FOR COLUMN */
        $this->form_validation->set_rules("data_name", "Name {$this->apps_title_module}", 'required');
        $this->form_validation->set_rules("data_description", "Description {$this->apps_title_module}", 'required');
    }

    public function index()
    {
        $data = array();
        $this->display($this->module_page['index'], $data, $this->module_page['index_footer']);
    }

    public function table()
    {
        $data['output_result'] = $this->db->get($this->module_table)->result_array();
        $this->load->view($this->module_page['table'], $data);
    }

    public function add()
    {
        if ($this->is_request_post()) {
            $this->add_process();
        } else {
            $data = array(
                'template_title_module_action' => 'add'
            );

            $this->apps_breadcrumb[] = array(
                'title' => ucwords("{$data['template_title_module_action']}"),
                'link'  => base_url($this->module_url_default) . '/add'
            );

            $this->display($this->module_page['editor'], $data, $this->module_page['editor_footer']);
        }
    }

    public function edit($parameter_id = null)
    {
        if ($this->is_request_post()) {
            $this->edit_process($parameter_id);
        } else {
            $data = array(
                'template_title_module_action' => 'edit'
            );

            $this->apps_breadcrumb[] = array(
                'title' => ucwords("{$data['template_title_module_action']}"),
                'link'  => base_url($this->module_url_default) . '/add'
            );

            $data['output_result'] = array();
            if ($parameter_id != '') {
                $parameter_where[$this->module_table_id] = $parameter_id;
                $data['output_result']                   = $this->db->get_where($this->module_table, $parameter_where)->row_array();
                if (!empty($data['output_result'])) {
                    $data['output_result']['published'] = date('d/m/Y H:i:s', strtotime($data['output_result']['published']));
                }
            }

            $this->display($this->module_page['editor'], $data, $this->module_page['editor_footer']);
        }
    }

    public function add_process()
    {
        $parameter_url_source = $this->module_url_default . '/add';
        $this->action_add_process($parameter_url_source);
    }

    public function edit_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/edit/' . $parameter_id;
        $this->action_edit_process($parameter_url_source, $parameter_id);
    }

    public function status_process($parameter_id = null)
    {
        $this->action_status_process($parameter_id);
    }

    public function delete_process($parameter_id = null)
    {
        $this->action_delete_process($parameter_id);
    }
}

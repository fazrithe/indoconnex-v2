<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_users extends Base_admin
{
    private   $module_page        = array(
        'index'         => 'index',
        'editor'        => 'editor',
        'table'         => 'table',
        'index_footer'  => 'footer_index',
        'editor_footer' => 'footer_editor',
    );
    protected $module_url_default = 'mod_users';
    protected $module_base        = 'mod_users';
    protected $module_table       = 'users';
    protected $module_table_id    = 'id';

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
        "username" => "Username"
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
         * "users_categories" => array(
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
         * "users_categories" => array(
         *  "table"  => "users_categories",
         *  "key_pk" => "id",
         *  "key_fk" => "product_categories_id",
         *  "column" => array(
         *     "users_categories.id as category_id",
         *     "users_categories.data_name as category_name"
         *  )
         * )
         */
        /* -------------------------------------------------------- */
    );

    public function __construct()
    {
        parent::__construct();
        $this->apps_title_module = 'Users';
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
        $this->form_validation->set_rules("username", "Name {$this->apps_title_module}", 'required');
        $this->form_validation->set_rules("email", "Email {$this->apps_title_module}", 'required');
        $this->form_validation->set_rules("name_full", "Full Name {$this->apps_title_module}", 'required');
    }

    protected function set_data_dropdown_relation_data()
    {
        $data['output_result_dropdown'] = [];
        if (!empty($this->module_related_dropdown)) {
            foreach ($this->module_related_dropdown as $index => $row) {
                $data['output_result_dropdown'][$index]            = $row;
                $data['output_result_dropdown'][$index]['dataset'] = array();

                /** Process select data from database */
                $this->db->select("{$row['column']['id']} as option_value, {$row['column']['name']} as option_name");
                $this->db->where('deleted_at IS NULL');
                $data['output_result_dropdown'][$index]['dataset'] = $this->db->get($row['table'])->result_array();
            }
        }
        return $data;
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

            $data += $this->set_data_dropdown_relation_data();

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

            $data += $this->set_data_dropdown_relation_data();

            $this->apps_breadcrumb[] = array(
                'title' => ucwords("{$data['template_title_module_action']}"),
                'link'  => base_url($this->module_url_default) . '/add'
            );

            $data['output_result'] = array();
            if ($parameter_id != '') {
                $parameter_where[$this->module_table_id] = $parameter_id;
                $data['output_result']                   = $this->db->get_where($this->module_table, $parameter_where)->row_array();
            }

            $this->display($this->module_page['editor'], $data, $this->module_page['editor_footer']);
        }
    }

    public function add_process()
    {
        $parameter_url_source = $this->module_url_default . '/add';

        $this->action_users_process();

        $this->action_add_process($parameter_url_source);
    }

    private function action_users_process()
    {
        if ($this->input->post('id') == '') {
            if ($this->input->post('password_create') == '' || $this->input->post('password_create') == '') {
                /** Password empty */
            } else {
                if ($this->input->post('password_create') != $this->input->post('password_confirm')) {
                    /** Error create password*/
                } else {
                    $password_hash     = password_hash($this->input->post('password_confirm'), PASSWORD_DEFAULT, array('cost' => 10));
                    $password_hash     = func_encrypt($password_hash);
                    $_POST['password'] = $password_hash;
                }
            }
        } else {
            if ($this->input->post('password_create') != '' && $this->input->post('password_confirm') != '') {
                $password_hash     = password_hash($this->input->post('password_confirm'), PASSWORD_DEFAULT, array('cost' => 10));
                $password_hash     = func_encrypt($password_hash);
                $_POST['password'] = $password_hash;
            }
        }

        if ($this->input->post('users_access') != '') {
            $_POST['users_access'] = func_encrypt(json_encode($this->input->post('users_access')));
        }

        if ($this->input->post('email') != '') {
            $_POST['email'] = func_encrypt($this->input->post('email'));
        }
        if ($this->input->post('name_full') != '') {
            $_POST['name_full'] = func_encrypt($this->input->post('name_full'));
        }
        if ($this->input->post('name_nick') != '') {
            $_POST['name_nick'] = func_encrypt($this->input->post('name_nick'));
        }
        if ($this->input->post('phone') != '') {
            $_POST['phone'] = func_encrypt($this->input->post('phone'));
        }

        unset($_POST['password_create']);
        unset($_POST['password_confirm']);
    }

    public function edit_process($parameter_id = null)
    {
        $parameter_url_source = $this->module_url_default . '/edit/' . $parameter_id;
        $this->action_users_process();
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

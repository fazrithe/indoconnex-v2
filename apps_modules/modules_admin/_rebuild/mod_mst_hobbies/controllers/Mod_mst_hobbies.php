<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'controllers/Base_admin.php';

class Mod_mst_hobbies extends Base_admin
{
    private   $module_page                  = array(
        'index'         => 'index',
        'editor'        => 'editor',
        'table'         => 'table',
        'index_footer'  => 'footer_index',
        'editor_footer' => 'footer_editor',
    );
    protected $module_url_default           = 'mod_mst_hobbies';
    protected $module_base                  = 'mod_mst_hobbies';
    protected $module_table                 = 'mst_hobbies';
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
        //        "data_name" => "Name"
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
         * "mst_hobbies" => array(
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
         * "mst_hobbies" => array(
         *  "table"  => "mst_hobbies",
         *  "key_pk" => "id",
         *  "key_fk" => "mst_hobbies_id",
         *  "column" => array(
         *     "mst_hobbies.id as category_id",
         *     "mst_hobbies.data_name as category_name"
         *  )
         * )
         */
        /* -------------------------------------------------------- */
    );
    protected $module_upload_path           = 'public/uploads/mst_hobbies/';

    public function __construct()
    {
        parent::__construct();
        $this->apps_title_module = 'Master Hobbies';
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
        /* $this->form_validation->set_rules("data_description", "Description {$this->apps_title_module}", 'required'); */
    }

    public function index()
    {
        $data = array();
        $this->display($this->module_page['index'], $data, $this->module_page['index_footer']);
    }

    public function table()
    {
        $output_result = $this->db->get($this->module_table);
        $rowCount      = $output_result->num_rows();
        $output_result->free_result();


        $output_result = $this->db->get($this->module_table);

        $parameter_select = array(
            'id',
            'data_position',
            'data_name',
            'data_description',
            'DATE_FORMAT(published, "%d/%m/%Y %H:%i") as published',
            'status',
        );

        $parameter_where = array(
            'data_position',
            'data_name',
            'data_description',
            'published',
        );

        $this->db->select($parameter_select);
        $this->db->offset($this->input->post('start'));
        $this->db->limit($this->input->post('length'));
        $output_result = $this->db->get($this->module_table);
        $column_search = $this->input->post('search');
        $filter_search = array();

        if (!empty($parameter_where)) {
            for ($i = 0; $i < count($parameter_where); $i++) {
                $column_search_value = $column_search['value'];
                if ($column_search_value != '') {
                    $filter_search[$parameter_where[$i]] = $column_search_value;
                }
            }
        }

        if (!empty($filter_search)) {
            $this->db->group_start();
            $this->db->or_like($filter_search);
            $this->db->group_end();
        }

        $this->db->offset($this->input->post('start'));
        $this->db->limit($this->input->post('length'));
        $output_result = $this->db->get($this->module_table);

        $filtered_records = $output_result->num_rows();

        $output_array = array(
            'draw'            => "{$this->input->post('draw')}",
            'recordsTotal'    => $rowCount,
            'recordsFiltered' => $filtered_records,
            'data'            => $output_result->result_array()
        );

        $output_result->free_result();

        return $this->output->set_content_type('application/json')->set_output(json_encode($output_array));
    }

    public function table_()
    {
        $output_result = $this->db->get($this->module_table);
        $rowCount      = $output_result->num_rows();
        $output_result->free_result();

        $parameter_select = array(
            'id',
            'data_position',
            'data_name',
            'data_description',
            'DATE_FORMAT(published, "%d/%m/%Y %H:%i") as published',
            'status',
            'status_disable',
        );

        $parameter_where = array(
            'data_position',
            'data_name',
            'data_description',
            'published',
        );

        $this->db->offset($this->input->post('start'));
        $this->db->limit($this->input->post('length'));
        $output_result = $this->db->get($this->module_table);

        $filtered_records = $output_result->num_rows();

        /*
        $this->db->select($parameter_select);
        $this->db->offset($this->input->post('start'));
        $this->db->limit($this->input->post('length'));
        $output_result = $this->db->get($this->module_table);
        $column_search = $this->input->post('search');
        $filter_search = array();

        if (!empty($parameter_where)) {
            for ($i = 0; $i < count($parameter_where); $i++) {
                $column_search_value = $column_search['value'];
                if ($column_search_value != '') {
                    $filter_search[$parameter_where[$i]] = $column_search_value;
                }
            }
        }

        if (!empty($filter_search)) {
            $this->db->group_start();
            $this->db->or_like($filter_search);
            $this->db->group_end();
        }
        */

        $output_result_data = $this->db->get($this->module_table)->result_array();
        $output_result->free_result();

        $output_array = array(
            'draw'            => "{$this->input->post('draw')}",
            'recordsTotal'    => $rowCount,
            'recordsFiltered' => $filtered_records,
            'data'            => $output_result_data
        );

        return $this->output->set_content_type('application/json')->set_output(json_encode($output_array));
    }


    public function table_reorder()
    {
        $this->is_request_ajax();

        $data = array();

        if (!empty($this->input->post('parameter_order'))) {
            foreach ($this->input->post('parameter_order') as $key => $val) {
                $data[] = array('id' => $key, 'data_position' => $val);
            }
        }

        if (!empty($data)) {
            if ($this->db->update_batch($this->module_table, $data, 'id')) {
                $output_action = [
                    'status'  => true,
                    'message' => 'Reorder Success'
                ];
            } else {
                $output_action = [
                    'status'  => false,
                    'message' => 'Reorder Failed'
                ];
            }
        } else {
            $output_action = [
                'status'  => true,
                'message' => 'No action'
            ];
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($output_action));
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


    public function status_disable_process($parameter_id = null)
    {
        $this->action_status_disable_process($parameter_id);
    }

    public function delete_process($parameter_id = null)
    {
        $this->action_delete_process($parameter_id);
    }

    public function delete_image_process($parameter_id = null)
    {
        $this->action_image_process_delete(
            $this->module_table,
            '',
            $this->module_table_id,
            $this->input->post($this->module_table_id),
            'update'
        );
    }
}

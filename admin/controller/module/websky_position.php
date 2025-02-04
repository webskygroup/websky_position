<?php
namespace Opencart\Admin\Controller\Extension\webskyPosition\Module;
/**
 * Class webskyPosition
 *
 * @package Opencart\Admin\Controller\Extension\webskyPosition\Module
 */
class webskyPosition extends \Opencart\System\Engine\Controller {
	/**
	 * @return void
	 */
	public function index(): void {
		$this->load->language('extension/websky_position/module/websky_position');

		$this->document->setTitle(strip_tags($this->language->get('heading_title')));

		$data['breadcrumbs'] = [];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
		];

		$data['breadcrumbs'][] = [
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module')
		];

		if (!isset($this->request->get['module_id'])) {
			$data['breadcrumbs'][] = [
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/websky_position/module/websky_position', 'user_token=' . $this->session->data['user_token'])
			];
		} else {
			$data['breadcrumbs'][] = [
				'text' => $this->language->get('heading_title'),
				'href' => $this->url->link('extension/websky_position/module/websky_position', 'user_token=' . $this->session->data['user_token'] . '&module_id=' . $this->request->get['module_id'])
			];
		}

		$data['save'] = $this->url->link('extension/websky_position/module/websky_position.save', 'user_token=' . $this->session->data['user_token'] );
		$data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module');

		if (isset($this->request->post['module_websky_position_status'])) {
			$data['module_websky_position_status'] = $this->request->post['module_websky_position_status'];
		} else {
			$data['module_websky_position_status'] = $this->config->get('module_websky_position_status');
		}

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/websky_position/module/websky_position', $data));
	}

	/**
	 * @return void
	 */
	public function save(): void {
		$this->load->language('extension/websky_position/module/websky_position');

		$json = [];

		if (!$this->user->hasPermission('modify', 'extension/websky_position/module/websky_position')) {
			$json['error']['warning'] = $this->language->get('error_permission');
		}


		if (!$json) {
			
			$this->load->model('setting/setting');

			$this->model_setting_setting->editSetting('module_websky_position', $this->request->post);

			$json['success'] = $this->language->get('text_success');
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function install()
	{

		$this->load->model('setting/startup');
        $startup_data = [
            'code' => 'module_websky_position',
			'description' => 'drag drop position',
            'action' => 'admin/extension/websky_position/startup/websky_position',
            'status' => 1,
            'sort_order' => 2,
        ];

        $this->model_setting_startup->addStartup($startup_data);
	}
}

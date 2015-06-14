<?php

class Controller_Base extends Controller_Template
{
	public $template = Constants::TEMPLATE_VIEW;

	public function before()
	{
		parent::before();

		$this->current_user = null;

		foreach (\Auth::verified() as $driver)
		{
			if (($id = $driver->get_user_id()) !== false)
			{
				$this->current_user = Model\Auth_User::find($id[1]);
			}
			break;
		}

		// Set a global variable so views can use it
		View::set_global('current_user', $this->current_user);
		$this->template->domain = Asset::css('bootstrap.min.css');
		$this->template->css = Asset::css('bootstrap.min.css');
		$this->template->js_bootstrap = Asset::js('bootstrap.min.js');
		$this->template->js_main = Asset::js('main.js');
        $this->template->token = Security::fetch_token();
        $this->template->token_name = Config::get('security.csrf_token_key');
        $this->template->token_script = Security::js_fetch_token();
        $this->template->link_login = Html::anchor('admin/login/', '<i class="glyphicon glyphicon-log-in"></i> Login', array('class' => 'btn btn-default', 'style' => 'color:#333;text-decoration:none;display:inline-block;'));
        $this->template->link_logout = Html::anchor('admin/logout/', '<i class="glyphicon glyphicon-log-out"></i> Logout', array('class' => 'btn btn-default','style' => 'color:#333;text-decoration:none;display:inline-block;'));
        $this->template->link_labelCopy = Html::anchor('label/', '<i class="glyphicon glyphicon-share"></i> Label Copy');
        $this->template->link_label = Html::anchor('label/list', '<i class="glyphicon glyphicon-tag"></i> Label Master');
        $this->template->link_labelGroup = Html::anchor('labelgroup/list', '<i class="glyphicon glyphicon-tags"></i>&nbsp;&nbsp;Label Group Master');

        $this->template->link_addLabel = Html::anchor('label/create', '<i class="glyphicon glyphicon-share-alt"></i> Add Label', array('class' => 'btn btn-success', 'style' => 'color:#fff;text-decoration:none;display:inline-block;'));
        $this->template->link_addLabelGroup = Html::anchor('labelgroup/create', '<i class="glyphicon glyphicon-share-alt"></i> Add Label Group', array('class' => 'btn btn-success', 'style' => 'color:#fff;text-decoration:none;display:inline-block;'));
	}

}

<?php
class Controller_Label extends Controller_Base
{
	public function before()
	{
		parent::before();
		// !Auth::check() and Response::redirect('admin');
	}

	public function action_index()
	{
		$data['labelgroups'] = Model_Labelgroup::find('all');
		$data['labels'] = Model_Label::find('all');
		$data['link_base'] = Uri::base(false);
		$this->template->title = "LABEL COPY | JIRA TOOL";
		$this->template->content = View_Twig::forge('label/index', $data);

	}

	public function action_list()
	{
		!Auth::check() and Response::redirect('admin');

		$data['labelgroups'] = Model_Labelgroup::find('all');
		$data['labels'] = Model_Label::find('all');
		$data['link_base'] = Uri::base(false);
		$this->template->title = "LABEL LIST | JIRA TOOL";
		$this->template->content = View_Twig::forge('label/list', $data);
	}

	public function action_item($id = null)
	{
		is_null($id) and Response::redirect('label');

		if ( ! $data['label'] = Model_Label::find($id))
		{
			Session::set_flash('error', 'Could not find label #'.$id);
			Response::redirect('label');
		}

		$data['link_base'] = Uri::base(false);
		$this->template->title = "Label";
		$this->template->content = View_Twig::forge('label/view', $data);
	}

	public function action_create()
	{
		!Auth::check() and Response::redirect('admin');

		$message = '';

		if (Input::method() == 'POST')
		{
			$val = Model_Label::validate('create');

			if ($val->run())
			{
				$label = Model_Label::forge(array(
					'name' => Input::post('name'),
					'group_id' => Input::post('group_id'),
					'remarks' => Input::post('remarks'),
				));

				if ($label and $label->save())
				{
					// Session::set_flash('success', e('Added label #'.$memo->id.'.'));

					Response::redirect('label/list');
				}

				else
				{
					Session::set_flash('error', e('Could not save label.'));
				}
			}
			else
			{
				// Session::set_flash('error', $val->error());
				$message = '入力項目を確認してください。';
			}
		}
		$data['error'] = $message;
		$data['groups'] = Model_Labelgroup::find('all');
		$data['link_base'] = Uri::base(false);
		$this->template->title = "NEW LABEL | JIRA TOOL";
		$this->template->content = View_Twig::forge('label/create', $data);

	}

	public function action_edit($id = null)
	{
		!Auth::check() and Response::redirect('admin');

		is_null($id) and Response::redirect('label');

		if ( ! $label = Model_Label::find($id))
		{
			Session::set_flash('error', 'Could not find label #'.$id);
			Response::redirect('label');
		}

		$val = Model_Label::validate('edit');

		if ($val->run())
		{
			$label->name = Input::post('name');
			$label->group_id = Input::post('group_id');
			$label->remarks = Input::post('remarks');

			if ($label->save())
			{
				Session::set_flash('success', 'Updated label #' . $id);

				Response::redirect('label/list');
			}

			else
			{
				Session::set_flash('error', 'Could not update label #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$label->name = $val->validated('name');
				$label->group_id = $val->validated('group_id');
				$label->remarks = $val->validated('remarks');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('label', $label, false);
		}


		$this->template->title = "LABEL EDIT | JIRA TOOL";
		$data['groups'] = Model_Labelgroup::find('all');
		$data['link_base'] = Uri::base(false);
		$this->template->content = View_Twig::forge('label/edit', $data);

	}

	public function action_delete($id = null)
	{
		!Auth::check() and Response::redirect('admin');

		is_null($id) and Response::redirect('label');

		if ($label = Model_Label::find($id))
		{
			$label->delete();

			Session::set_flash('success', 'Deleted label #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete label #'.$id);
		}

		Response::redirect('label/list');

	}

}

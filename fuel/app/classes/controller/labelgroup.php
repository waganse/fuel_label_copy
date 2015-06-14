<?php
class Controller_Labelgroup extends Controller_Base
{
	public function before()
	{
		parent::before();
		// !Auth::check() and Response::redirect('admin');
	}

	public function action_index()
	{
		Response::redirect('labelgroup/list');
	}

	public function action_list()
	{
		!Auth::check() and Response::redirect('admin');

		$data['labelgroups'] = Model_Labelgroup::find('all');
		$data['labels'] = Model_Label::find('all');
		$data['link_base'] = Uri::base(false);
		$this->template->title = "LABEL LIST | JIRA TOOL";
		$this->template->content = View_Twig::forge('labelgroup/list', $data);
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
			$val = Model_Labelgroup::validate('create');

			if ($val->run())
			{
				$label = Model_Labelgroup::forge(array(
					'name' => Input::post('name'),
					'remarks' => Input::post('remarks'),
				));

				if ($label and $label->save())
				{
					// Session::set_flash('success', e('Added label #'.$memo->id.'.'));

					Response::redirect('labelgroup/list');
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
		$data['link_base'] = Uri::base(false);
		$this->template->title = "NEW LABEL GROUP | JIRA TOOL";
		$this->template->content = View_Twig::forge('labelgroup/create', $data);

	}

	public function action_edit($id = null)
	{
		!Auth::check() and Response::redirect('admin');

		$message = '';

		is_null($id) and Response::redirect('labelgroup');

		if ( ! $label = Model_Labelgroup::find($id))
		{
			Session::set_flash('error', 'Could not find label #'.$id);
			Response::redirect('labelgroup');
		}

		$val = Model_Labelgroup::validate('edit');

		if ($val->run())
		{
			$label->name = Input::post('name');
			$label->remarks = Input::post('remarks');

			if ($label->save())
			{
				Session::set_flash('success', 'Updated label #' . $id);

				Response::redirect('labelgroup/list');
			}

			else
			{
				// Session::set_flash('error', 'Could not update label #' . $id);
				$message = '入力項目を確認してください。';
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$label->name = $val->validated('name');
				$label->remarks = $val->validated('remarks');

				Session::set_flash('error', $val->error());
				$message = '入力項目を確認してください。';
			}

			$this->template->set_global('label', $label, false);
		}


		$this->template->title = "LABELGROUP EDIT | JIRA TOOL";
		$data['error'] = $message;
		$data['link_base'] = Uri::base(false);
		$this->template->content = View_Twig::forge('labelgroup/edit', $data);

	}

	public function action_delete($id = null)
	{
		!Auth::check() and Response::redirect('admin');

		is_null($id) and Response::redirect('labelgroup');

		if ($label = Model_Labelgroup::find($id))
		{
			$label->delete();

			Session::set_flash('success', 'Deleted label #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete label #'.$id);
		}

		Response::redirect('labelgroup/list');

	}

}

<?php
class Controller_Admin_Memo extends Controller_Admin
{

	public function action_index()
	{
		$data['memos'] = Model_Memo::find('all');
		$this->template->title = "Memos";
		$this->template->content = View::forge('admin/memo/index', $data);

	}

	public function action_view($id = null)
	{
		$data['memo'] = Model_Memo::find($id);

		$this->template->title = "Memo";
		$this->template->content = View::forge('admin/memo/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Memo::validate('create');

			if ($val->run())
			{
				$memo = Model_Memo::forge(array(
					'name' => Input::post('name'),
				));

				if ($memo and $memo->save())
				{
					Session::set_flash('success', e('Added memo #'.$memo->id.'.'));

					Response::redirect('admin/memo');
				}

				else
				{
					Session::set_flash('error', e('Could not save memo.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Memos";
		$this->template->content = View::forge('admin/memo/create');

	}

	public function action_edit($id = null)
	{
		$memo = Model_Memo::find($id);
		$val = Model_Memo::validate('edit');

		if ($val->run())
		{
			$memo->name = Input::post('name');

			if ($memo->save())
			{
				Session::set_flash('success', e('Updated memo #' . $id));

				Response::redirect('admin/memo');
			}

			else
			{
				Session::set_flash('error', e('Could not update memo #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$memo->name = $val->validated('name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('memo', $memo, false);
		}

		$this->template->title = "Memos";
		$this->template->content = View::forge('admin/memo/edit');

	}

	public function action_delete($id = null)
	{
		if ($memo = Model_Memo::find($id))
		{
			$memo->delete();

			Session::set_flash('success', e('Deleted memo #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete memo #'.$id));
		}

		Response::redirect('admin/memo');

	}

}

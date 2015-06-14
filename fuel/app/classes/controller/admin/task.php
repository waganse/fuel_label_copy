<?php
class Controller_Admin_Task extends Controller_Admin
{

	public function action_index()
	{
		$data['tasks'] = Model_Task::find('all');
		$this->template->title = "Tasks";
		$this->template->content = View::forge('admin/task/index', $data);

	}

	public function action_view($id = null)
	{
		$data['task'] = Model_Task::find($id);

		$this->template->title = "Task";
		$this->template->content = View::forge('admin/task/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Task::validate('create');

			if ($val->run())
			{
				$task = Model_Task::forge(array(
					'name' => Input::post('name'),
				));

				if ($task and $task->save())
				{
					Session::set_flash('success', e('Added task #'.$task->id.'.'));

					Response::redirect('admin/task');
				}

				else
				{
					Session::set_flash('error', e('Could not save task.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Tasks";
		$this->template->content = View::forge('admin/task/create');

	}

	public function action_edit($id = null)
	{
		$task = Model_Task::find($id);
		$val = Model_Task::validate('edit');

		if ($val->run())
		{
			$task->name = Input::post('name');

			if ($task->save())
			{
				Session::set_flash('success', e('Updated task #' . $id));

				Response::redirect('admin/task');
			}

			else
			{
				Session::set_flash('error', e('Could not update task #' . $id));
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$task->name = $val->validated('name');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('task', $task, false);
		}

		$this->template->title = "Tasks";
		$this->template->content = View::forge('admin/task/edit');

	}

	public function action_delete($id = null)
	{
		if ($task = Model_Task::find($id))
		{
			$task->delete();

			Session::set_flash('success', e('Deleted task #'.$id));
		}

		else
		{
			Session::set_flash('error', e('Could not delete task #'.$id));
		}

		Response::redirect('admin/task');

	}

}

<?php namespace App\Http\Controllers\Backend;

use \View;
use \Input;
use App\User;
use \Redirect;
use \Validator;
use Hash;
class UserController extends BaseController {

	/**
	 * 所有用户
	 *
	 * @return Response
	 */
	public function getAll()
	{
		$users =  User::orderBy('id', 'DESC')->paginate(5);
		return view('backend.pages.user-all')->withUsers($users);
	}

	/**
	 * 添加用户
	 *
	 * @return Response
	 */
	public function getNew()
	{
		return View::make('backend.pages.user-new');
	}

	/**
	 * 创建用户
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$rules = [
			'username'=> 'required|alpha_dash|unique:users',
			'password'  => 'required|confirmed',
			'email' 	=> 'required|email|unique:users',
			// 'user_url'   => 'url',
		];

		$validator = Validator::make(Input::all(), $rules);

        	//验证失败
        	if ($validator->fails()) {

            	return Redirect::back()->withErrors($validator)->withInput(Input::all());
        	}

        	$user = new User;

       		$this->saveUser($user);

        	return Redirect::back()->withMessage('用户创建成功！', url('admin/user/list', '回到用户列表'));
	}

	/**
	 * 编辑用户
	 *
	 * @return Response
	 */
	public function getEdit($id)
	{
		$user = User::findOrFail($id);

		return View::make('backend.pages.user-edit')->withUser($user);
	}

	/**
	 * 保存用户
	 *
	 * @param integer $id
	 *
	 * @return Response
	 */
	public function postUpdate($id)
	{
		$rules = [
			'password'  => 'confirmed',
			// 'user_url'   => 'url',
		];

		$validator = Validator::make(Input::all(), $rules);

        //验证失败
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput(Input::all());
        }

		$user = User::findOrFail($id);

		$this->saveUser($user);

		return Redirect::back()->withMessage("更新成功！");
	}

	/**
	 * 删除用户
	 *
	 * @param  integer $id
	 *
	 * @return Response
	 */
	public function getDelete($id)
	{
		$user = User::whereId($id)->whereDeleteable(1)->first();

		$res = true;

		if ($user) {
			$res = $user->delete();
		}

		$message = $res ? '删除成功！' : '删除失败！';

		return Redirect::back()->withMessage($message);
	}

	/**
	 * 公用保存用户
	 *
	 * @param User $user
	 *
	 * @return void
	 */
	protected function saveUser($user)
	{
		$user->unique_id	= uniqid('', true);
		$user->username    = Input::get('username');
		$user->password     = Hash::make(Input::get('password'));
		$user->email    = Input::get('email');
		$user->nickname = Input::get('nickname');
		// $user->user_url      = Input::get('user_url');
		$user->display_name  = Input::get('display_name');

        $user->save();
	}

}

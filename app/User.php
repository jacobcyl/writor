<?php
namespace App;
//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract  {

	const STATUS_NORMAL   = 1;   //正常
	const STATUS_DISABLED = 0; //禁用
	use Authenticatable, CanResetPassword;

    // blowfish
    private static $algo = '$2a';
    // cost parameter
    private static $cost = '$10';

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * 文章
	 *
	 * @return object
	 */
	public function posts()
	{
		return $this->hasMany('App\Post', 'post_author')->with('TermRelation');
	}

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	public function getStatusNameAttribute()
	{
		switch ($this->status) {
			case 0:
				return '<label class="label label-success">正常</label>';
				break;

			default:
				# code...
				break;
		}
	}

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	public function getAuthSalt()
	{
		return self::$algo . self::$cost . '$' . self::unique_salt();
	}

    // mainly for internal use
    public static function unique_salt() {
        return substr(sha1(mt_rand()), 0, 22);
    }

}

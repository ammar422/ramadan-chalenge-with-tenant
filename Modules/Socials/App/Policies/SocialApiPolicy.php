<?php

namespace Modules\Socials\App\Policies;

use Modules\Users\App\Models\User;
use Modules\Socials\App\Models\Social;
use Illuminate\Auth\Access\HandlesAuthorization;

class SocialApiPolicy
{


	use HandlesAuthorization;

	/**
	 * @param User $user
	 * 
	 * @return bool
	 */
	public function viewAny(User $user)
	{
		return  true;
	}

	/**
	 * @param User $user
	 * @param Social $Social
	 * 
	 * @return bool
	 */
	public function view(User $user, Social $Social)
	{
		return  true;
	}

	/**
	 * @param User $user
	 * 
	 * @return bool
	 */
	public function create(User $user)
	{
		return false;
	}

	/**
	 * @param User $user
	 * @param Social $Social
	 * 
	 * @return bool
	 */
	public function update(User $user, Social $Social)
	{
		return  false;
	}

	/**
	 * @param User $user
	 * @param Social $Social
	 * 
	 * @return bool
	 */
	public function delete(User $user, Social $Social)
	{
		return false;
	}
}

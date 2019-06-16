<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $gravatarLink = "https://www.gravatar.com/avatar/%s/?d=mm&s=%d";

	protected $fillable = [
		'username', 'email', 'name', 'avatar', 'rank_id', 'is_admin', 'subscribe_newsletter', 'displayed_name', 'avatar_image','password', 'remember_token', 'verify_token', 'wallet', 'got_rank', 'rank_expire'
	];

	protected $hidden = [
		'password', 'remember_token', 'verify_token'
	];

    /**
     * Useful methods
     */
    public function getNameOrUsername()
    {
    	return ($this->displayed_name == 'username' ? $this->username : (is_null($this->name) || empty($this->name) ? 'Herobrine' : $this->name) );
    }

    public function getAvatarImage($size = 32, $class=null)
    {
        switch($this->avatar_image) {
            case 'gravatar':
                if (is_null($class))
                    return sprintf("<img src=\"" . $this->gravatarLink ."\" alt=\"Felhasználó avatárja\">", md5($this->email), $size);
                else
                    return sprintf("<img src=\"" . $this->gravatarLink ."\" alt=\"Felhasználó avatárja\" class=\"%s\">", md5($this->email), $size, $class);
                break;
            case 'skin':
                return sprintf("<img src=\"%s\" alt=\"Felhasználó avatárja\" width=\"%d\" class=\"%s\">", (!$this->hasSkin()) ? 'files/skins/default.png' : 'files/skins/' . $this->username .'.png', $size, $class);
        }
    }

    public function hasSkin()
    {
    	return (bool) file_exists(public_path('files/skins/') . $this->username . '.png');
    }

    public function isAdmin()
    {
    	return (bool) $this->is_admin;
    }

    public function hasRank()
    {
        return $this->rank_id != 0 ? true : false;
    }

    public function getRankName()
    {
        if ($this->rank_id != 0)
            return $this->Rank()->name;

        return 'Felhasználó';
    }

    public function Rank()
    {
    	return $this->hasOne('App\Ranks', 'id', 'rank_id')->first();
    }
}

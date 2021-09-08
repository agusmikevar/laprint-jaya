<?php

namespace Bsb\Foundation\Http;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Bsb\Foundation\Database\Eloquent\{
    AuthModel,
    AuthModelException,
};

class Authentication
{
    /**
     * @param  string  $type
     * @param  array  $refs
     * @return bool
     */
    public static function authenticate(string $type, array $refs)
    {
        $instance = static::getInstance($type, $refs);

        $userClass = config('auth.providers.users.model');
        $user = $userClass::findOrFail(Auth::id());
        $role = $user->role;

        return ! is_null($role->{Str::camel(Str::plural($type))}()
            ->find($instance->id));
    }

    /**
     * @param  string  $type
     * @param  array  $refs
     * @return \Bsb\Foundation\Eloquent\AuthModel
     */
    public static function getInstance(string $type, array $refs)
    {
        $model = config('bsb_foundation.http.request.'.$type.'.model');
        if ( ! (new $model) instanceof AuthModel) {
            $exception = new AuthModelException;
            $exception->problem('model_has_no_contract');
            throw new $exception;
        }

        return $model::getAuthorization($refs);
    }
}

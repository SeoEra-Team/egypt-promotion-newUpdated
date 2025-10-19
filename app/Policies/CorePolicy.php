<?php

namespace App\Policies;

use App\Models\Administrator;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class CorePolicy
 * @package App\Policies
 */
class CorePolicy
{
    use HandlesAuthorization;

    /**
     * @param Administrator $administrator
     * @return bool
     */
    public function viewAny(Administrator $administrator): bool
    {
        return $administrator->hasPermissionTo('viewAny ' . static::$key);
    }

    /**
     * @param Administrator $administrator
     * @return bool
     */
    public function view(Administrator $administrator): bool
    {
        return $administrator->hasPermissionTo('view ' . static::$key);
    }

    /**
     * @param Administrator $administrator
     * @return bool
     */
    public function create(Administrator $administrator): bool
    {
        return $administrator->hasPermissionTo('create ' . static::$key);
    }

    /**
     * @param Administrator $administrator
     * @return bool
     */
    public function update(Administrator $administrator): bool
    {
        return $administrator->hasPermissionTo('update ' . static::$key);
    }

    /**
     * @param Administrator $administrator
     * @return bool
     */
    public function delete(Administrator $administrator): bool
    {
        return $administrator->hasPermissionTo('delete ' . static::$key);
    }

    /**
     * @param Administrator $administrator
     * @return bool
     */
    public function restore(Administrator $administrator): bool
    {
        return $administrator->hasPermissionTo('restore ' . static::$key);
    }

    /**
     * @param Administrator $administrator
     * @return bool
     */
    public function forceDelete(Administrator $administrator): bool
    {
        return $administrator->hasPermissionTo('forceDelete ' . static::$key);
    }
}

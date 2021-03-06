<?php
/**
 * Created by PhpStorm.
 * User: Hugo
 * Date: 9/5/2019
 * Time: 12:43 AM
 */

namespace App\Services;

use App\Admin;
use App\Events\AdminCreated;
use App\Events\AdminUpdated;

class AdminService
{
    public function store(array $values)
    {
        ($admin = new Admin)->fill($values);

        $admin->save();

        event(new AdminCreated($admin));

        return $admin;
    }

    public function update(Admin $admin, array $values)
    {
        $admin->fill($values);

        $admin->save();

        event(new AdminUpdated($admin));

        return $admin;
    }
}

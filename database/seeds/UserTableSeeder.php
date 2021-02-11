<?php

use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        Sentinel::registerAndActivate([
            'email'         => 'test@infihex.com',
            'password'      => '12345678', // Den hash'r automatisk
            'firstname'     => 'Daniel',
            'lastname'      => 'SADMIN',
            'username'      => 'sadmin',
            'referral_code' => str_random(15),
            'last_activity' => Carbon::now(),
        ]);
        if (env('app.debug')) {
            Sentinel::registerAndActivate([
                'email'         => 'test2@infihex.com',
                'password'      => '12345678', // Den hash'r automatisk
                'firstname'     => 'John',
                'lastname'      => 'ADMIN',
                'username'      => 'admin',
                'referral_code' => str_random(15),
                'last_activity' => Carbon::now(),
            ]);
            Sentinel::registerAndActivate([
                'email'         => 'test3@infihex.com',
                'password'      => '12345678', // Den hash'r automatisk
                'firstname'     => 'John',
                'lastname'      => 'MOD',
                'username'      => 'mod',
                'referral_code' => str_random(15),
                'last_activity' => Carbon::now(),
            ]);
            Sentinel::registerAndActivate([
                'email'         => 'test4@infihex.com',
                'password'      => '12345678', // Den hash'r automatisk
                'firstname'     => 'John',
                'lastname'      => 'USER',
                'username'      => 'user',
                'referral_code' => str_random(15),
                'last_activity' => Carbon::now(),
            ]);
            Sentinel::registerAndActivate([
                'email'         => 'test5@infihex.com',
                'password'      => '12345678', // Den hash'r automatisk
                'firstname'     => 'John',
                'lastname'      => 'USER2',
                'username'      => 'user2',
                'referral_code' => str_random(15),
                'last_activity' => Carbon::now(),
            ]);
        }

        //Create Roles
        Artisan::call('lanms:refreshpermissions');
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => 'Super Administrators',
            'slug' => 'superadmin',
        ]);
        if (env('app.debug')) {
            $role = Sentinel::getRoleRepository()->createModel()->create([
                'name' => 'Administrators',
                'slug' => 'admin',
            ]);
            $role = Sentinel::getRoleRepository()->createModel()->create([
                'name' => 'Moderators',
                'slug' => 'mod',
            ]);
        }

        // Add users to groups
        $user = Sentinel::findById(1);
        $role = Sentinel::findRoleByName('Super Administrators');
        $role->users()->attach($user);

        if (env('app.debug')) {
            $user = Sentinel::findById(2);
            $role = Sentinel::findRoleByName('Administrators');
            $role->users()->attach($user);

            $user = Sentinel::findById(3);
            $role = Sentinel::findRoleByName('Moderators');
            $role->users()->attach($user);
        }

        //Add permissions to roles
        $role = Sentinel::findRoleByName('Super Administrators');

        $role->addPermission('admin');//admin panel access

        $role->addPermission('admin.compo.create');
        $role->addPermission('admin.compo.update');
        $role->addPermission('admin.compo.destroy');
        $role->addPermission('admin.compo.restore');

        $role->addPermission('admin.crew.create');
        $role->addPermission('admin.crew.update');
        $role->addPermission('admin.crew.destroy');
        $role->addPermission('admin.crew.restore');

        $role->addPermission('admin.crew-category.create');
        $role->addPermission('admin.crew-category.update');
        $role->addPermission('admin.crew-category.destroy');
        $role->addPermission('admin.crew-category.restore');

        $role->addPermission('admin.crew-skill.create');
        $role->addPermission('admin.crew-skill.update');
        $role->addPermission('admin.crew-skill.destroy');
        $role->addPermission('admin.crew-skill.restore');

        $role->addPermission('admin.news.create');
        $role->addPermission('admin.news.update');
        $role->addPermission('admin.news.destroy');
        $role->addPermission('admin.news.restore');

        $role->addPermission('admin.newscategory.create');
        $role->addPermission('admin.newscategory.update');
        $role->addPermission('admin.newscategory.destroy');
        $role->addPermission('admin.newscategory.restore');

        $role->addPermission('admin.pages.create');
        $role->addPermission('admin.pages.update');
        $role->addPermission('admin.pages.destroy');
        $role->addPermission('admin.pages.restore');

        $role->addPermission('admin.seating.row.create');
        $role->addPermission('admin.seating.row.update');
        $role->addPermission('admin.seating.row.destroy');
        $role->addPermission('admin.seating.row.restore');

        $role->addPermission('admin.seating.seat.create');
        $role->addPermission('admin.seating.seat.update');
        $role->addPermission('admin.seating.seat.destroy');
        $role->addPermission('admin.seating.seat.restore');

        $role->addPermission('admin.seating.styling');

        $role->addPermission('admin.reservation.create');
        $role->addPermission('admin.reservation.update');
        $role->addPermission('admin.reservation.destroy');
        $role->addPermission('admin.reservation.restore');

        $role->addPermission('admin.checkin.create');
        $role->addPermission('admin.checkin.update');
        $role->addPermission('admin.checkin.destroy');
        $role->addPermission('admin.checkin.restore');

        $role->addPermission('admin.print.create');
        $role->addPermission('admin.print.update');
        $role->addPermission('admin.print.destroy');
        $role->addPermission('admin.print.restore');

        $role->addPermission('admin.info.update');

        $role->addPermission('admin.sponsor.create');
        $role->addPermission('admin.sponsor.update');
        $role->addPermission('admin.sponsor.destroy');
        $role->addPermission('admin.sponsor.restore');

        $role->addPermission('admin.sms.create');

        $role->addPermission('admin.users.update');
        $role->addPermission('admin.users.destroy');
        $role->addPermission('admin.users.restore');

        $role->addPermission('admin.role.create');
        $role->addPermission('admin.role.update');
        $role->addPermission('admin.role.destroy');

        $role->addPermission('admin.billing.create');
        $role->addPermission('admin.billing.update');
        $role->addPermission('admin.billing.destroy');

        $role->addPermission('admin.emails.show');
        $role->addPermission('admin.emails.create');

        $role->addPermission('admin.settings.update');
        $role->addPermission('admin.license.update');

        $role->save();

        if (env('app.debug')) {
            $role = Sentinel::findRoleByName('Administrators');

            $role->addPermission('admin');//admin panel access

            $role->addPermission('admin.compo.create');
            $role->addPermission('admin.compo.update');
            $role->addPermission('admin.compo.destroy');

            $role->addPermission('admin.crew.create');
            $role->addPermission('admin.crew.update');
            $role->addPermission('admin.crew.destroy');

            $role->addPermission('admin.crew-category.create');
            $role->addPermission('admin.crew-category.update');
            $role->addPermission('admin.crew-category.destroy');

            $role->addPermission('admin.crew-skill.create');
            $role->addPermission('admin.crew-skill.update');
            $role->addPermission('admin.crew-skill.destroy');

            $role->addPermission('admin.news.create');
            $role->addPermission('admin.news.update');
            $role->addPermission('admin.news.destroy');

            $role->addPermission('admin.newscategory.create');
            $role->addPermission('admin.newscategory.update');
            $role->addPermission('admin.newscategory.destroy');

            $role->addPermission('admin.pages.create');
            $role->addPermission('admin.pages.update');
            $role->addPermission('admin.pages.destroy');

            $role->addPermission('admin.seating.row.create');
            $role->addPermission('admin.seating.row.update');
            $role->addPermission('admin.seating.row.destroy');

            $role->addPermission('admin.seating.seat.create');
            $role->addPermission('admin.seating.seat.update');
            $role->addPermission('admin.seating.seat.destroy');

            $role->addPermission('admin.users.update');
            $role->addPermission('admin.users.destroy');

            $role->addPermission('admin.seating.styling');

            $role->addPermission('admin.reservation.create');
            $role->addPermission('admin.reservation.update');
            $role->addPermission('admin.reservation.destroy');

            $role->addPermission('admin.checkin.create');
            $role->addPermission('admin.checkin.update');
            $role->addPermission('admin.checkin.destroy');

            $role->addPermission('admin.print.create');
            $role->addPermission('admin.print.update');
            $role->addPermission('admin.print.destroy');

            $role->addPermission('admin.info.update');

            $role->addPermission('admin.sponsor.create');
            $role->addPermission('admin.sponsor.update');
            $role->addPermission('admin.sponsor.destroy');

            $role->addPermission('admin.users.update');
            $role->addPermission('admin.users.destroy');

            $role->addPermission('admin.billing.create');
            $role->addPermission('admin.billing.update');

            $role->save();

            $role = Sentinel::findRoleByName('Moderators');

            $role->addPermission('admin');//admin panel access

            $role->addPermission('admin.compo.create');
            $role->addPermission('admin.compo.update');

            $role->addPermission('admin.crew.create');
            $role->addPermission('admin.crew.update');

            $role->addPermission('admin.crew-category.create');
            $role->addPermission('admin.crew-category.update');

            $role->addPermission('admin.crew-skill.create');
            $role->addPermission('admin.crew-skill.update');

            $role->addPermission('admin.news.create');
            $role->addPermission('admin.news.update');

            $role->addPermission('admin.newscategory.create');
            $role->addPermission('admin.newscategory.update');

            $role->addPermission('admin.pages.create');
            $role->addPermission('admin.pages.update');

            $role->addPermission('admin.seating.row.create');
            $role->addPermission('admin.seating.row.update');

            $role->addPermission('admin.reservation.create');
            $role->addPermission('admin.reservation.update');

            $role->addPermission('admin.seating.seat.create');
            $role->addPermission('admin.seating.seat.update');

            $role->addPermission('admin.checkin.create');
            $role->addPermission('admin.checkin.update');

            $role->addPermission('admin.print.create');
            $role->addPermission('admin.print.update');

            $role->addPermission('admin.sponsor.create');
            $role->addPermission('admin.sponsor.update');

            $role->save();
        }
    }
}

<?php

namespace LANMS\Console\Commands;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Cartalyst\Sentinel\Roles\EloquentRole;
use Illuminate\Console\Command;

class RefreshPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lanms:refreshpermissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will refresh permissions for roles. For example; adding new permissions that a roles is missing.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $default_role = Sentinel::findRoleBySlug('default');
        if (!$default_role) {
            $this->info('Default role not found, creating one.');
            $default_role = Sentinel::getRoleRepository()->createModel()->create([
                'name' => 'Default',
                'slug' => 'default',
            ]);
        }

        $default_role->addPermission('admin', false);

        $default_role->addPermission('admin.compo.create', false);
        $default_role->addPermission('admin.compo.update', false);
        $default_role->addPermission('admin.compo.destroy', false);
        $default_role->addPermission('admin.compo.restore', false);

        $default_role->addPermission('admin.crew.create', false);
        $default_role->addPermission('admin.crew.update', false);
        $default_role->addPermission('admin.crew.destroy', false);
        $default_role->addPermission('admin.crew.restore', false);

        $default_role->addPermission('admin.crew-category.create', false);
        $default_role->addPermission('admin.crew-category.update', false);
        $default_role->addPermission('admin.crew-category.destroy', false);
        $default_role->addPermission('admin.crew-category.restore', false);

        $default_role->addPermission('admin.crew-skill.create', false);
        $default_role->addPermission('admin.crew-skill.update', false);
        $default_role->addPermission('admin.crew-skill.destroy', false);
        $default_role->addPermission('admin.crew-skill.restore', false);

        $default_role->addPermission('admin.news.create', false);
        $default_role->addPermission('admin.news.update', false);
        $default_role->addPermission('admin.news.destroy', false);
        $default_role->addPermission('admin.news.restore', false);

        $default_role->addPermission('admin.newscategory.create', false);
        $default_role->addPermission('admin.newscategory.update', false);
        $default_role->addPermission('admin.newscategory.destroy', false);
        $default_role->addPermission('admin.newscategory.restore', false);

        $default_role->addPermission('admin.pages.create', false);
        $default_role->addPermission('admin.pages.update', false);
        $default_role->addPermission('admin.pages.destroy', false);
        $default_role->addPermission('admin.pages.restore', false);

        $default_role->addPermission('admin.seating.row.create', false);
        $default_role->addPermission('admin.seating.row.update', false);
        $default_role->addPermission('admin.seating.row.destroy', false);
        $default_role->addPermission('admin.seating.row.restore', false);

        $default_role->addPermission('admin.reservation.create', false);
        $default_role->addPermission('admin.reservation.update', false);
        $default_role->addPermission('admin.reservation.destroy', false);
        $default_role->addPermission('admin.reservation.restore', false);

        $default_role->addPermission('admin.seating.seat.create', false);
        $default_role->addPermission('admin.seating.seat.update', false);
        $default_role->addPermission('admin.seating.seat.destroy', false);
        $default_role->addPermission('admin.seating.seat.restore', false);

        $default_role->addPermission('admin.seating.styling', false);

        $default_role->addPermission('admin.checkin.create', false);
        $default_role->addPermission('admin.checkin.update', false);
        $default_role->addPermission('admin.checkin.destroy', false);
        $default_role->addPermission('admin.checkin.restore', false);

        $default_role->addPermission('admin.print.create', false);
        $default_role->addPermission('admin.print.update', false);
        $default_role->addPermission('admin.print.destroy', false);
        $default_role->addPermission('admin.print.restore', false);

        $default_role->addPermission('admin.info.update', false);

        $default_role->addPermission('admin.sponsor.create', false);
        $default_role->addPermission('admin.sponsor.update', false);
        $default_role->addPermission('admin.sponsor.destroy', false);
        $default_role->addPermission('admin.sponsor.restore', false);

        $default_role->addPermission('admin.users.update', false);
        $default_role->addPermission('admin.users.destroy', false);
        $default_role->addPermission('admin.users.restore', false);

        $default_role->addPermission('admin.role.create', false);
        $default_role->addPermission('admin.role.update', false);
        $default_role->addPermission('admin.role.destroy', false);

        $default_role->addPermission('admin.billing.create', false);
        $default_role->addPermission('admin.billing.update', false);
        $default_role->addPermission('admin.billing.destroy', false);

        $default_role->addPermission('admin.settings.update', false);
        $default_role->addPermission('admin.license.update', false);

        $default_role->save();

        $this->info('Saved default role.');

        $roles = EloquentRole::all();
        foreach ($roles as $role) {
            if ($role->slug == 'superadmin') {
                $perm = true;
            } else {
                $perm = false;
            }
            foreach ($default_role->permissions as $key => $value) {
                $role->addPermission($key, $perm)->save();
                $this->info('Adding '.$key.' to '.$role->name);
            }
        }

        $this->info('Done.');
    }
}

<?php
/*
|--------------------------------------------------------------------------
| 1. MIGRATION: model_access_controls
|--------------------------------------------------------------------------
*/
Schema::create('model_access_controls', function (Blueprint $table) {
$table->id();
$table->morphs('model');
// Document, Workflow, etc.
$table->string('action');
// view | create | update
$table->string('role');
// ut_admin, st_hr, jt_manager, rt_approver
$table->timestamps();
});

/*
|--------------------------------------------------------------------------
| 2. MODEL: ModelAccessControl
|--------------------------------------------------------------------------
*/
class ModelAccessControl extends Model
{
protected $fillable = [
'action',
'role',
];
public function model()
{
return $this->morphTo();
}
}

/*
|--------------------------------------------------------------------------
| 3. TRAIT: HasAccessControl (attach to ANY model)
|--------------------------------------------------------------------------
*/
trait HasAccessControl
{
public function accessControls()
{
return $this->morphMany(ModelAccessControl::class, 'model');
}
public function canRole(string $action, User $user): bool
{
$roles = $user->getRoleNames();
return $this->accessControls()
->where('action', $action)
->whereIn('role', $roles)
->exists();
}
}

/*
|--------------------------------------------------------------------------
| 4. TRAIT: SavesAccessControl (Filament persistence)
|--------------------------------------------------------------------------
*/
trait SavesAccessControl
{
public static function bootSavesAccessControl()
{
static::saved(function ($model) {
if (!request()->has('access')) {
return;
}
$model->accessControls()->delete();
foreach (request('access') as $action => $roles) {
foreach ($roles ?? [] as $role) {
$model->accessControls()->create([
'action' => $action,
'role' => $role,
]);
}
}
});
}
}

/*
|--------------------------------------------------------------------------
| 5. ROLE SYNC SERVICE (Hierarchy resolver)
|--------------------------------------------------------------------------
*/
class SyncEffectiveRoles
{
public static function handle(User $user): void
{
$roles = collect();
// direct user roles
$roles = $roles->merge($user->roles()->pluck('name'));
// staff level
if ($user->staff) {
$roles = $roles->merge($user->staff->roles()->pluck('name'));
// job position level
if ($jp = $user->staff->jobPosition) {
$roles = $roles->merge($jp->roles()->pluck('name'));
// job role level
if ($jp->jobRole) {
$roles = $roles->merge($jp->jobRole->roles()->pluck('name'));
}
}
}
$user->syncRoles($roles->unique()->values());
}
}

/*
|--------------------------------------------------------------------------
| 6. EVENT HOOKS (sync triggers)
|--------------------------------------------------------------------------
*/
// On login
Event::listen(Login::class, function ($event) {
SyncEffectiveRoles::handle($event->user);
});
// When staff changes
Staff::saved(function ($staff) {
SyncEffectiveRoles::handle($staff->user);
});
// When job position changes
JobPosition::saved(function ($jp) {
foreach ($jp->staff as $staff) {
SyncEffectiveRoles::handle($staff->user);
}
});
// When job role changes
JobRole::saved(function ($jr) {
foreach ($jr->jobPositions as $jp) {
foreach ($jp->staff as $staff) {
SyncEffectiveRoles::handle($staff->user);
}
}
});

/*
|--------------------------------------------------------------------------
| 7. FILAMENT: Reusable Access Control Schema
|--------------------------------------------------------------------------
*/
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\CheckboxList;
use Spatie\Permission\Models\Role;
class AccessControlSchema
{
public static function make(): Section
{
return Section::make('Access Control')
->schema([
Tabs::make('Permissions')
->tabs([
Tabs\Tab::make('View')
->schema([
self::field('view'),
]),
Tabs\Tab::make('Create')
->schema([
self::field('create'),
]),
Tabs\Tab::make('Update')
->schema([
self::field('update'),
]),
]),
]);
}
protected static function field(string $action)
{
return CheckboxList::make("access.$action")
->label(ucfirst($action) . ' Roles')
->options(self::groupedRoles())
->columns(2);
}
protected static function groupedRoles(): array
{
return [
'User Roles' => Role::where('name', 'like', 'ut_%')
->pluck('name', 'name')
->toArray(),
'Staff Roles' => Role::where('name', 'like', 'st_%')
->pluck('name', 'name')
->toArray(),
'Job Positions' => Role::where('name', 'like', 'jt_%')
->pluck('name', 'name')
->toArray(),
'Job Roles' => Role::where('name', 'like', 'rt_%')
->pluck('name', 'name')
->toArray(),
];
}
}

/*
|--------------------------------------------------------------------------
| 8. USAGE IN ANY FILAMENT RESOURCE (Document / Workflow)
|--------------------------------------------------------------------------
*/
// Example: Document model
class Document extends Model
{
use HasAccessControl, SavesAccessControl;
}
// Example Filament Resource
class DocumentResource extends Resource
{
public static function form(Form $form): Form
{
return $form->schema([
TextInput::make('title'),
AccessControlSchema::make(),
]);
}
}

/*
|--------------------------------------------------------------------------
| 9. AUTH CHECK (runtime usage)
|--------------------------------------------------------------------------
*/
function can(User $user, string $action, Model $model): bool
{
return $model->accessControls()
->where('action', $action)
->whereIn('role', $user->getRoleNames())
->exists();
}

/*
|--------------------------------------------------------------------------
| 10. RESULTING ARCHITECTURE
|--------------------------------------------------------------------------
*/
/*
✔ Spatie = identity roles
✔ Sync service = hierarchical inheritance
✔ AccessControl = per-record permissions
✔ Filament schema = reusable UI
✔ Works for ANY model (Document, Workflow, DMS, etc.)
*/
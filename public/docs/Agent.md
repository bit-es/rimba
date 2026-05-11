🤖 AI Agent Instructions (aiagent.md)

Purpose

This document defines how an AI agent should generate, connect, and maintain modules in the Enterprise OS built with:

Laravel 13
Filament v5
Spatie Permission

The AI must follow strict architectural rules to avoid tight coupling and ensure scalability.

🧱 1. Core Principles

1.1 Layered Architecture

PLATFORM → FOUNDATION → BUSINESS → SUPPORT

Rules:

Lower layers MUST NOT depend on higher layers
FOUNDATION is the core
BUSINESS uses FOUNDATION
SUPPORT reacts via events
1.2 Two Database Strategy

SYSTEM DB

Config
Templates
Definitions
COMPANY DB
Runtime data
Transactions
Business records
1.3 Dependency Rules

Allowed:

Package → Contracts
Package → Actions
Package → Events
Forbidden:
Direct model access across packages
Circular dependencies
🔌 2. Package Interaction Rules

2.1 Contracts First

Every package MUST expose interfaces:

Example:

interface OrgServiceInterface

{

    public function getUsersByJobPosition(string $jobPositionId);

}

2.2 Actions as Entry Points

All business logic MUST be executed via Actions.

Example:

class StartWorkflowAction

{

    public function execute(string $workflowKey, Model $subject)

    {

        // logic

    }

}

2.3 Events for Side Effects

Use events for:

Notifications
Audit logs
Async processes
Example:

event(new TaskAssigned($task));

2.4 No Direct Model Coupling

❌ Forbidden:

Staff::find($id);

✅ Correct:

app(OrgServiceInterface::class)->findUserByStaffId($id);

🧩 3. Package Responsibilities

PLATFORM
    UI (Filament)
    Branding
    Auth
    Sync
FOUNDATION
    Org
    Workflow
    Access
BUSINESS
    DMS
    SOR
    LMS
    Asset
SUPPORT
    Notification
    Audit
    Reporting
    
⚙️ 4. Migration Rules
Each package owns its migrations
Split into:
system/
company/
Use base classes:
abstract class SystemMigration extends Migration
{
    protected $connection = 'system';
}
⁠
abstract class CompanyMigration extends Migration
{
    protected $connection = 'company';
}
🧠 5. Workflow Integration Rules
Workflow is the central engine
All approvals MUST go through Workflow
Flow:

Business module triggers Action

Workflow creates instance
Tasks assigned via Org
Events emitted
Support modules react
🔐 6. Auth vs Access

Auth:

Identity (login)
Access:
Permissions (Spatie)
Rules:
Do NOT mix Auth logic into Access
Roles should be derived from Org
🔄 7. Sync Rules
Sync writes ONLY to COMPANY DB
NEVER expose external schema directly
Always map fields
Flow:

HR DB → Sync → Org Tables

🎨 8. UI Rules (Filament)

UI must be config-driven
Prefer schema-based resources
Avoid hardcoding forms
🚀 9. Code Generation Rules

When generating a module, AI MUST:

Create package structure

Define migrations (system/company)
Create models
Define contracts
Implement actions
Register events
Add Filament resources
⚠️ 10. Anti-Patterns

❌ Direct DB joins across packages

❌ Business logic inside controllers

❌ Static helper classes

❌ Cross-package model imports

✅ 11. Golden Rules

Depend on Contracts
Execute via Actions
React via Events
Keep Workflow central
Separate System vs Company data
🧭 12. Example Flow

Service Request:

CreateServiceRequestAction

StartWorkflowAction
WorkflowInstance created
TaskAssigned event
Notification sent
Audit logged
END OF FILE

📦 13. Full Package Skeleton (Composer + Service Provider)

This defines the standard structure every package MUST follow.

13.1 Folder Structure

packages/{layer}/{package}/

├── composer.json

├── src/

│   ├── Providers/

│   │   └── {Package}ServiceProvider.php

│   ├── Contracts/

│   ├── Actions/

│   ├── Models/

│   ├── Events/

│   ├── Listeners/

│   └── Facades/ (optional)

│

├── database/

│   └── migrations/

│       ├── system/

│       └── company/

│

├── resources/

│   └── filament/

│       ├── Resources/

│       └── Pages/

│

└── routes/ (optional)

13.2 composer.json Template

{

  "name": "vendor/package-name",

  "description": "Package description",

  "type": "library",

  "license": "MIT",

  "autoload": {

    "psr-4": {

      "Vendor\PackageName\": "src/"

    }

  },

  "extra": {

    "laravel": {

      "providers": [

        "Vendor\PackageName\Providers\PackageServiceProvider"

      ]

    }

  },

  "require": {

    "php": "^8.2",

    "illuminate/support": "^12.0|^13.0"

  }

}

13.3 Service Provider Template

namespace Vendor\PackageName\Providers;



use Illuminate\Support\ServiceProvider;



class PackageServiceProvider extends ServiceProvider

{

    public function register(): void

    {

        // Bind contracts to implementations

    }



    public function boot(): void

    {

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/system');

        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations/company');

    }

}

13.4 Contract + Binding Example

interface ExampleServiceInterface

{

    public function handle(string $id);

}

class ExampleService implements ExampleServiceInterface

{

    public function handle(string $id)

    {

        // logic

    }

}

$this->app->bind(

    ExampleServiceInterface::class,

    ExampleService::class

);

13.5 Action Example

class ExampleAction

{

    public function execute(array $data)

    {

        // business logic

    }

}

13.6 Event + Listener Example

class SomethingHappened

{

    public function __construct(public array $data) {}

}

class HandleSomething

{

    public function handle(SomethingHappened $event)

    {

        // side effect

    }

}

13.7 Filament Resource Rule

UI inside package
No business logic in UI
13.8 Naming Conventions
Action: VerbNounAction
Contract: SomethingInterface
Service: SomethingService
Event: PastTense
Listener: VerbSomething
13.9 Dependency Example

"require": {

  "foundation/org": "*",

  "foundation/workflow": "*"

}
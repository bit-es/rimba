# Common structure for Rimba Starter Kit

```text
└── config/                         # configuration files
└── database/                       # database migrations
└── util/                           # any backend use utility classes
└── app/Trees/<Tree name>/
      ├── Actions/                  # Single business workflow classes (The "What")
      ├── Builders/                 # Custom database query scopes (The "Where")
      ├── Events/                   # Plain data structures reporting past system mutations
      ├── Http/UI/Admin/Resources   # Filament Resource for Admin Panel
      ├── Http/UI/Admin/Pages       # Filament Pages for Admin Panel
      ├── Http/UI/Admin/Widgets     # Filament Widgets for Admin Panel
      ├── Http/UI/Staff/Resources   # Filament Resource for Staff Panel
      ├── Http/UI/Staff/Pages       # Filament Pages for Staff Panel
      ├── Http/UI/Staff/Widgets     # Filament Widgets for Staff Panel
      ├── Http/API/Resources        # JSON API for Models classes
      ├── Jobs/                     # Asynchronous queue workers offloading network/heavy tasks
      ├── Listeners/                # Reactive workers waiting to handle specific Event payloads
      ├── Models/                   # Database relationships, column casting, and table mappings
      ├── Observers/                # Automated low-level lifecycle DB hooks
      ├── Policies/                 # Authorization checks guarding Models and Filament Resources
      └── Services/                 # Wrapper layer for third-party tools and complex algorithms
```

# Naming Standards

## Action classes

| Grouping | Verb | When to Use It (Comment) | Example Action Class |
| :--- | :--- | :--- | :--- |
| **Creating** | **Create** | When adding a brand new record to your database. | `CreateUser`, `CreateInvoice` |
| | **Register** | Specifically for onboarding new users, guests, or tenants. | `RegisterNewCompany`, `RegisterGuest` |
| | **Store** | When saving raw files or specific data chunks. | `StoreProductDetails`, `StoreUploadedFile` |
| | **Generate** | When making something new from existing data (like PDFs). | `GenerateMonthlyReport`, `GenerateInvoicePdf` |
| | **Publish** | When making draft content visible to the public. | `PublishBlogPost`, `PublishProductListing` |
| **Updating** | **Update** | When changing data that already exists in the system. | `UpdateUserProfile`, `UpdateCartQuantity` |
| | **Change** | When swapping one specific state or value for another. | `ChangeUserPassword`, `ChangeSubscriptionPlan` |
| | **Reset** | When clearing a value back to its original blank or default state. | `ResetPassword`, `ResetLoginAttempts` |
| | **Sync** | When matching database relationships to a specific list. | `SyncUserRoles`, `SyncProductInventory` |
| | **Toggle** | When switching a feature between on and off. | `ToggleFeatureFlag`, `ToggleUserStatus` |
| **Removing** | **Delete** | When permanently wiping a record from the database. | `DeleteAccount`, `DeleteComment` |
| | **Remove** | When taking an item out of a collection, group, or cart. | `RemoveItemFromCart`, `RemoveUserFromTeam` |
| | **Archive** | When hiding old data without fully deleting it from the system. | `ArchiveOldLogs`, `ArchiveInactiveUsers` |
| | **Cancel** | When stopping a continuous process or an upcoming event. | `CancelSubscription`, `CancelOrder` |
| | **Disable** | When turning off a user feature or locking an account safely. | `DisableTwoFactorAuth`, `DisableUser` |
| **Processing** | **Process** | For heavy business rules or multi-step payment tasks. | `ProcessOrderPayment`, `ProcessRefund` |
| | **Calculate** | When running math formulas to get a total amount. | `CalculateOrderTotal`, `CalculateTax` |
| | **Send** | When pushing out communications like emails, texts, or alerts. | `SendWelcomeEmail`, `SendSlackNotification` |
| | **Verify** | When checking if a piece of token or user input is valid. | `VerifyEmailAddress`, `VerifyCouponCode` |
| | **Import** / **Export** | When moving large chunks of data in or out of the app via files. | `ImportUsersFromCsv`, `ExportFinancialData` |
| | **Apply** | When putting a rule or a fee onto a specific total. | `ApplyDiscountCode`, `ApplyLateFee` |
| **Security** | **Login** / **Logout** | For handling user session entry and exit safely. | `LoginUser`, `LogoutAllDevices` |

## Services classes
| Grouping | Service Name | When to Use It (Comment) | Common Methods Inside |
| :--- | :--- | :--- | :--- |
| **Third-Party APIs** | `StripeService` | For talking to outside APIs or tools. | `charge()`, `refund()`, `createCustomer()` |
| | `TwilioService` | For sending SMS or managing phone systems. | `sendSms()`, `verifyNumber()` |
| | `AwsS3Service` | For managing cloud file assets. | `upload()`, `delete()`, `generatePresignedUrl()` |
| **Complex Business** | `PayrollService` | For heavy internal domain logic with math. | `calculateSalary()`, `disburseFunds()` |
| | `TaxService` | For calculating complicated rates and fees. | `getRateForZip()`, `calculateTotalTax()` |
| | `InventoryService` | For tracking stock movements across warehouses. | `reserveStock()`, `restockItem()` |
| **System Utilities** | `MarkdownService` | For converting text formats or parsing data. | `toHtml()`, `stripTags()` |
| | `GeocodingService` | For translating addresses to map coordinates. |

## Concerns or Traits

 | Grouping | Trait Name | When to Use It (Comment) | What It Adds to the Model |
| :--- | :--- | :--- | :--- |
| **Capabilities** | `HasProfilePhoto` | Adds the ability to have an avatar image. | `getAvatarUrl()`, `uploadPhoto()` |
| | `HasAddresses` | Adds shipping or billing address links. | `addresses()`, `primaryAddress()` |
| | `HasUuid` | Automatically generates a unique text ID on boot. | Sets the key type to UUID. |
| **Relationships** | `HasTeams` | For models that belong to a group or company. | `teams()`, `currentTeam()` |
| | `HasRoles` | For giving users access permissions. | `assignRole()`, `hasPermissionTo()` |
| **Behaviors** | `Publishable` | Allows content to be hidden or made public. | `scopePublished()`, `publish()` |
| | `Archivable` | Allows records to be safely tucked away. | `scopeArchived()`, `archive()` |
| | `Likeable` | Allows users to give a thumbs-up to a model. | `likes()`, `like()`, `unlike()` |

## rest of classes ....


| Grouping / Folder | Naming Rule | When to Use It (Comment) | Clean Example |
| :--- | :--- | :--- | :--- |
| **Builders** | `[ModelName]Builder` | Custom database query scopes. It holds your custom `where` logic. | `OrderBuilder`, `UserBuilder` |
| **Events** | `[Noun] + [Past-Tense Verb]` | Plain data structures reporting something that *already happened*. | `OrderPlaced`, `UserRegistered` |
| **API Resources** | `[ModelName]Resource` | JSON transformers that clean up database data for your API. | `UserResource`, `InvoiceResource` |
| **Jobs** | `[Verb] + [Noun]` | Async queue workers doing heavy tasks in the background. Wrap around an action class for clean code. | `SendWelcomeEmail`, `ProcessVideoUpload` |
| **Listeners** | `[Verb] + [EventName]` or `[Action]` | Reactive workers that run automatically when an event fires. Wrap around an action class for clean code. | `SendOrderConfirmation`, `UpdateInventoryCount` |

```text
Rimba Authorization System
├── Identity Layer (WHO)
│   ├── User (Authentication only)
│   │   ├── Login / Logout
│   │   ├── Credentials / SSO / Face Auth
│   │   └── Links to Staff (optional or auto-created)
│   │
│   └── Staff (Operational Actor)
│       ├── belongsTo User
│       ├── assigned JobPosition
│       ├── assigned OrgTeam
│       ├── has Spatie Roles (RBAC)
│       └── has Attributes (ABAC source)
│
├── Role-Based Access Layer (RBAC - Spatie)
│   ├── Roles
│   │   ├── OrgTeam scoped roles
│   │   │   ├── Manager
│   │   │   ├── Supervisor
│   │   │   ├── Approver
│   │   │   └── Operator
│   │   │
│   │   └── System-wide roles (optional)
│   │       ├── Super Admin
│   │       ├── Auditor
│   │       └── Support
│   │
│   ├── Permissions
│   │   ├── Model-based permissions
│   │   │   ├── view users
│   │   │   ├── create tasks
│   │   │   ├── approve requests
│   │   │   └── delete records
│   │   │
│   │   └── Feature permissions
│   │       ├── access payroll
│   │       ├── access reports
│   │       └── access admin panel
│   │
│   └── Role Assignment
│       ├── Staff::assignRole()
│       ├── Staff::syncRoles()
│       └── OrgTeam scoped assignment
│
├── Attribute-Based Access Layer (ABAC - Context Rules)
│   ├── Staff Attributes
│   │   ├── department
│   │   ├── clearance_level
│   │   ├── location
│   │   └── employment_type
│   │
│   ├── JobPosition Attributes
│   │   ├── max_approval_limit
│   │   ├── required_clearance
│   │   ├── allowed_actions
│   │   └── scope_of_work
│   │
│   ├── Resource Attributes
│   │   ├── sensitivity_level
│   │   ├── ownership
│   │   ├── org_team_id
│   │   └── region
│   │
│   └── ABAC Evaluation Engine
│       ├── Policy Decision Point (PDP)
│       ├── Policy Enforcement Point (PEP)
│       ├── Policies/
│       │   ├── UserPolicy
│       │   ├── TaskPolicy
│       │   ├── DocumentPolicy
│       │   └── PaymentPolicy
│       └── Rule Evaluators
│           ├── ClearanceChecker
│           ├── OwnershipChecker
│           └── ScopeChecker
│
├── Policy Layer (Laravel Policies - Enforcement Bridge)
│   ├── Models/
│   │   ├── UserPolicy
│   │   ├── StaffPolicy
│   │   ├── JobPositionPolicy
│   │   ├── TaskPolicy
│   │   └── DocumentPolicy
│   │
│   ├── Policy Rules Pattern
│   │   ├── canView()
│   │   ├── canCreate()
│   │   ├── canUpdate()
│   │   ├── canDelete()
│   │   └── canApprove()
│   │
│   └── Policy Delegation Flow
│       ├── Check RBAC (Spatie first)
│       ├── Then ABAC evaluation
│       └── Final decision
│
├── Org Structure Layer
│   ├── OrgTeam
│   │   ├── defines RBAC context
│   │   ├── contains Roles
│   │   └── scopes permissions
│   │
│   ├── JobPosition
│   │   ├── defines capability template
│   │   ├── default roles
│   │   └── attribute constraints
│   │
│   └── Assignment Rules
│       ├── Staff → JobPosition
│       ├── Staff → OrgTeam
│       └── JobPosition → Roles (optional auto-sync)
│
├── Authorization Actions Layer (Business Logic Gatekeepers)
│   ├── Actions/
│   │   ├── AuthorizeAction
│   │   ├── CheckPermission
│   │   ├── EvaluatePolicy
│   │   ├── AssignRoleToStaff
│   │   ├── SyncStaffPermissions
│   │   └── ValidateAccessScope
│
├── Events Layer (Audit & Traceability)
│   ├── Authorization/
│   │   ├── AccessGranted
│   │   ├── AccessDenied
│   │   ├── RoleAssigned
│   │   ├── RoleRevoked
│   │   └── PolicyEvaluated
│
├── Services Layer (Core Engines)
│   ├── AuthorizationService
│   │   ├── check()
│   │   ├── authorize()
│   │   └── evaluate()
│   │
│   ├── RoleSyncService
│   │   ├── syncFromJobPosition()
│   │   └── syncFromOrgTeam()
│   │
│   ├── AbacEngineService
│   │   ├── evaluateStaff()
│   │   ├── evaluateResource()
│   │   └── matchRules()
│   │
│   └── PermissionResolverService
│       ├── resolveUserPermissions()
│       └── mergeRBAC_ABAC()
│
└── UI Authorization Layer (Filament)
    ├── Admin Panel
    │   ├── Role Management
    │   ├── Permission Management
    │   ├── OrgTeam Management
    │   └── Policy Inspector
    │
    ├── Staff Panel
    │   ├── Self permissions view
    │   ├── Task visibility rules
    │   └── Role display (read-only mostly)
    │
    └── Filament Gate Integration
        ├── canView()
        ├── canCreate()
        ├── canEdit()
        └── canDelete()


app/Trees/Authorization/
├── Actions/
│   ├── AuthorizeAction.php
│   ├── AssignRoleToStaff.php
│   ├── SyncStaffRolesFromJobPosition.php
│   ├── EvaluateAccessAction.php
│   └── RevokeRoleFromStaff.php
│
├── Services/
│   ├── AuthorizationService.php
│   ├── AbacEngineService.php
│   ├── PermissionResolverService.php
│   ├── RoleSyncService.php
│   └── PolicyDecisionService.php
│
├── Policies/
│   ├── BasePolicy.php
│   ├── TaskPolicy.php
│   ├── DocumentPolicy.php
│   ├── UserPolicy.php
│   └── JobPositionPolicy.php
│
├── Rules/
│   ├── AbacRuleInterface.php
│   ├── ClearanceRule.php
│   ├── OwnershipRule.php
│   ├── OrgScopeRule.php
│   └── AttributeMatchRule.php
│
├── DTO/
│   ├── AuthorizationContext.php
│   ├── AccessDecision.php
│   └── PermissionRequest.php
│
├── Events/
│   ├── AccessGranted.php
│   ├── AccessDenied.php
│   ├── RoleAssigned.php
│   ├── RoleRevoked.php
│   └── PolicyEvaluated.php
│
├── Builders/
│   ├── PermissionQueryBuilder.php
│   └── RoleQueryBuilder.php
│
└── Traits/
    ├── HasAuthorizationContext.php
    └── InteractsWithPolicies.php
```

# Rimba Tree: Ver (Version Management)

```text
config/
└── ver.php

database/
├── migrations/
│   ├── create_versions_table.php
│   └── create_version_dependencies_table.php (optional)
│
└── seeders/
    └── VersionSeeder.php

util/
└── SemanticVersion.php


app/Trees/Ver/
│
├── Actions/
│   ├── CreateVersion.php
│   ├── ReleaseVersion.php
│   ├── ArchiveVersion.php
│   ├── ChangeVersionStatus.php
│   ├── GenerateNextVersion.php
│   ├── VerifyVersionChecksum.php
│   ├── DeleteVersion.php
│   └── SyncVersionDependencies.php
│
├── Builders/
│   └── VersionBuilder.php
│
├── Events/
│   ├── VersionCreated.php
│   ├── VersionReleased.php
│   ├── VersionArchived.php
│   ├── VersionDeleted.php
│   ├── VersionStatusChanged.php
│   ├── VersionBecameEffective.php
│   └── VersionExpired.php
│
├── Http/
│   │
│   ├── API/
│   │   └── Resources/
│   │       └── VersionResource.php
│   │
│   └── UI/
│       │
│       ├── Admin/
│       │   │
│       │   ├── Resources/
│       │   │   ├── VersionResource.php
│       │   │   │
│       │   │   └── VersionResource/
│       │   │       │
│       │   │       ├── Pages/
│       │   │       │   ├── ListVersions.php
│       │   │       │   ├── CreateVersion.php
│       │   │       │   ├── EditVersion.php
│       │   │       │   └── ViewVersion.php
│       │   │       │
│       │   │       └── RelationManagers/
│       │   │           └── VersionsRelationManager.php
│       │   │
│       │   ├── Pages/
│       │   │   ├── VersionDashboard.php
│       │   │   ├── CurrentVersions.php
│       │   │   └── ObsoleteVersions.php
│       │   │
│       │   └── Widgets/
│       │       ├── LatestVersionsWidget.php
│       │       ├── ReleasedVersionsWidget.php
│       │       ├── DraftVersionsWidget.php
│       │       ├── ExpiringVersionsWidget.php
│       │       └── ObsoleteVersionsWidget.php
│       │
│       └── Staff/
│           │
│           ├── Resources/
│           │   └── VersionResource.php
│           │
│           ├── Pages/
│           │   ├── CurrentVersions.php
│           │   └── VersionViewer.php
│           │
│           └── Widgets/
│               └── CurrentVersionsWidget.php
│
├── Jobs/
│   ├── VerifyVersionChecksums.php
│   ├── ArchiveExpiredVersions.php
│   ├── UpdateCurrentVersions.php
│   └── NotifyVersionOwners.php
│
├── Listeners/
│   ├── NotifyVersionReleased.php
│   ├── NotifyVersionArchived.php
│   ├── UpdateCurrentVersionPointer.php
│   └── UpdateDependentVersions.php
│
├── Models/
│   ├── Version.php
│   └── VersionDependency.php
│
├── Observers/
│   └── VersionObserver.php
│
├── Policies/
│   └── VersionPolicy.php
│
├── Services/
│   ├── SemanticVersionService.php
│   ├── VersionResolverService.php
│   ├── VersionComparisonService.php
│   ├── VersionChecksumService.php
│   ├── VersionDependencyService.php
│   └── VersionContentService.php
│
├── Traits/
│   └── HasVersions.php
│
└── Enums/
    ├── VersionStatus.php
    ├── VersionIncrementType.php
    └── ContentType.php



DATABASE

versions
├── id
├── versionable_type
├── versionable_id
├── version
├── major
├── minor
├── patch
├── status
├── content_type
├── content_url
├── checksum
├── effective_from
├── effective_until
├── released_at
├── notes
├── created_by
├── updated_by
├── created_at
└── updated_at


OPTIONAL

version_dependencies
├── id
├── version_id
├── depends_on_version_id
├── created_at
└── updated_at



MODEL RELATIONSHIPS

Version
├── morphTo(versionable)
├── belongsTo(createdBy)
├── belongsTo(updatedBy)
├── belongsToMany(dependencies)
└── belongsToMany(dependents)

VersionDependency
├── belongsTo(version)
└── belongsTo(dependsOnVersion)



TRAIT

HasVersions
├── versions()
├── currentVersion()
├── releasedVersions()
├── draftVersions()
├── latestVersion()
├── createVersion()
├── releaseVersion()
└── archiveVersion()



SUPPORTED VERSIONABLE MODELS

Dms
├── Document
├── Policy
├── SOP
├── WorkInstruction
└── Manual

Pwm
├── Workflow
├── WorkflowTemplate
└── TaskTemplate

Tos
├── ServiceCatalog
├── ServiceOffering
└── ServicePackage

Lcm
├── ContractTemplate
└── ClauseLibrary

Lms
├── Course
├── Module
├── Quiz
└── CertificateTemplate

Eam
├── AssetSpecification
├── MaintenanceProcedure
└── CalibrationProcedure

General
├── JsonTemplate
├── ApiSpecification
├── FormTemplate
└── ReportTemplate



STATUS FLOW

Draft
  ↓
Review
  ↓
Approved
  ↓
Released
  ↓
Obsolete
  ↓
Archived



SEMANTIC VERSION FLOW

Create Version
├── 1.0.0
│
├── Patch Release
│   └── 1.0.1
│
├── Minor Release
│   └── 1.1.0
│
└── Major Release
    └── 2.0.0



COMMON ACTIONS

CreateVersion
ReleaseVersion
ArchiveVersion
ChangeVersionStatus
GenerateNextVersion
VerifyVersionChecksum
DeleteVersion
SyncVersionDependencies



COMMON SERVICES

SemanticVersionService
VersionResolverService
VersionComparisonService
VersionChecksumService
VersionDependencyService
VersionContentService



COMMON BUILDER METHODS

released()
draft()
review()
approved()
archived()
obsolete()
effective()
current()
latest()
major($major)
minor($major, $minor)
patch($major, $minor, $patch)



FILAMENT RESOURCE FEATURES

VersionResource
├── View Version
├── Create Version
├── Edit Version
├── Release Version
├── Archive Version
├── Compare Versions
├── Preview Content URL
├── Verify Checksum
└── View Dependencies



DESIGN PRINCIPLE

Ver owns:
├── semantic version number
├── lifecycle status
├── effective dates
├── release dates
├── checksum validation
├── dependency graph
└── content location

Ver does NOT own:
├── actual file contents
├── markdown contents
├── PDFs
├── JSON bodies
├── SOP text
└── workflow definitions

Actual content lives in:
|── S3
├── GitHub
├── SharePoint
├── External URLs
└── Any content repository

Vms only stores:

content_url
```

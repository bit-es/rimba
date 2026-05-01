# Enterprise Manufacturing Platform

A modular, package-based platform for manufacturing organizations, designed to support core business lifecycles such as employees, assets, services, and documents.  
Built with **Laravel** and **Filament**, emphasizing clean separation of concerns, reusability, and scalability.

---

## Architecture Overview

The platform is organized into four layers:

- **PLATFORM** – Technical and UI capabilities
- **FOUNDATION** – Core organizational and process models
- **BUSINESS** – Business domain functionality
- **SUPPORT** – Cross-cutting operational services

---

## Packages

### PLATFORM
Provides shared technical capabilities used by all business modules.

- **UI (Filament)**  
  Standardized admin UI for resources, forms, tables, and dashboards.

- **Branding**  
  Manages corporate identity such as themes, logos, and layout configuration.

- **Auth**  
  Handles authentication, SSO, and identity federation (e.g. LDAP, AD, Keycloak).

- **Sync**  
  Manages data synchronization with external systems.

---

### FOUNDATION
Defines the core structure of the organization and how processes flow.

- **Org**  
  Models are Organization, OrgUnit, OrgTeam. These models carry organizational attributes, not people. All would have polymorphic many to many to Attributes model storing the additional organization attributes.

- **Person**  
    Models are User, Staff, Employee. These models carry person attributes, not work definition. All would have polymorphic many to many to Attributes model storing the additional person attributes.

- **Job**  
    Models are JobPosition, JobRole, JobContract. These models carry job / work attributes, time‑bound and contract‑aware. All would have polymorphic many to many to Attributes model storing the additional job attributes.

- **Workflow**  
  Generic workflow and lifecycle engine for approvals, state transitions, and escalations.

- **Access**  
  Authorization, roles, permissions, and segregation of duties enforcement. Roles are create thru ABAC from Attributes or can be manually added.

---

### BUSINESS
Implements manufacturing-related business domains.

- **DMS (Document Management System)**  
  Manages SOPs, policies, drawings, contracts, and controlled documents.

- **SOR (Service Offering Request)**  
  Handles internal service requests such as maintenance, IT, and facilities, including SLA tracking.

- **LMS (Learning Management System)**  
  Manages training, certifications, and employee competency records.

- **EAM (Enterprise Asset Management)**  
  Full asset lifecycle management including registration, utilization, maintenance, and disposal.

---

### SUPPORT
Provides observability, compliance, and communication services.

- **Notification**  
  Sends system notifications, approvals, reminders, and alerts via multiple channels.

- **Audit**  
  Maintains audit trails and change history for compliance and traceability.

- **Reporting**  
  Provides operational reports, KPIs, and management dashboards.

---
## Vendor Packages Structure 


| Folder/Directory | Mainly contains |
|------|------|
| vendor\bit-es\<Layer>\config | stores required configs for this layer
| vendor\bit-es\<Layer>\database\migrations | tables for models in all packages of this layer |
| vendor\bit-es\<Layer>\src\<Package> |  |
| vendor\bit-es\<Layer>\src\<Package>\Concerns | *Traits classes* |
| vendor\bit-es\<Layer>\src\<Package>\Entities | *Models classes* |
| vendor\bit-es\<Layer>\src\<Package>\Http\UI\Admin\Resources | *Filament Resource for Admin Panel* |
| vendor\bit-es\<Layer>\src\<Package>\Http\UI\Admin\Pages | *Filament Pages for Admin Panel* |
| vendor\bit-es\<Layer>\src\<Package>\Http\UI\Admin\Widgets | *Filament Widgets for Admin Panel* |
| vendor\bit-es\<Layer>\src\<Package>\Http\UI\Staff\Resources | *Filament Resource for Staff Panel* |
| vendor\bit-es\<Layer>\src\<Package>\Http\UI\Staff\Pages | *Filament Pages for Staff Panel* |
| vendor\bit-es\<Layer>\src\<Package>\Http\UI\Staff\Widgets | *Filament Widgets for Staff Panel* |
| vendor\bit-es\<Layer>\src\<Package>\Http\API\Resources | *Models classes* |
| vendor\bit-es\<Layer>\src\<Package>\Http\Requests |  |
| vendor\bit-es\<Layer>\src\<Package>\Actions | *Single Action classes* |
| vendor\bit-es\<Layer>\src\<Package>\Policies | *Policies for models* |
| vendor\bit-es\<Layer>\src\<Package>\Observers | *Observers for models* |
| vendor\bit-es\<Layer>\src\<Package>\Jobs |  |
| vendor\bit-es\<Layer>\src\<Package>\Events |  |
| vendor\bit-es\<Layer>\src\<Package>\Listeners |  |
| vendor\bit-es\<Layer>\src\<Package>\Services | *Services classes (multiple actions)* |
|||

## Design Principles

- Business-first domain modeling
- Laravel Naming Conventions or simply Eloquent Conventions for database-related items
- Namings are to be of simple words (audience take English as second language)
- Clear package boundaries
- Workflow-driven lifecycles
- Reusable and configurable components
- Multi-plant and multi-company ready

---

## Intended Use

This platform serves as a foundation for:
- Manufacturing ERP / MES extensions
- Internal enterprise systems
- Modular SaaS or open-core products

---

## License

To be defined per package (open-core friendly).
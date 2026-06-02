# Laravel Architectural Blueprint (Filament-First Domain Structure)

This document establishes the architecture for a Controllerless Laravel application powered by Filament PHP. Standard CRUD routing and UI generations are fully deferred to Filament Resources, while core application logic is strictly decoupled into distinct, single-responsibility domain classes.


---

## Architecture Overview

The platform is organized into four layers:

- **BUSINESS** – Business domain functionality, holds most packages whereby is administration is by organization's job roles.
- **FOUNDATION** – Core organizational and process models, universal packages used by any form of organization, before business domain can be build upon.
- **PLATFORM** – Technical and UI capabilities
- **SUPPORT** – Cross-cutting operational services, consumed by other packages for use.

---

## Business Layer Packages

[PWM](brs_pwm.md)   → workflow execution engine (CORE)  
[LCM](brs_lcm.md)   → legal contracts package  
[WFM](brs_wfp.md)   → workforce planning package  
[HRM](brs_hrm.md)   → people lifecycle package    
[TOS](brs_tos.md)   → service composition package  
[DMS](brs_dms.md)   → knowledge/asset package  
[LMS](brs_lms.md)   → capability/learning package  
[EAM](brs_eam.md)   → asset lifecycle package  
[CAPA](brs_capa.md) → CAPA tracker package  
[RMS](brs_RMS.md)   → risk management package  
[VMS](brs_vms.md)   → vendor/supplier management package  
[CMMS](brs_cmms.md) → maintenance management package  
[EPM](brs_epm.md)   → enterprise planning & project management package  


---

## Directory Reference Map

```text
vendor/bit-es/<Layer>/<Package>/
└── config/                         # package configuration files
└── database/                       # database migrations
└── util/                           # any backend use utility classes
└── src/
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

---

## 1. Presentation & Interface (Filament Layer)

2 Filament Panels are to exist; *Admin* (administering the configs of packages) & *Staff* (using of packages by staff, where applicable)

### Filament Resources (`vendor/bit-es/<Layer>/src/<Package>/Http/UI/<Panel>/Resources `)
*   **Purpose:** Configures the web layout schema for admin forms, tables, pages, clusters, and global search contexts.
*   **Design Rule:** Keep configuration declarative. Do not implement inline database updates or complex loops inside this class.

### Filament Pages & Widgets (`vendor/bit-es/<Layer>/src/<Package>/Http/UI/<Panel>/Pages`, `/Widgets`)
*   **Purpose:** Houses custom admin panel templates, metrics, charts, or multi-model dashboards.

### Custom Livewire Components (`vendor/bit-es/<Layer>/src/<Package>/Livewire`)
*   **Purpose:** Provides specialized interactive UI elements if Filament's form/table engine cannot satisfy specific front-end layout goals.

---

## 2. Core Business Logic (Domain Layer)

### Actions (`vendor/bit-es/<Layer>/src/<Package>/Actions`)
*   **Purpose:** Classes executing exactly one independent backend process (e.g., `ProcessRefund`, `GenerateInvoice`).
*   **Design Rule:** Must use a single public entry point method (e.g., `execute()`). They should never fetch `Auth::id()` or direct session payloads; pass values strictly as parameters.
*   **Benefit:** Enables easy portability across Filament buttons, console commands, webhooks, or test scripts.

### Services (`vendor/bit-es/<Layer>/src/<Package>/Services`)
*   **Purpose:** Wraps code dealing with external systems (e.g., `StripePaymentService`, `FedExShippingApi`) or heavy mathematical algorithms.

---

## 3. Data, Query, & Security Layer (Eloquent Layer)

### Models (`vendor/bit-es/<Layer>/src/<Package>/Models`)
*   **Purpose:** Map tables to models, defining database links (`belongsTo`, `hasMany`), type casts, and simple mutators.
*   **Design Rule:** Free models of operational queries or automated triggers by extraction into Builders or Observers.

### Query Builders (`vendor/bit-es/<Layer>/src/<Package>/Builders`)
*   **Purpose:** Houses domain-specific Eloquent queries, replacing complex query scopes.
*   **Benefit:** Separates backend filtering logic from Filament views (e.g., `$query->overdue()->forUser($id)`).

### Observers (`vendor/bit-es/<Layer>/src/<Package>/Observers`)
*   **Purpose:** Automatically executes low-level processes on explicit model life cycle milestones (e.g., `creating`, `updated`, `deleted`).
*   **Typical Usage:** Generating internal model UUID flags, auditing adjustments, or changing parent dependencies automatically on data mutations.

### Policies (`vendor/bit-es/<Layer>/src/<Package>/Policies`)
*   **Purpose:** Encapsulates permissions controlling access to specific models.
*   **Benefit:** Natively intercepted by Filament to automatically toggle user visibility for entire navigation sections, edit links, or record deletion actions.

---

## 4. Background & Event Integration (Asynchronous Layer)

### Events (`vendor/bit-es/<Layer>/src/<Package>/Events`)
*   **Purpose:** Plain-PHP data storage blocks announcing occurrences in the application (e.g., `LocationActivatedEvent`). Contains zero processing logic.

### Listeners (`vendor/bit-es/<Layer>/src/<Package>/Listeners`)
*   **Purpose:** Intercepts specific event emissions to initiate distinct decoupled tasks (e.g., `SendTaskCompletedNotification`).
*   **Benefit:** Prevents primary application threads from waiting for secondary tasks to finish.

### Jobs (`vendor/bit-es/<Layer>/src/<Package>/Jobs`)
*   **Purpose:** Background worker blocks running tasks outside the client's HTTP lifecycle via message queues.
*   **Typical Usage:** Communicating with remote servers, generating massive data sheets, or running batched file conversions.



---

## Structural Execution Pipeline

```text
[ Filament Action Button ] 
           │
           ▼
  [ Action Class ] ──(Fires)──► [ Event ] ──(Triggers)──► [ Listener ]
           │                                                   │
     (Modifies DB)                                        (Dispatches)
           │                                                   │
           ▼                                                   ▼
   [ Model/Observer ]                                    [ Queue Job ]
                                                               │
                                                               ▼
                                                      [ External Service ]
```

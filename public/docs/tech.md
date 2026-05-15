# Laravel Architectural Blueprint (Filament-First Domain Structure)

This document establishes the architecture for a Controllerless Laravel application powered by Filament PHP. Standard CRUD routing and UI generations are fully deferred to Filament Resources, while core application logic is strictly decoupled into distinct, single-responsibility domain classes.

---

## Directory Reference Map

```text
app/
├── Actions/            # Single business workflow classes (The "What")
├── Builders/           # Custom database query scopes (The "Where")
├── Events/             # Plain data structures reporting past system mutations
├── Filament/           # UI Forms, Tables, Dashboards, and View Layers
├── Jobs/               # Asynchronous queue workers offloading network/heavy tasks
├── Listeners/          # Reactive workers waiting to handle specific Event payloads
├── Models/             # Database relationships, column casting, and table mappings
├── Observers/          # Automated low-level lifecycle DB hooks
├── Policies/           # Authorization checks guarding Models and Filament Resources
└── Services/           # Wrapper layer for third-party tools and complex algorithms
```

---

## 1. Presentation & Interface (Filament Layer)

### Filament Resources (`app/Filament/Resources`)
*   **Purpose:** Configures the web layout schema for admin forms, tables, pages, clusters, and global search contexts.
*   **Design Rule:** Keep configuration declarative. Do not implement inline database updates or complex loops inside this class.

### Filament Pages & Widgets (`app/Filament/Pages`, `/Widgets`)
*   **Purpose:** Houses custom admin panel templates, metrics, charts, or multi-model dashboards.

### Custom Livewire Components (`app/Livewire`)
*   **Purpose:** Provides specialized interactive UI elements if Filament's form/table engine cannot satisfy specific front-end layout goals.

---

## 2. Core Business Logic (Domain Layer)

### Actions (`app/Actions`)
*   **Purpose:** Classes executing exactly one independent backend process (e.g., `ProcessRefund`, `GenerateInvoice`).
*   **Design Rule:** Must use a single public entry point method (e.g., `execute()`). They should never fetch `Auth::id()` or direct session payloads; pass values strictly as parameters.
*   **Benefit:** Enables easy portability across Filament buttons, console commands, webhooks, or test scripts.

### Services (`app/Services`)
*   **Purpose:** Wraps code dealing with external systems (e.g., `StripePaymentService`, `FedExShippingApi`) or heavy mathematical algorithms.

---

## 3. Data, Query, & Security Layer (Eloquent Layer)

### Models (`app/Models`)
*   **Purpose:** Map tables to models, defining database links (`belongsTo`, `hasMany`), type casts, and simple mutators.
*   **Design Rule:** Free models of operational queries or automated triggers by extraction into Builders or Observers.

### Query Builders (`app/Builders`)
*   **Purpose:** Houses domain-specific Eloquent queries, replacing complex query scopes.
*   **Benefit:** Separates backend filtering logic from Filament views (e.g., `$query->overdue()->forUser($id)`).

### Observers (`app/Observers`)
*   **Purpose:** Automatically executes low-level processes on explicit model life cycle milestones (e.g., `creating`, `updated`, `deleted`).
*   **Typical Usage:** Generating internal model UUID flags, auditing adjustments, or changing parent dependencies automatically on data mutations.

### Policies (`app/Policies`)
*   **Purpose:** Encapsulates permissions controlling access to specific models.
*   **Benefit:** Natively intercepted by Filament to automatically toggle user visibility for entire navigation sections, edit links, or record deletion actions.

---

## 4. Background & Event Integration (Asynchronous Layer)

### Events (`app/Events`)
*   **Purpose:** Plain-PHP data storage blocks announcing occurrences in the application (e.g., `LocationActivatedEvent`). Contains zero processing logic.

### Listeners (`app/Listeners`)
*   **Purpose:** Intercepts specific event emissions to initiate distinct decoupled tasks (e.g., `SendTaskCompletedNotification`).
*   **Benefit:** Prevents primary application threads from waiting for secondary tasks to finish.

### Jobs (`app/Jobs`)
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

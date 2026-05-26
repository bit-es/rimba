# Enterprise Asset Management (EAM)

## Business Requirements Specification (BRS)

Version: 1.0
Status: Draft

---

# 1. Overview

The Enterprise Asset Management (EAM) system is a shared infrastructure package designed to manage the full lifecycle of physical and logical assets across multiple systems and organizations.

It is built as a **shared modular package** and integrates with:

* LMS (training equipment, certifications)
* ERP (production machines, maintenance cost)
* Marketplace (leased/rented assets)
* IoT systems (sensor data)
* DMS (maintenance records, manuals)

It also depends on a **shared Location Package** for spatial tracking and asset positioning.

---

# 2. Objectives

The EAM system aims to:

* Track asset lifecycle from acquisition to disposal
* Manage maintenance schedules and history
* Enable location-based asset tracking
* Support preventive and corrective maintenance
* Integrate with external monitoring systems (IoT)
* Provide cross-system asset visibility

---

# 3. Shared Package Dependency

## 3.1 Location Shared Package

The EAM system SHALL use a shared location abstraction package.

### Location Model (Conceptual)

```text
Location
├── Country
├── State/Region
├── Site
├── Building
├── Floor
├── Zone
├── GPS Coordinates
```

### Location Capabilities

* hierarchical locations
* geo coordinates (lat/lng)
* asset mapping to locations
* movement history tracking
* multi-site support

---

# 4. Scope

The system covers:

```text
Asset → Location → Maintenance → Work Orders → Inspection → Lifecycle → Disposal
```

---

# 5. Actors

| Actor            | Description            |
| ---------------- | ---------------------- |
| Asset Manager    | Manages asset registry |
| Maintenance Team | Performs repairs       |
| Operator         | Uses assets            |
| Admin            | System configuration   |
| IoT System       | Sends telemetry data   |
| System           | Automation engine      |

---

# 6. Core Functional Requirements

## 6.1 Asset Registration

System shall allow registration of assets including:

* machines
* tools
* vehicles
* IT equipment
* infrastructure

---

## 6.2 Asset Identification

Each asset shall have:

* unique asset tag
* serial number
* QR code / barcode
* category classification

---

## 6.3 Asset Location Tracking

Assets SHALL be assigned to a location from the shared location package.

Support:

* current location
* location history
* transfer between locations

---

## 6.4 Asset Lifecycle Management

Lifecycle stages:

* Acquired
* In Use
* Under Maintenance
* Idle
* Retired
* Disposed

---

## 6.5 Maintenance Management

System shall support:

* preventive maintenance schedules
* corrective maintenance work orders
* maintenance history tracking

---

## 6.6 Work Orders

Work orders shall include:

* assigned technician
* asset reference
* issue description
* priority level
* status tracking

---

## 6.7 Inspection Management

System shall support periodic inspections:

* safety inspection
* compliance inspection
* performance inspection

---

## 6.8 Asset Downtime Tracking

System shall track:

* downtime start
* downtime end
* reason
* impact analysis

---

# 7. Business Rules

| Rule ID | Rule                                     |
| ------- | ---------------------------------------- |
| BR-001  | Every asset must belong to a location    |
| BR-002  | Asset cannot be deleted, only retired    |
| BR-003  | Maintenance must be linked to asset      |
| BR-004  | Work orders must have lifecycle status   |
| BR-005  | Location history must be preserved       |
| BR-006  | Only active assets can be assigned tasks |

---

# 8. Location Shared Package Rules

## 8.1 Location Assignment

Assets SHALL always reference a location entity.

## 8.2 Location Hierarchy

```text
Country → Region → Site → Building → Floor → Zone
```

## 8.3 Movement Tracking

Every movement SHALL generate a record:

* asset_id
* from_location
* to_location
* timestamp
* moved_by

---

# 9. Data Entities

## Core Tables

* assets
* asset_categories
* asset_locations
* asset_movements
* maintenance_records
* work_orders
* inspections
* downtime_logs

---

## Asset Table

* id
* name
* type
* serial_number
* asset_tag
* status
* location_id (from shared location package)

---

## Work Orders

* id
* asset_id
* assigned_to
* priority
* status
* description

---

# 10. Event-Driven Architecture

## Key Events

* AssetRegistered
* AssetMoved
* MaintenanceScheduled
* WorkOrderCreated
* WorkOrderCompleted
* InspectionCompleted
* AssetRetired

---

## Example Flow

```text
WorkOrderCompleted
→ Update Asset Status
→ Log Maintenance History
→ Notify Manager
→ Update Downtime Metrics
```

---

# 11. Integration Points

The EAM system integrates with:

* LMS (operator training requirements)
* ERP (asset costing)
* DMS (manuals, reports)
* IoT systems (sensor telemetry)
* Workflow engines
* Marketplace (asset leasing)

---

# 12. IoT & Telemetry Support

System MAY support:

* vibration data
* temperature monitoring
* usage hours
* predictive maintenance signals

---

# 13. Non-Functional Requirements

| Category     | Requirement                    |
| ------------ | ------------------------------ |
| Scalability  | Support thousands of assets    |
| Reliability  | No loss of maintenance history |
| Performance  | Fast asset lookup by location  |
| Security     | Role-based access              |
| Traceability | Full movement audit            |

---

# 14. Shared Package Architecture

## Domain Structure

```text
Domain/
└── Assets/
    ├── Models/
    ├── Events/
    ├── Listeners/
    ├── Services/
    ├── Actions/
    └── Policies/
```

---

## Package Structure

```text
packages/
└── eam/
    ├── src/
    ├── database/
    ├── config/
    ├── Filament/
    └── routes/
```

---

# 15. Filament Modules

* Assets
* Locations
* Maintenance
* Work Orders
* Inspections
* Asset Movements

---

# 16. Key Design Principle

The system is NOT just asset tracking.

It is:

```text
A location-aware asset lifecycle orchestration system
```

---

# 17. Future Enhancements

* Predictive maintenance AI
* Digital twin modeling
* 3D asset mapping
* AR maintenance guides
* Automated scheduling optimization
* Blockchain asset provenance

---

# 18. Success Criteria

The system is successful when:

* all assets are traceable by location
* maintenance is fully logged
* downtime is measurable
* integrations operate in real-time
* lifecycle is fully auditable

---

# 19. Conclusion

This EAM system is a **shared foundational package** designed for multi-system usage.

The inclusion of a shared Location Package ensures:

* consistency across systems
* reusable spatial logic
* unified asset mapping across LMS, ERP, and IoT ecosystems

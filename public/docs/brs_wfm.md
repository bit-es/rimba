# Workforce Management (WFM)

## Business Requirements Specification (BRS)

Version: 1.1
Status: Updated Draft

---

# 1. Overview

The Workforce Management (WFM) system is a **shared foundational orchestration package** that manages organizational structure, job architecture, and workforce resource planning.

It is NOT an HR lifecycle system.

> IMPORTANT: Employee lifecycle (recruitment → onboarding → promotion → retirement/separation) is handled entirely by the HRM system.

WFM focuses only on:

* organizational structure
* job architecture
* workforce demand and supply planning
* resource requirement definition
* vacancy management (approved demand for hiring)
* assignment of existing workforce to work scopes

---

# 2. Objectives

The WFM system aims to:

* Define organizational structure clearly
* Standardize job roles and positions
* Define workforce demand (resource requirements)
* Manage job vacancies (approved demand only)
* Enable resource planning for work execution
* Assign workforce to work scopes
* Support capacity vs demand planning
* Integrate with workflow/task/contract systems

---

# 3. Core Concept

Workforce Management is built around 3 interconnected perspectives:

```text
(1) Organization Perspective → Structure of the company
(2) Job Perspective         → Definition of work and vacancies
(3) People Perspective      → Available workforce (provided by HRM system)
```

WFM does NOT manage employee lifecycle.

---

# 4. Scope

The system covers:

```text
Org Structure → Job Architecture → Demand (Vacancy) → Workforce Allocation → Work Assignment
```

Excluded:

* recruitment process
* onboarding/offboarding
* payroll
* employee lifecycle management

(these belong to HRM system)

---

# 5. Actors

| Actor             | Description                               |
| ----------------- | ----------------------------------------- |
| Org Admin         | Manages org structure                     |
| Workforce Planner | Defines resource demand                   |
| Manager           | Approves job requirements and assignments |
| System            | Matches workforce to demand               |
| HRM System        | Provides validated workforce data         |

---

# 6. DOMAIN 1: ORGANIZATION STRUCTURE

## 6.1 OrgCorp (Enterprise Root)

Represents the top-level organization.

---

## 6.2 OrgUnit (Department Hierarchy)

Represents functional divisions.

---

## 6.3 OrgTeam (Operational Structure)

Represents execution structure tied to job positions and reporting lines.

---

# 7. DOMAIN 2: JOB ARCHITECTURE

## 7.1 Job Position

A Job Position represents an **approved or planned vacancy slot**, not an employee lifecycle entity.

Characteristics:

* belongs to OrgUnit
* represents required capability slot
* may be filled or vacant

---

## 7.2 Job Role

Defines capability and responsibility scope.

Reusable across positions.

---

## 7.3 Job Contract (Work Engagement Definition)

Defines engagement rules for filling a position:

* employee
* outsourced resource
* contractor

---

## 7.4 Vacancy Model

A vacancy represents an **approved demand for workforce**.

Vacancy includes:

* position reference
* required skills
* required capacity
* approval status

---

# 8. DOMAIN 3: PEOPLE (FROM HRM SYSTEM)

## 8.1 Workforce Data Source

WFM does NOT manage people lifecycle.

All people data is sourced from HRM system.

WFM only consumes:

* availability
* skills
* capacity
* assignment eligibility

---

## 8.2 Staff Types (Read-only in WFM)

* Employees (FTE / FTC)
* Contractors (TPC)
* Interns

---

## 8.3 Assignment Model

People can be assigned to:

* job positions
* work scopes
* tasks

Assignments include:

* time allocation
* capacity percentage
* validity period

---

# 9. WORKFORCE PLANNING LAYER

## 9.1 Work Scope Definition

Defines required work output:

* required roles
* required capacity
* duration

---

## 9.2 Resource Requirement (Demand Engine)

Defines workforce demand BEFORE hiring.

Example:

```text
Work Scope: Machine Maintenance
Required:
- 1 Maintenance Engineer
- 2 Technicians
Status: Approved Vacancy
```

---

## 9.3 Capacity Planning

Tracks:

* available workforce (from HRM)
* demand (from vacancies)
* utilization

---

## 9.4 Allocation Engine

Matches:

* approved vacancies
* available workforce

Assigns workforce to work scopes.

---

# 10. INTEGRATION WITH OTHER PACKAGES

## 10.1 HRM Integration (Critical)

WFM consumes HRM data:

* staff profiles
* skills
* availability
* employment type

WFM does NOT modify HRM lifecycle data.

---

## 10.2 Workflow System

Used for:

* approving vacancies
* approving work scopes
* assignment approvals

---

## 10.3 Task System

Tasks are executed by assigned workforce.

---

## 10.4 EAM Integration

Maintenance and asset work requires workforce allocation.

---

## 10.5 TOS Integration

Service requests consume workforce capacity.

---

## 10.6 Contract System Integration

Job contracts define engagement rules for filling vacancies.

---

# 11. BUSINESS RULES

| Rule ID | Rule                                                       |
| ------- | ---------------------------------------------------------- |
| BR-001  | WFM does NOT manage employee lifecycle                     |
| BR-002  | All people data comes from HRM                             |
| BR-003  | Only approved vacancies can be filled                      |
| BR-004  | A job position represents demand, not employment lifecycle |
| BR-005  | Workforce assignment must respect capacity limits          |
| BR-006  | No hiring process exists in WFM                            |
| BR-007  | Vacancy approval is required before resource allocation    |

---

# 12. DATA ENTITIES

## Core Tables

* org_corps
* org_units
* org_teams
* job_positions
* job_roles
* job_contracts
* vacancies
* work_scopes
* resource_requirements
* staff_assignments

---

# 13. EVENT-DRIVEN MODEL

## Key Events

* OrgUnitCreated
* JobPositionDefined
* VacancyCreated
* VacancyApproved
* WorkScopeCreated
* ResourceAllocated
* CapacityExceeded

---

## Example Flow

```text
WorkScopeCreated
→ System generates resource demand
→ Vacancy created
→ Approval workflow triggered
→ HRM provides eligible workforce
→ Assignment executed
```

---

# 14. NON-FUNCTIONAL REQUIREMENTS

| Category               | Requirement                              |
| ---------------------- | ---------------------------------------- |
| Scalability            | Supports large organizational structures |
| Accuracy               | Real-time capacity tracking              |
| Performance            | Fast allocation decisions                |
| Traceability           | Full audit of assignments                |
| Separation of Concerns | Strict HRM separation                    |

---

# 15. SHARED PACKAGE ARCHITECTURE

## Domain Structure

```text
Domain/
└── Workforce/
    ├── Organization/
    ├── Jobs/
    ├── Demand/
    ├── Planning/
    ├── Events/
    └── Services/
```

---

## Package Structure

```text
packages/
└── wfm/
    ├── src/
    ├── database/
    ├── config/
    ├── Filament/
    └── routes/
```

---

# 16. FILAMENT MODULES

* Organization (OrgCorp, OrgUnit, OrgTeam)
* Job Architecture (Positions, Roles)
* Vacancies (Demand Management)
* Work Scopes
* Resource Planning
* Workforce Allocation

---

# 17. KEY DESIGN PRINCIPLE

WFM is NOT HR.

It is:

```text
A workforce demand and allocation orchestration engine separating organizational needs from human lifecycle management
```

---

# 18. FUTURE ENHANCEMENTS

* AI workforce demand prediction
* Auto vacancy generation
* Skill-gap analysis (from HRM data)
* Dynamic capacity optimization
* Real-time workload balancing

---

# 19. SUCCESS CRITERIA

The system is successful when:

* all work scopes are converted into structured demand
* vacancies are properly approved before filling
* workforce allocation is optimized
* HRM remains the single source of truth for people lifecycle
* execution aligns with capacity constraints

---

# 20. CONCLUSION

WFM acts as a **demand-to-allocation orchestration layer**, separating:

* organizational structure
* job demand (vacancy)
* workforce supply (HRM)

This ensures clean separation between planning (WFM) and lifecycle management (HRM).

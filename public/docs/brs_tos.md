# Team Offering Service (TOS)

## Business Requirements Specification (BRS)

Version: 1.0
Status: Draft

---

# 1. Overview

The Team Offering Service (TOS) system is a shared service orchestration module that allows internal or external teams to offer services to staff or organizational users through a structured request and workflow-based fulfillment process.

It is designed as a **shared package** that integrates with:

* Workflow Package (request lifecycle automation)
* Task Package (execution of work steps)
* EAM (Enterprise Asset Management) for asset availability and usage
* Inventory / Procurement systems
* DMS (document attachments and records)

---

# 2. Objectives

The TOS system aims to:

* Enable any team to publish services
* Allow staff to request services via structured forms
* Route requests through configurable approval workflows
* Support service fulfillment tracking
* Ensure resource validation (inventory/assets)
* Trigger procurement workflows when required
* Provide full auditability of service delivery

---

# 3. Scope

The system covers the full service lifecycle:

```text
Service Catalog → Request → Workflow → Approval → Resource Check → Fulfillment → Completion
```

---

# 4. Core Concept

A "service" is any structured offering provided by a team.

Examples:

* IT support service
* HR onboarding service
* Maintenance request
* Transport booking
* Training request
* Procurement request
* Facility booking

---

# 5. Actors

| Actor                | Description                      |
| -------------------- | -------------------------------- |
| Requestor            | Staff submitting service request |
| Requestor Dept Owner | Approves request initiation      |
| Service Team Owner   | Owns service execution           |
| Service Executor     | Performs task                    |
| Procurement Team     | Handles inventory shortages      |
| System               | Orchestrates workflow            |

---

# 6. Functional Requirements

## 6.1 Service Catalog

The system shall allow teams to define services with:

* service name
* description
* required form fields
* workflow definition
* required resources (assets/items)
* SLA definition

---

## 6.2 Service Request Creation

Users shall be able to submit service requests via dynamic forms.

---

## 6.3 Request Workflow Engine

Each request shall pass through a structured workflow:

```text
Request Form Submission
→ Dept Owner Approval
→ Service Team Owner Approval
→ Fulfillment
→ Completion
```

---

## 6.4 Approval Steps

### Step 1: Requestor Department Approval

* validates request legitimacy
* ensures alignment with department needs

---

### Step 2: Service Team Approval

* validates service feasibility
* assigns execution team

---

## 6.5 Task Execution

Approved requests generate tasks via shared Task Package.

Tasks include:

* assignment
* due dates
* execution tracking
* completion reporting

---

## 6.6 Resource Validation (EAM + Inventory)

Before fulfillment:

### If request requires assets/items:

System shall:

* check EAM for asset availability
* check inventory stock levels

---

## 6.7 Inventory Decision Logic

### Case A: Sufficient Resources

```text
Proceed to fulfillment
```

### Case B: Insufficient Resources

```text
Trigger procurement workflow
→ Acquire required items/assets
→ Resume fulfillment
```

---

## 6.8 Procurement Trigger

If resources are insufficient:

* create procurement request
* link procurement to original service request
* pause service workflow

---

## 6.9 Fulfillment

Service team executes tasks and completes request.

System records:

* completion timestamp
* output documentation
* used resources
* SLA compliance

---

## 6.10 Completion & Closure

Request is marked completed when:

* all tasks are completed
* resources accounted for
* approvals finalized

---

# 7. Business Rules

| Rule ID | Rule                                                                      |
| ------- | ------------------------------------------------------------------------- |
| BR-001  | Every service request must originate from a defined service               |
| BR-002  | Requests must pass department approval before execution                   |
| BR-003  | Service team approval is mandatory                                        |
| BR-004  | Fulfillment cannot proceed without resource validation                    |
| BR-005  | Procurement must be triggered automatically if resources are insufficient |
| BR-006  | All workflow steps must be auditable                                      |
| BR-007  | Tasks are generated only after service approval                           |

---

# 8. Workflow Dependency (Shared Package)

The system relies on a shared workflow engine:

```text
Workflow Package
→ defines stages
→ defines transitions
→ defines approvals
→ defines conditions
```

Each service request is an instance of a workflow.

---

# 9. Task Dependency (Shared Package)

Tasks are executed via shared Task Package:

* assignable to users or teams
* trackable status
* time-bound
* linked to workflow steps

---

# 10. EAM Integration

The system integrates with EAM for:

* asset availability checks
* equipment reservation
* asset allocation
* maintenance conflict detection

---

# 11. Inventory Integration

Inventory system provides:

* stock availability
* item reservation
* procurement triggers

---

# 12. Data Entities

## Core Entities

* services
* service_requests
* service_workflows
* workflow_instances
* tasks
* approvals
* resource_requirements
* procurement_requests

---

## Service Request Table

* id
* service_id
* requested_by
* department_id
* status
* workflow_instance_id

---

## Resource Requirement

* service_request_id
* type (asset/item)
* reference_id (EAM asset or inventory item)
* quantity

---

# 13. Event-Driven Architecture

## Key Events

* ServiceRequested
* DepartmentApproved
* ServiceApproved
* TaskCreated
* ResourcesChecked
* ProcurementTriggered
* ServiceFulfilled
* ServiceCompleted

---

## Example Flow

```text
ServiceRequested
→ DepartmentApproval
→ ServiceApproval
→ TaskGeneration
→ ResourceCheck
→ (Procurement if needed)
→ Fulfillment
→ Completion
```

---

# 14. Non-Functional Requirements

| Category      | Requirement                              |
| ------------- | ---------------------------------------- |
| Scalability   | Support many concurrent service requests |
| Reliability   | Workflow must not lose state             |
| Traceability  | Full audit trail required                |
| Performance   | Fast workflow transitions                |
| Extensibility | New services easily added                |

---

# 15. Shared Package Architecture

## Domain Structure

```text
Domain/
└── ServiceOffering/
    ├── Models/
    ├── Events/
    ├── Listeners/
    ├── Workflows/
    ├── Services/
    ├── Actions/
    └── Policies/
```

---

## Package Structure

```text
packages/
└── tos/
    ├── src/
    ├── database/
    ├── config/
    ├── Filament/
    └── routes/
```

---

# 16. Filament Modules

* Services
* Service Requests
* Approvals
* Workflows
* Tasks
* Resource Checks
* Procurement Links

---

# 17. Key Design Principle

TOS is NOT just a request system.

It is:

```text
A workflow-driven service orchestration layer connecting people, assets, inventory, and execution teams
```

---

# 18. Future Enhancements

* AI-based request routing
* SLA prediction engine
* Auto-resource optimization
* Chat-based service requests (WhatsApp/Slack)
* Self-healing workflows
* Cost estimation engine

---

# 19. Success Criteria

The system is successful when:

* all service requests are traceable
* approvals are fully automated and auditable
* resource conflicts are eliminated
* procurement is triggered automatically
* service delivery is measurable via SLA

---

# 20. Conclusion

The TOS system provides a unified service orchestration layer across an organization.

It integrates workflow, tasks, EAM, and inventory systems into a single controlled service lifecycle engine.

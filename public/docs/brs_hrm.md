# Human Resource Management (HRM)

## Business Requirements Specification (BRS)

Version: 1.0  
Status: Draft<p align="right"><a href="all.md">Back to Main</a> | <a href="tech.md">Back to Tech Overview</a></p>

---

# 1. Overview

The Human Resource Management (HRM) system is a **core lifecycle management package** responsible for managing the complete lifecycle of individuals working within an organization.

It is a **source-of-truth system for people**, and is distinct from:

* Workforce Management (WFM) → demand & allocation
* TOS → service execution
* EAM → asset management
* LMS → learning

HRM manages **people from recruitment to retirement/separation**.

---

# 2. Objectives

The HRM system aims to:

* Manage employee lifecycle end-to-end
* Handle recruitment and onboarding
* Maintain employee records and contracts
* Track performance and career progression
* Manage compensation and benefits (optional module)
* Handle termination and offboarding
* Provide validated workforce data to WFM

---

# 3. Core Concept

HRM is built around the **human lifecycle engine**:

```text
Candidate → Applicant → Employee → Active Staff → Alumni/Separated
```

HRM is the ONLY system responsible for lifecycle state changes.

---

# 4. Scope

The system covers:

```text
Recruitment → Hiring → Onboarding → Employment → Performance → Development → Offboarding → Separation
```

---

# 5. Actors

| Actor     | Description                   |
| --------- | ----------------------------- |
| HR Admin  | Manages HR processes          |
| Recruiter | Manages hiring pipeline       |
| Manager   | Evaluates employees           |
| Employee  | Works within organization     |
| System    | Automates lifecycle workflows |

---

# 6. DOMAIN 1: RECRUITMENT

## 6.1 Job Posting

HRM manages job postings created from approved WFM vacancies.

---

## 6.2 Applicant Management

System tracks:

* applications
* CV/resume
* screening results
* interview stages

---

## 6.3 Hiring Pipeline

Stages:

* Applied
* Screened
* Interviewed
* Selected
* Offered
* Accepted
* Rejected

---

## 6.4 Offer Management

System generates job offers:

* salary
* contract terms
* start date

---

# 7. DOMAIN 2: ONBOARDING

## 7.1 Employee Creation

Upon acceptance, candidate becomes employee.

System assigns:

* employee ID
* department
* job position
* contract type

---

## 7.2 Onboarding Workflow

Includes:

* document submission
* system access provisioning
* orientation
* probation tracking

---

# 8. DOMAIN 3: EMPLOYEE MANAGEMENT

## 8.1 Employee Profile

Stores:

* identity
* job position
* department
* employment type (FTE/FTC/TPC/Intern)
* contract details
* reporting manager

---

## 8.2 Employment Status

States:

* Active
* On Probation
* Suspended
* On Leave
* Resigned
* Terminated

---

## 8.3 Reporting Structure

HRM maintains:

* manager relationships
* organizational assignment

---

# 9. DOMAIN 4: PERFORMANCE MANAGEMENT

## 9.1 Performance Reviews

System supports:

* periodic reviews
* KPIs
* evaluation scores

---

## 9.2 Career Development

Tracks:

* promotions
* role changes
* training recommendations (via LMS)

---

# 10. DOMAIN 5: COMPENSATION & BENEFITS (OPTIONAL MODULE)

Supports:

* salary management
* bonuses
* allowances
* benefits tracking

---

# 11. DOMAIN 6: OFFBOARDING

## 11.1 Resignation

Employee-initiated separation process.

---

## 11.2 Termination

Organization-initiated separation.

---

## 11.3 Exit Process

Includes:

* asset return (EAM integration)
* contract closure
* access revocation
* final settlement

---

# 12. INTEGRATION WITH OTHER SYSTEMS

## 12.1 Workforce Management (WFM)

HRM provides:

* employee availability
* skills
* capacity

WFM provides:

* vacancies (demand)
* assignment requests

---

## 12.2 Contract System

HRM uses contract package for:

* employment contracts
* compensation terms

---

## 12.3 EAM Integration

Used during offboarding:

* return assets
* revoke equipment access

---

## 12.4 LMS Integration

Used for:

* onboarding training
* performance development
* certification tracking

---

## 12.5 TOS Integration

Employees may request services as staff users.

---

# 13. BUSINESS RULES

| Rule ID | Rule                                                      |
| ------- | --------------------------------------------------------- |
| BR-001  | HRM is the only system that manages employee lifecycle    |
| BR-002  | Employee must originate from approved recruitment process |
| BR-003  | WFM cannot create or modify employees                     |
| BR-004  | Employment status changes only in HRM                     |
| BR-005  | Offboarding must trigger system-wide revocation processes |
| BR-006  | Every employee must belong to an organization unit        |

---

# 14. DATA ENTITIES

## Core Tables

* candidates
* applications
* interviews
* offers
* employees
* employment_contracts
* employee_positions
* performance_reviews
* separation_records

---

## Employee Table

* id
* personal_info
* employment_type
* status
* department_id
* job_position_id

---

# 15. EVENT-DRIVEN MODEL

## Key Events

* JobPosted
* CandidateApplied
* CandidateHired
* EmployeeOnboarded
* EmployeePromoted
* PerformanceReviewed
* EmployeeExited

---

## Example Flow

```text
CandidateSelected
→ OfferGenerated
→ Accepted
→ EmployeeCreated
→ OnboardingStarted
→ Activated in HRM
→ Available to WFM
```

---

# 16. NON-FUNCTIONAL REQUIREMENTS

| Category       | Requirement                        |
| -------------- | ---------------------------------- |
| Security       | Sensitive employee data protection |
| Compliance     | Labor law compliance support       |
| Auditability   | Full lifecycle history tracking    |
| Scalability    | Large workforce support            |
| Data Integrity | Strict lifecycle state enforcement |

---

# 17. SHARED PACKAGE ARCHITECTURE

## Domain Structure

```text
Domain/
└── HRM/
    ├── Recruitment/
    ├── Employees/
    ├── Performance/
    ├── Offboarding/
    ├── Events/
    └── Services/
```

---

## Package Structure

```text
packages/
└── hrm/
    ├── src/
    ├── database/
    ├── config/
    ├── Filament/
    └── routes/
```

---

# 18. FILAMENT MODULES

* Recruitment
* Candidates
* Interviews
* Employees
* Contracts
* Performance Reviews
* Offboarding

---

# 19. KEY DESIGN PRINCIPLE

HRM is NOT resource allocation.

It is:

```text
A human lifecycle authority system ensuring controlled creation, evolution, and termination of workforce identity
```

---

# 20. FUTURE ENHANCEMENTS

* AI recruitment screening
* Skill graph engine
* Predictive attrition analysis
* Automated onboarding assistant
* Workforce sentiment tracking

---

# 21. SUCCESS CRITERIA

The system is successful when:

* employee lifecycle is fully controlled
* HRM is single source of truth for people
* WFM consumes clean workforce data
* onboarding/offboarding is fully traceable
* compliance requirements are met

---

# 22. CONCLUSION

HRM is the **central human lifecycle system** in the ecosystem.

It ensures strict separation from WFM by handling ONLY:

* recruitment
* employment lifecycle
* performance
* separation

while exposing clean workforce data for planning and execution systems.

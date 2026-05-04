# Filament Blueprint – Organizational, Person, Job, Location & Access Model

> **Purpose**  
This blueprint defines a **clear domain separation** between:
- **Organization structure**
- **Physical locations**
- **Person identity**
- **Job / work definition**
- **Workflow**
- **Access control (ABAC + RBAC hybrid)**  

Designed for **Filament**, **Laravel**, and **attribute‑driven extensibility**.

---

## 1. Core Design Principles

1. **Separation of concerns**
   - Org ≠ Location ≠ Person ≠ Job
   - Locations describe *where*, not *who* or *what*
   - Organization structure is independent of geography

2. **Composable traits**
   - (Defined in `SharedInfra.md`)
   
3. **Filament-first design**
   - Every aggregate root is a Filament Resource
   - Relations exposed via RelationManagers
   - Shared components for Attributes and Locations

---

## 2. Organization Domain (Structure Only)

> Organizational structure entities — **not people**

### 2.1 Organization

Represents a company, government body, or institution.

Traits:
- ✅ HasAttributes
- ✅ HasLocations

**Relations**
- hasMany → OrgUnit
- hasMany → OrgTeam
- hasMany → Employee

**Filament**
- `OrganizationResource`
- Tabs: Profile | Structure | Locations | Attributes

---

### 2.2 OrgUnit

Departments / divisions inside an Organization.

**Rules**
- Each OrgUnit is owned by a **JobPosition**
- May operate in one or more Locations

Traits:
- ✅ HasLocations

**Relations**
- belongsTo → Organization
- belongsTo → JobPosition (owner)

---

### 2.3 OrgTeam

Cross-functional or operational teams.

**Rules**
- Owned by Staff
- Teams may be distributed or site-specific

**Relations**
- belongsTo → Organization
- belongsTo → Staff (owner)
- belongsToMany → JobRole
- belongsToMany → Staff (members)

---

## 3. Person Domain (Identity Only)

### 3.1 User

Login identity (Intranet / App).

Traits:
- ✅ HasAttributes

**Relations**
- belongsTo → Staff (nullable)

---

### 3.2 Staff

A person working in the organization.

Traits:
- ✅ HasAttributes
- ✅ HasLocations

**Relations**
- hasMany → JobContract
- belongsToMany → OrgTeam

---

### 3.3 Employee

HR-specific entity for FTE and FTC.

Traits:
- ✅ HasAttributes
- ✅ HasLocations

**Relations**
- belongsTo → Staff
- belongsTo → Organization

---

## 4. Job Domain (Work Definition)

### 4.1 JobPosition

A position that exists in the organization.

Traits:
- ✅ HasAttributes
- ✅ HasLocations

**Relations**
- belongsTo → OrgUnit
- belongsToMany → JobRole
- hasMany → JobContract

---

### 4.2 JobRole

Scope of work (WBS-like).


Traits:
- ✅ HasAttributes

**Relations**
- belongsToMany → JobPosition
- belongsToMany → OrgTeam

---

### 4.3 JobContract

Time‑bound binding of Staff ↔ JobPosition.

Traits:
- ✅ HasAttributes
- ✅ HasLocations

**Relations**
- belongsTo → JobPosition
- belongsTo → Staff

---

## 5. Workflow Domain

Generic workflow engine for:
- Approvals
- State transitions
- Escalations

**Location-aware examples**
- Onsite vs remote approvals
- Site-based escalation chains

---

## 6. Access Domain (ABAC + RBAC)

Roles and permission will be created based on attributes ABAC of person, job or org .... ,

| Role Prefix | Attribute of | Model |
|------|------|------|
| o. | org | Organization |
| d. | org | OrgUnit |
| t. | org | OrgTeam |
| u. | person | User |
| s. | person | Staff |
| e. | person | Employee |
| p. | job | JobPosition |
| r. | job | JobRole |
| c. | job | JobContract |
||||
---

## 7. Filament Resource Map

- OrganizationResource
- OrgUnitResource
- OrgTeamResource
- LocationResource
- UserResource
- StaffResource
- EmployeeResource
- JobPositionResource
- JobRoleResource
- JobContractResource
- RoleResource
- AttributeResource

---

## 8. Mental Model Summary
Organization defines structure
Location defines where things exist
OrgUnit / OrgTeam define where work happens
JobPosition / JobRole define what work exists
JobContract defines who does it, when, and where
Staff / User define who the person is

---

13. User is a person who login/register to Intra app, .... is then linked to Staff either manually by administrator or auto by ldap
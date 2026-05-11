# Authorization (Business Overview)

The **Authorization module** controls **what users are allowed to see and do** in the system.

It ensures that:
- The right people have the right access  
- Sensitive actions are properly controlled  
- Responsibilities follow organizational roles  

---

## Why This Matters

In any organization:

- Not everyone should see all data  
- Not everyone can approve or perform actions  
- Responsibilities differ by job, team, and department  
- Compliance requires proper control and traceability  

This module ensures:

✅ Only authorized users can perform actions  
✅ Access is based on roles and responsibilities  
✅ Segregation of duties is enforced  
✅ The system remains secure and compliant  

---

## Key Concept

Authorization answers the question:

> **“What can this person do in the system?”**

---

## How Access is Determined

Access is not given randomly. It is based on a combination of:

### 1. Attributes (ABAC – Attribute-Based Access Control)

Access is derived from attributes such as:

- Organization (which company)
- Department / OrgUnit
- Team
- Job Position
- Job Role
- Contract type

✅ Example:
- A user in **Maintenance Department** can access maintenance data  
- A **Supervisor role** can approve tasks  

---

### 2. Roles (RBAC – Role-Based Access Control)

Roles represent responsibilities and permissions.

Examples:
- Admin  
- Supervisor  
- Technician  
- Approver  

✅ Roles define:
- What actions are allowed (view, create, approve, delete)

---

### 3. Hybrid Model (ABAC + RBAC)

The system combines both approaches:

- **Attributes define context**
- **Roles define permissions**

✅ This allows:
- Flexible and dynamic access control  
- Less manual role management  
- Better alignment with real business structure  

---

## Role Structure (Based on Domain)

Roles are linked to different parts of the system using prefixes:

| Prefix | Meaning | Example |
|------|------|------|
| o. | Organization | o.atm |
| d. | OrgUnit (Department) | d.facility.member |
| t. | OrgTeam | t.safety.player |
| u. | User | u.visitor |
| s. | Staff | s.shift |
| e. | Employee | e.jobgrade |
| p. | JobPosition | p.technician |
| r. | JobRole | r.recruiter |
| c. | JobContract | c.ftc |

✅ This ensures roles are clearly linked to business context  

---

## How It Works (Simple Flow)

### Continuous staff attribute updates

1. A sync with staff database occurs
2. The system identifies the linked **Staff**  
3. Staff is assigned to:
   - Job Position  
   - Job Role  
   - Org Unit / Team  
4. Attributes are evaluated  
5. StaffRole created and maintained  

### User Login
1. User is attached to Staff either automatically or manually
2. Roles are applied based on StaffRole  
3. Permissions are enforced 

---

## Example (Simple Scenario)

- Person: Ahmad  
- Department: Maintenance  
- Role: Technician  

Result:
- Ahmad can:
  - View maintenance tasks  
  - Perform assigned work  
- Ahmad cannot:
  - Approve budgets  
  - Modify company settings  

---

## Segregation of Duties (Important for Compliance)

The system ensures that:

- A person who **creates** cannot always **approve**  
- Critical actions require proper authority  
- Conflicts of interest are minimized  

✅ Important for audits and governance  

---

## Integration with Other Modules

- **Org** → Defines structure (department, team)  
- **Person** → Identifies the user  
- **Job** → Defines roles and responsibilities  
- **Workflow** → Controls approval authority  
- **Audit** → Tracks all access and actions  

---

## Flexibility for Business

The system allows:

- Automatic role generation from attributes  
- Manual role assignment where needed  
- Fine-grained access control  
- Multi-company and multi-site access rules  

---

## Audit & Traceability

All access and actions are tracked:

- Who performed an action  
- What action was performed  
- When it happened  

✅ Supports compliance and investigations  

---

## Summary

The Authorization module ensures that:

- Access is controlled based on real business structure  
- Responsibilities are clearly enforced  
- Security and compliance are maintained  
- The system adapts to organizational changes  

---

## In Simple Terms

Think of it like:

- **Attributes** → Who you are and where you belong  
- **Role** → What you are allowed to do  

And the system ensures that **everyone can only do what they are supposed to do**.
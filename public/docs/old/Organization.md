# Organization (Business Overview)

The **Organization** module defines how a company is structured, who the people are, and how work is assigned.

It ensures that the system clearly understands:
- Where people belong
- What roles exist
- Who is responsible for what

---

## Why This Matters

In any company, especially manufacturing:

- People move between roles
- Teams change over time
- Responsibilities shift
- Contracts start and end

This module ensures all these changes are handled **clearly and consistently**, without breaking the system.

---

## Key Components

### 1. Organizational Structure (Org)

This defines how the company is arranged.

- **Organization** → The company itself  
- **Org Unit** → Departments (e.g., Production, Finance)  
- **Org Team** → Smaller teams within departments  

✅ Focus: *Structure only (no people inside yet)*

---

### 2. People (Person)

This represents individuals in the system.

- **User** → Login account  
- **Staff / Employee** → The actual person  

✅ Focus: *Who the person is (name, details, identity)*  
❌ Does NOT define their job or role

---

### 3. Work & Responsibilities (Job)

This defines what work exists and how it is assigned.

- **Job Position** → A job slot (e.g., Technician, Supervisor)  
- **Job Role** → Responsibilities (e.g., Approver, Operator)  
- **Job Contract** → Duration of the assignment  

✅ Focus: *What needs to be done, not who does it*

---

## How It Works Together

Instead of mixing everything, the system links them:

- A **Person** is assigned to a **Job Position**
- A **Job Position** belongs to a **Team / Department**
- A **Job Role** defines what actions are allowed
- A **Job Contract** defines how long the assignment lasts

---

## Example (Simple Scenario)

- Department: Maintenance  
- Team: Electrical  
- Position: Technician  
- Person: Ahmad  

Ahmad is:
- Assigned to the *Technician position*
- Working in the *Electrical team*
- Given a *role* (e.g., execute tasks)
- Assigned for a *specific time period*

---

## Flexibility (Important for Business)

This design allows the business to:

- Move people between teams easily
- Assign multiple roles to one person
- Track history of roles and assignments
- Support temporary or contract workers
- Adapt to organizational changes without system redesign

---

## Custom Attributes

Each part (Org, Person, Job) can store additional business-specific information such as:

- Skill level
- Certification
- Department type
- Cost center

✅ No need to change system structure for new requirements

---

## Access & Permissions

What a person can do in the system is based on:

- Their **role**
- Their **attributes**
- Their **position in the organization**

This ensures proper:
- Approval control
- Segregation of duties
- Security compliance

---

## Summary

The Organization module ensures:

- Clear separation between **structure, people, and work**
- Flexible assignment of people to roles
- Easy handling of changes over time
- Strong foundation for business processes

---

## In Simple Terms

Think of it like:

- **Org** → The company structure (boxes)
- **Person** → The people (names)
- **Job** → The responsibilities (what needs to be done)

And the system connects them in a clean, flexible way.
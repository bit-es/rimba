# Asset Management (Business Overview)

The **Asset Management module** manages all physical and operational assets within the organization across their full lifecycle.

It ensures that assets are:
- Properly registered
- Maintained regularly
- Used efficiently
- Tracked until disposal

---

## Why This Matters

In a manufacturing environment:

- Machines and equipment are critical to operations
- Breakdowns cause production loss
- Poor tracking leads to inefficiencies
- Compliance requires maintenance records

This module ensures the organization always knows:

✅ What assets exist  
✅ Where they are  
✅ What condition they are in  
✅ When maintenance is due  
✅ Who is responsible  

---

## Key Objectives

The Asset module ensures:

- Full visibility of all assets
- Planned and controlled maintenance
- Reduced downtime
- Traceability of asset history
- Support for audits and compliance

---

## Key Components

### 1. Asset Register

A central list of all assets.

Examples:
- Machines
- Tools
- Vehicles
- IT equipment

✅ Each asset includes:
- Asset ID
- Name and type
- Location
- Owner / responsible team
- Status (active, under maintenance, disposed)

---

### 2. Asset Lifecycle

Tracks the full life of an asset:

1. Acquisition (purchase or installation)  
2. Operation (in use)  
3. Maintenance (servicing and repair)  
4. Disposal (retirement or replacement)  

✅ Ensures proper planning and cost control

---

### 3. Maintenance Management

Ensures assets remain in good condition.

Types of maintenance:
- **Preventive** → Scheduled servicing  
- **Corrective** → Fix after breakdown  
- **Predictive** → Based on condition or usage  

✅ Helps reduce unexpected failures

---

### 4. Work Orders

Used to manage maintenance activities.

✅ Includes:
- Task details
- Assigned personnel
- Required parts/tools
- Status tracking

---

### 5. Asset Status

Shows current condition of the asset:

- Active
- In Maintenance
- Out of Service
- Obsolete / Disposed

✅ Helps operations make quick decisions

---

## How It Works (Simple Flow)

1. Asset is **registered** in the system  
2. Assigned to a **location/team**  
3. Maintenance schedules are defined  
4. Work orders are created when needed  
5. Maintenance activities are recorded  
6. Asset history is tracked  
7. Asset is eventually **retired or replaced**

---

## Example (Simple Scenario)

- Asset: CNC Machine  
- Location: Production Floor  
- Responsible: Maintenance Team  

Process:
- Machine is registered
- Monthly maintenance is scheduled
- A work order is created automatically
- Technician performs maintenance
- Record is saved in asset history
- Machine continues operation

---

## Compliance & Audit Support

The module supports operational and quality standards (including ISO practices) by:

- Maintaining complete asset history
- Recording all maintenance activities
- Ensuring scheduled maintenance is not missed
- Providing traceability of actions and responsibilities

✅ Useful for audits and inspections  

---

## Integration with Other Modules

- **Org** → Defines asset location and ownership  
- **Person** → Identifies responsible personnel  
- **Job** → Assigns roles (e.g., technician, approver)  
- **Workflow** → Controls approvals for maintenance or disposal  
- **Task** → Generates maintenance tasks  
- **Audit** → Tracks all asset-related changes  

---

## Flexibility for Business

The system allows the organization to:

- Manage multiple asset types
- Support multi-site operations
- Customize maintenance schedules
- Track both simple and complex equipment

---

## Custom Attributes

Assets can include additional business-specific details:

- Manufacturer
- Serial number
- Warranty period
- Maintenance frequency
- Operating capacity

✅ Easily extendable without redesign

---

## Summary

The Asset Management module ensures that:

- All assets are properly tracked
- Maintenance is planned and executed
- Downtime is minimized
- Asset history is available for audits
- The organization operates efficiently

---

## In Simple Terms

Think of it like:

- **Asset** → The equipment or item  
- **Maintenance** → Keeping it in good condition  
- **Work Order** → The job to fix or service it  
- **Lifecycle** → From purchase to disposal  

And the system ensures every asset is **well-managed from start to end**.

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

# Calendar Management (Business Overview)

The **Calendar module** manages all company-related dates, schedules, and events in a single place.

It provides visibility of:
- Company events
- Public holidays
- Working days
- Staff shift schedules

---

## Why This Matters

In daily operations:

- Employees need to know working days and shifts  
- Management needs to plan around holidays and events  
- Operations depend on accurate scheduling  
- Misalignment can cause delays or missed work  

This module ensures the organization always knows:

✅ When people are working  
✅ When the company is closed  
✅ What events are happening  
✅ How shifts are structured  

---

## Key Objectives

The Calendar module helps to:

- Centralize all company dates and schedules  
- Align operations with working days and shifts  
- Support workforce planning  
- Improve coordination across teams  

---

## Key Components

### 1. Event

Represents any important company-related activity.

Examples:
- Company townhall  
- Safety day  
- Maintenance shutdown  
- Training session  

✅ Each event includes:
- Name
- Date and time
- Type (company event, operational, etc.)
- Description

---

### 2. Holiday

Represents non-working days.

Examples:
- Public holidays  
- Company-declared holidays  

✅ Used to:
- Block scheduling
- Adjust work planning
- Inform employees  

---

### 3. Workday

Defines whether a day is a working day or non-working day.

✅ Supports:
- Standard working calendars  
- Custom work schedules  

---

### 4. Shift Pattern

Defines how work is organized across time.

Examples:
- Day shift  
- Night shift  
- Rotational shift  

✅ Includes:
- Start and end time  
- Rest days  
- Rotation rules  

---

### 5. Shift Group

Groups employees under a common shift pattern.

Examples:
- Production Team A → Day Shift  
- Production Team B → Night Shift  

✅ Ensures:
- Consistent scheduling  
- Easier management of large teams  

---

## How It Works Together

The system combines all elements:

- **Holidays** define non-working days  
- **Workdays** define normal operations  
- **Shift Patterns** define working hours  
- **Shift Groups** assign employees to schedules  
- **Events** provide additional context  

---

## Example (Simple Scenario)

- Holiday: Public Holiday (Monday)  
- Shift Pattern: Day Shift (8AM–5PM)  
- Team: Production Team A  

Process:
- Monday is marked as a holiday → no work scheduled  
- Tuesday resumes normal shift operations  
- Team A follows day shift schedule  

---

## Staff Scheduling

Each staff member’s work schedule is determined by:

- Their **shift group**
- The **shift pattern**
- The **calendar (holidays and workdays)**

✅ Ensures accurate and consistent scheduling  

---

## Integration with Other Modules

- **Org** → Defines teams and departments  
- **Person** → Links employees to shift groups  
- **Job** → Aligns roles with shift requirements  
- **Task** → Schedules tasks based on working time  
- **LMS** → Plans training on available days  
- **Asset** → Schedules maintenance during downtime  

---

## Flexibility for Business

The system allows:

- Multiple shift patterns (e.g., 24/7 operations)  
- Different calendars for different locations  
- Special events and shutdown periods  
- Dynamic reassignment of staff to shifts  

---

## Custom Attributes

Calendar entries can include additional details such as:

- Location
- Department applicability
- Event category
- Priority level

✅ Easily adaptable to business needs  

---

## Summary

The Calendar module ensures that:

- All company events and schedules are centralized  
- Working and non-working days are clearly defined  
- Staff shifts are properly managed  
- Operations are aligned with time and availability  

---

## In Simple Terms

Think of it like:

- **Holiday** → Days off  
- **Event** → Things happening  
- **Shift** → When people work  
- **Group** → Who follows which shift  

And the system ensures everyone knows **when to work and what is happening** across the company.

# Service Catalog (Menu) – Business Overview

The **Service Catalog** defines the list of services that the organization provides internally.

It acts as a **menu of services** that employees can request, similar to choosing items from a menu.

---

## Why This Matters

In daily operations:

- Employees need support (IT, maintenance, facilities, etc.)
- Requests are often unclear or inconsistent
- No standard way to request services
- Tracking and prioritization becomes difficult

This module ensures:

✅ Services are clearly defined  
✅ Requests are standardized  
✅ Expectations are consistent  
✅ Service delivery is trackable  

---

## Key Objectives

The Service Catalog helps to:

- Provide a clear list of available services  
- Standardize how requests are made  
- Define responsibilities and expectations  
- Improve service efficiency and transparency  

---

## Key Components

### 1. Service

A **Service** represents something the organization offers internally.

Examples:
- Repair Machine  
- Request Laptop  
- IT Support  
- Facility Cleaning  
- Equipment Calibration  

✅ Each service includes:
- Service name  
- Description  
- Responsible team  
- Expected turnaround time (SLA)  

---

### 2. Service Category (Menu Structure)

Services can be grouped into categories for easy navigation.

Examples:
- IT Services  
- Maintenance Services  
- HR Services  
- Facility Services  

✅ Makes it easier for users to find what they need  

---

### 3. Request Form

Each service has a predefined request format.

Examples:
- Machine ID for repair  
- Issue description for IT support  
- Location for facility requests  

✅ Ensures complete and consistent information  

---

### 4. Service Level Agreement (SLA)

Defines expected service performance.

Examples:
- Response time: within 4 hours  
- Resolution time: within 2 days  

✅ Helps:
- Set expectations  
- Measure performance  
- Improve accountability  

---

### 5. Service Owner

Defines who is responsible for delivering the service.

- Usually a team (e.g., Maintenance Team, IT Team)  
- Can be linked to **OrgTeam** or **JobRole**

✅ Ensures clear ownership  

---

## How It Works (Simple Flow)

1. A user selects a service from the **catalog**  
2. Fills in the **request form**  
3. A **task or workflow** is triggered  
4. The responsible team is assigned  
5. Work is performed and tracked  
6. Request is completed  

---

## Example (Simple Scenario)

- Service: Repair Machine  
- Category: Maintenance  

Process:
1. Operator selects "Repair Machine"  
2. Enters machine details and issue  
3. System creates a task  
4. Assigned to Maintenance Technician  
5. Technician completes repair  
6. Request is closed  

---

## Integration with Other Modules

- **Task** → Generates tasks to perform the service  
- **Workflow** → Manages approval and execution flow  
- **Org** → Defines owning department/team  
- **Person** → Identifies requester and assignee  
- **Asset** → Links service to equipment  
- **Notification** → Updates users on progress  
- **Audit** → Tracks service history  

---

## Flexibility for Business

The system allows:

- Different services per department  
- Custom request forms  
- SLA definitions per service  
- Role-based service ownership  
- Expansion as new services are introduced  

---

## Custom Attributes

Services can include additional details such as:

- Priority level  
- Required approvals  
- Cost center  
- Service type (operational, support, emergency)  

✅ Easily configurable to business needs  

---

## Summary

The Service Catalog ensures that:

- Services are clearly defined and accessible  
- Requests are standardized and complete  
- Work is assigned and tracked properly  
- Service delivery is efficient and measurable  

---

## In Simple Terms

Think of it like:

- **Service Catalog** → A menu of services  
- **Service** → An item on the menu  
- **Request** → Ordering the service  
- **SLA** → How fast it should be delivered  

And the system ensures that **everyone knows what services are available and how to request them properly**.

# Certificate Management (Business Overview)

The **Certificate module** manages proof that a person is qualified, trained, or authorized to perform specific work.

It ensures that:
- Certifications are properly issued and tracked
- Expiry dates are monitored
- Only qualified personnel perform critical tasks

---

## Why This Matters

In many organizations, especially manufacturing:

- Certain tasks require certified personnel
- Certifications may expire
- Auditors require proof of qualification
- Unqualified work can lead to safety risks

This module ensures the organization always knows:

✅ Who is certified  
✅ What they are certified for  
✅ Whether the certificate is still valid  
✅ When renewal is required  

---

## Key Objectives

The Certificate module helps to:

- Track all certifications in one place  
- Ensure compliance with internal and external standards  
- Prevent unqualified task assignments  
- Support audits and inspections  

---

## Key Components

### 1. Certificate

Represents an official recognition that a person has met certain requirements.

Examples:
- Safety Certification  
- Machine Operation License  
- Quality Training Certificate  

✅ Each certificate includes:
- Certificate name
- Issued to (person)
- Issue date
- Expiry date (if applicable)
- Status (valid, expired, revoked)

---

### 2. Certification Requirement

Defines which certificates are required for:

- A **Job Role** (e.g., Operator must have safety training)
- A **Task** (e.g., only certified personnel can perform)

✅ Ensures the right qualification is enforced automatically  

---

### 3. Validity & Expiry

Certificates may have:

- No expiry (lifetime certification)  
- Fixed validity period (e.g., 1 year, 3 years)  

✅ System tracks and alerts when:
- Certificate is about to expire  
- Certificate has expired  

---

### 4. Certificate Status

Tracks the state of each certificate:

- Valid  
- Expired  
- Suspended  
- Revoked  

✅ Helps ensure only valid certifications are used  

---

### 5. Issuance

Certificates can be issued:

- After **training completion (LMS)**  
- After **assessment or evaluation**  
- By **authorized personnel or external bodies**  

✅ Ensures controlled and traceable certification  

---

## How It Works (Simple Flow)

1. A certification requirement is defined  
2. A person completes training or assessment  
3. A certificate is issued  
4. The system tracks validity and expiry  
5. Alerts are sent before expiry  
6. Renewal or re-training is performed if needed  

---

## Example (Simple Scenario)

- Role: Forklift Operator  
- Requirement: Forklift Certification  
- Person: Ahmad  

Process:
- Ahmad completes forklift training  
- Certificate is issued (valid for 2 years)  
- System tracks expiry date  
- Reminder is sent before expiry  
- Ahmad renews certification  

---

## Compliance & Audit Support

The Certificate module supports compliance by:

- Keeping proof of qualification for each employee  
- Tracking validity and expiry  
- Ensuring only certified personnel perform certain work  
- Providing records during audits  

✅ Important for safety, quality, and regulatory audits  

---

## Integration with Other Modules

- **LMS (Learning)** → Issues certificates after training  
- **Job** → Defines which roles require certification  
- **Task** → Restricts task execution to certified personnel  
- **Org** → Applies requirements by department or team  
- **Notification** → Sends expiry reminders  
- **Audit** → Tracks certificate issuance and changes  

---

## Flexibility for Business

The system allows:

- Multiple certificates per person  
- Different validity periods  
- Internal and external certifications  
- Role-based or task-based requirements  

---

## Custom Attributes

Certificates can include additional details such as:

- Issuing authority  
- Certificate number  
- Score or grade  
- Training provider  
- Supporting documents  

✅ Easily extended for business needs  

---

## Summary

The Certificate module ensures that:

- Employee qualifications are properly tracked  
- Expiry and renewals are managed  
- Only certified personnel perform critical work  
- The organization remains compliant and audit-ready  

---

## In Simple Terms

Think of it like:

- **Certificate** → Proof someone is qualified  
- **Requirement** → What is needed for a job or task  
- **Expiry** → When it must be renewed  

And the system ensures that **only the right, qualified people are allowed to do the job**.

# Document Management System (Business Overview)

The **Document Management System (DMS)** ensures that all organizational documents are properly controlled, accessible, and compliant with standards such as **ISO 9001**.

It manages the full lifecycle of documents from creation to approval, distribution, revision, and archival.

---

## Why This Matters (ISO 9001 Context)

ISO 9001 requires organizations to:

- Maintain **documented information**
- Ensure documents are **approved before use**
- Control **changes and revisions**
- Provide access to the **correct version**
- Prevent use of **obsolete documents**

This module ensures all these requirements are met consistently.

---

## Key Objectives

The DMS ensures:

✅ Only approved documents are used  
✅ Latest versions are always available  
✅ Changes are traceable  
✅ Documents are protected from unauthorized changes  
✅ Obsolete documents are controlled  

---

## Key Components

### 1. Document

Represents any controlled information in the organization.

Examples:
- SOPs (Standard Operating Procedures)
- Work Instructions
- Policies
- Technical Drawings
- Contracts

✅ Each document has:
- Title
- Type
- Owner
- Version
- Status

---

### 2. Document Version

Every change creates a **new version**, instead of overwriting.

✅ Supports:
- Version numbering (e.g., v1.0, v1.1, v2.0)
- Revision history
- Change tracking

---

### 3. Approval Workflow

Documents must go through a controlled process:

1. Draft
2. Review
3. Approval
4. Release (available for use)

✅ Ensures:
- Proper authorization
- Segregation of duties
- Controlled publishing

---

### 4. Document Status

Typical statuses include:

- Draft
- Under Review
- Approved
- Released
- Obsolete

✅ Only **Released** documents should be used in operations

---

### 5. Access Control

Defines who can:

- View documents
- Edit drafts
- Approve documents
- Archive documents

✅ Based on roles, responsibilities, and organizational structure

---

## How It Works (Simple Flow)

1. A document is **created** (Draft)
2. It is **reviewed** by relevant personnel
3. It is **approved** by an authorized person
4. It is **released** for use
5. If changes are needed:
   - A new version is created
   - Process repeats
6. Old version becomes **obsolete**

---

## Example (Simple Scenario)

- Document: Machine Operation SOP  
- Created by: Engineer  
- Reviewed by: Supervisor  
- Approved by: Manager  

Process:
- SOP is drafted
- Reviewed and corrected
- Approved officially
- Released to operators
- Old version is archived when updated

---

## Compliance Features (ISO 9001 Alignment)

The system supports:

### Document Control
- Unique identification of documents
- Version control and revision history
- Approval before release

### Change Management
- Track what changed, when, and by whom
- Prevent unauthorized modifications

### Access & Distribution
- Ensure correct documents are available where needed
- Restrict access based on role

### Obsolete Document Control
- Prevent use of outdated documents
- Archive for reference and audit

### Audit Trail
- Full history of actions (create, update, approve, archive)

---

## Integration with Other Modules

- **Org** → Defines document ownership and responsibility  
- **Person** → Identifies authors, reviewers, and approvers  
- **Job** → Determines authority levels (who can approve)  
- **Workflow** → Manages approval process  
- **Audit** → Tracks all document changes  

---

## Flexibility for Business

The system allows:

- Different document types (SOP, policy, contract)
- Custom approval workflows
- Department-specific document control
- Multi-site document management

---

## Custom Attributes

Documents can include additional business-specific details:

- Document category
- Applicable department
- Regulatory reference
- Effective date
- Review cycle

✅ Extendable without system changes

---

## Summary

The Document Management System ensures that:

- Documents are properly controlled and approved
- Only the latest versions are used
- Changes are tracked and auditable
- The organization remains compliant with ISO 9001

---

## In Simple Terms

Think of it like:

- **Document** → The content (SOP, policy, etc.)
- **Version** → The history of changes
- **Workflow** → The approval process
- **Status** → Whether it is ready to use

And the system makes sure everyone always uses the **right document at the right time**.

# Learning (Business Overview)

The **Learning Management System (LMS)** helps the organization manage employee training, skills, and certifications.

It ensures that:
- Employees are properly trained
- Required certifications are tracked
- Skills are aligned with job requirements

---

## Why This Matters

In a manufacturing environment:

- Employees must follow strict procedures
- Certifications may be mandatory (e.g., safety, machinery)
- Skills need to match job roles
- Training must be tracked for audits and compliance

This module ensures the company always knows:
✅ Who is trained  
✅ Who needs training  
✅ Who is qualified to perform certain work  

---

## Key Components

### 1. Training

Represents learning programs provided by the organization.

Examples:
- Safety Training
- Machine Operation Training
- Quality Procedures

✅ Can be mandatory or optional  
✅ Can be linked to job roles or positions  

---

### 2. Certification

Represents proof that a person has completed training.

Examples:
- Forklift License
- Safety Certification
- ISO Compliance Training

✅ May have expiry dates  
✅ Required for certain roles or tasks  

---

### 3. Competency

Defines the skill level of a person.

Examples:
- Beginner
- Intermediate
- Expert

✅ Helps determine if a person is fit for a job  
✅ Can be evaluated through training or assessment  

---

## How It Works Together

The system connects learning with jobs and people:

- A **Job Role** defines required training or certifications  
- A **Person** attends training  
- Upon completion, a **Certification** is issued  
- The system updates the person’s **Competency level**

---

## Example (Simple Scenario)

- Role: Machine Operator  
- Required Training: Machine Safety Training  
- Person: Ahmad  

Process:
1. Ahmad is assigned to the Machine Operator role  
2. The system identifies required training  
3. Ahmad attends and completes the training  
4. Ahmad receives certification  
5. Ahmad is now qualified to operate the machine  

---

## Compliance & Audit

The LMS helps ensure:

- All required training is completed
- Expired certifications are flagged
- Reports are available for audits
- Only qualified personnel perform critical tasks

✅ Important for safety and regulatory compliance  

---

## Flexibility for Business

The system allows the organization to:

- Define different training per role or department
- Adjust requirements over time
- Track both internal and external training
- Handle multiple certifications per employee

---

## Integration with Other Modules

- **Org** → Determines where the employee belongs  
- **Person** → Identifies who is trained  
- **Job** → Defines what training is required  
- **Access** → Restricts actions based on certification  

---

## Custom Attributes

Training, certifications, and competencies can include additional details such as:

- Training provider
- Assessment score
- Validity period
- Skill category

✅ Easily extended based on business needs  

---

## Summary

The Learning module ensures that:

- Employees are properly trained
- Skills match job requirements
- Certifications are tracked and valid
- The organization meets compliance standards

---

## In Simple Terms

Think of it like:

- **Training** → What people need to learn  
- **Certification** → Proof they learned it  
- **Competency** → How good they are at it  

And the system makes sure the right people have the right skills at the right time.

# Location Management (Business Overview)

The **Location module** defines where things exist in the real world.

It provides a structured way to manage:
- Sites
- Buildings
- Areas
- Physical spaces

---

## Why This Matters

In operations, especially manufacturing:

- Work happens at specific locations  
- Assets are placed in physical areas  
- Staff may work across different sites  
- Some processes depend on location  

Without proper location management:
- Assets can be misplaced  
- Work assignments become unclear  
- Reporting becomes inaccurate  

This module ensures:

✅ Clear visibility of all physical locations  
✅ Accurate tracking of assets and activities  
✅ Better planning and coordination  

---

## Key Concept

Location answers the question:

> **“Where does this happen?”**

---

## Key Components

### 1. Location

Represents a physical place in the organization.

Examples:
- Factory Site  
- Warehouse  
- Office Building  
- Production Line  

✅ Each location includes:
- Name  
- Type (site, building, area, etc.)  
- Parent location (for hierarchy)  

---

### 2. Location Hierarchy

Locations can be structured in levels.

Example:

- Site: Main Factory  
  - Building: Block A  
    - Area: Production Floor  
      - Section: Line 1  

✅ Enables:
- Clear physical structure  
- Easy navigation and reporting  

---

### 3. Location Assignment

Locations can be linked to different entities:

- **Organization** → Where the company operates  
- **OrgUnit / Team** → Where work happens  
- **Staff** → Where a person is based or assigned  
- **JobPosition** → Where the job is performed  
- **Asset** → Where equipment is located  

✅ Creates strong real-world context  

---

## How It Works (Simple Flow)

1. Locations are defined and structured  
2. Entities (people, jobs, assets) are assigned to locations  
3. Operations are executed based on location  
4. Reports and tracking use location data  

---

## Example (Simple Scenario)

- Site: Manufacturing Plant  
- Area: Production Floor  
- Asset: CNC Machine  
- Staff: Technician  

Process:
- CNC Machine is assigned to Production Floor  
- Technician is assigned to same area  
- Maintenance task is linked to that location  

✅ Everyone knows where the work happens  

---

## Location vs Organization (Important)

The system clearly separates:

- **Organization** → Structure (departments, teams)  
- **Location** → Physical place  

✅ Example:
- Maintenance Department (Org)  
- Production Floor (Location)

Both are linked but **serve different purposes**

---

## Integration with Other Modules

- **Org** → Links departments to locations  
- **Person** → Assigns staff to locations  
- **Job** → Defines where jobs are performed  
- **Asset** → Tracks physical placement of equipment  
- **Task** → Executes work at specific locations  
- **Workflow** → Supports location-based approvals  
- **Calendar** → May vary by location (e.g., site holidays)  

---

## Flexibility for Business

The system allows:

- Multiple sites (multi-plant operations)  
- Flexible location hierarchy  
- Shared or cross-location operations  
- Location-based reporting and control  

---

## Custom Attributes

Locations can include additional details such as:

- Address  
- GPS coordinates  
- Capacity  
- Safety classification  
- Operational status  

✅ Easily extended for business needs  

---

## Summary

The Location module ensures that:

- All physical places are clearly defined  
- Assets, people, and work are tied to real locations  
- Operations are better organized and traceable  
- Multi-site businesses are fully supported  

---

## In Simple Terms

Think of it like:

- **Location** → Where something exists  
- **Hierarchy** → How places are organized  
- **Assignment** → Who or what is at that place  

And the system ensures that **everything in the organization is connected to a real-world location**.

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

# System Panels (Business Overview)

The platform provides a unified user experience through **three complementary panels**, each serving a distinct purpose:

- **Staff Portal (TACKLE)** → Individual daily work
- **Team Panel** → Team coordination and delivery
- **Admin Portal** → System configuration and governance

Together, they form a complete operational ecosystem.

---

## Overall Concept

Each panel answers a different question:

- **Staff Portal** → “What do I need to do?”
- **Team Panel** → “How do we deliver as a team?”
- **Admin Portal** → “How is the system defined and controlled?”

---

# 1. Staff Service Portal – “TACKLE”

The **Staff Portal** is the **main working interface** for employees.

It acts as the **nerve center of daily activities**, where staff:
- Execute tasks
- Request services
- Access knowledge
- Manage personal work-related items

---

## TACKLE Structure

### **T – Todo**
**Daily Catch & Priority Tasks**

- View assigned tasks  
- Track pending and urgent work  
- Monitor deadlines  

✅ *Focus: What needs to be done now*

---

### **A – Artifact**
**Personal Work Assets**

- Profile information  
- Assigned assets (equipment, tools)  
- Certificates and qualifications  

✅ *Focus: What belongs to me*

---

### **C – Catalog**
**Service Menu & Quick Access**

- Request services (IT, maintenance, HR)  
- Browse available offerings  
- Access external tools/links  

✅ *Focus: What I can request*

---

### **K – Knowledge**
**Documents & Learning**

- SOPs, policies, manuals  
- Training materials  
- Learning programs  

✅ *Focus: What I need to know*

---

### **L – Location**
**Physical Awareness**

- Floor plans  
- Site navigation  
- Location of assets and teams  

✅ *Focus: Where things are*

---

### **E – Emergency**
**Critical Support**

- Emergency contacts  
- Incident reporting  
- Risk and issue logging  

✅ *Focus: What to do in urgent situations*

---

## Staff Portal Summary

👉 A **simple, action-oriented workspace** for employees to perform daily work efficiently.

---

# 2. Team Panel – Team Operations

The **Team Panel** provides a **shared workspace for teams** to manage work collectively.

It focuses on:
- Coordination  
- Accountability  
- Quality control  
- Continuous improvement  

---

## Why Team Panel Exists

Work is not done individually — it is delivered by **teams with structured roles**.

✅ Ensures:
- Clear responsibilities  
- Better coordination  
- Higher quality output  

---

## Team Roles (Operating Model)

Each team operates using defined **functional roles**:

---

### <img src="pics/team_scout.png" width="48" height="48"> Scout (Entry & Final Authority)

- Brings work into the team  
- Owns intake (requests, assignments)  
- Provides final sign-off  

✅ Assures request fulfilment  

---

### <img src="pics/team_quartermaster.png" width="48" height="48"> Quartermaster (Resources)

- Manages tools, assets, inventory  
- Ensures readiness before work starts  

✅ Removes operational delays  

---

### <img src="pics/team_coach.png" width="48" height="48"> Coach (Capability Development)

- Trains team members  
- Links LMS materials and assessments  
- Improves skills over time  

✅ Builds team competency  

---

### <img src="pics/team_players.png" width="48" height="48"> Player (Execution)

- Performs actual work  
- Completes assigned tasks  

✅ Core workforce  

---

### <img src="pics/team_captain.png" width="48" height="48"> Captain (Quality & Ownership)

- Oversees daily operations  
- Ensures quality standards  

✅ Team owner and controller  

---

### <img src="pics/team_tactician.png" width="48" height="48"> Tactician (Knowledge & Process)

- Writes procedures (SOPs)  
- Maintains documentation  
- Standardizes processes  

✅ Keeps work consistent and structured  

---

## Team Workflow (Simple)

1. **Scout** receives work  
2. Work assigned to **Players**  
3. **Quartermaster** ensures resources  
4. Work is executed  
5. **Captain** reviews quality  
6. **Scout** signs off  
7. **Tactician** updates knowledge  
8. **Coach** improves skills  

---

## Team Panel Summary

👉 A **team operating system** that ensures work is delivered **properly, consistently, and with quality**

---

# 3. Admin Portal – System Management

The **Admin Portal** is used to **configure and maintain the platform**.

It is not for daily operations, but for:
- Setup  
- Control  
- Governance  

---

## Key Responsibilities

### Configuration
- Organization structure  
- Locations  
- Job positions and roles  
- Attributes  

---

### Process Setup
- Workflows  
- Task templates & Work Packages  
- Service Catalog  

---

### Access Control
- Roles and permissions  
- ABAC (attribute-based access)  
- User and staff management  

---

### Content Management
- Documents (DMS)  
- Learning materials (LMS)  

---

### Monitoring
- Requests and services  
- Tasks and workflows  
- Reports and dashboards  

---

## Admin Portal Summary

👉 A **control center** for configuring how the business operates within the system

---

# Panel Comparison

| Area | Staff Portal (TACKLE) | Team Panel | Admin Portal |
|------|------|------|------|
| Focus | Individual work | Team coordination | System configuration |
| Users | All employees | Teams | Admins / managers |
| Purpose | Execute tasks | Deliver work as a team | Configure & control |
| Nature | Simple & guided | Operational & collaborative | Advanced & structured |

---

# Overall System View

The three panels work together:

- **Staff Portal** drives **execution (individual level)**  
- **Team Panel** drives **coordination (team level)**  
- **Admin Portal** drives **control (system level)**  

---

## Final Summary

The platform ensures:

✅ Individuals know what to do  
✅ Teams know how to deliver  
✅ The system ensures everything is controlled  

---

## In Simple Terms

- **Staff Portal** → *“Do my work”*  
- **Team Panel** → *“Work together”*  
- **Admin Portal** → *“Set the rules”*  

👉 Together, they create a complete, scalable, and well-governed operational system.

# Request Management (Business Overview)

The **Request module** manages how users ask for something to be done within the organization.

It serves as the **starting point of most business processes**, and is typically **closely linked to workflows** to ensure proper handling, approvals, and execution.

---

## Why This Matters

In daily operations:

- Requests come from many sources (email, messages, verbal)
- Information may be incomplete or inconsistent
- No clear tracking of progress
- Approvals may be skipped or unclear

This module ensures:

✅ All requests are properly captured  
✅ Requests follow a controlled process  
✅ Progress is tracked from start to end  
✅ Responsibilities are clearly defined  

---

## Key Concept

A **Request** answers the question:

> **“Something is needed — how do we get it done properly?”**

---

## Strong Link to Workflow (Important)

In most cases:

👉 A **Request is tightly linked to a Workflow**

- The **Request** captures the need  
- The **Workflow** controls how it is processed  

✅ Without workflow → request is just a record  
✅ With workflow → request becomes a controlled process  

---

## Key Components

### 1. Request

Represents a demand, need, or submission from a user.

Examples:
- Request for maintenance  
- IT support request  
- Leave request  
- Purchase request  

✅ Each request includes:
- Request type  
- Description  
- Requester (person)  
- Related data (asset, location, etc.)  
- Status  

---

### 2. Request Type

Defines the category of the request.

Examples:
- Maintenance Request  
- IT Support Request  
- HR Request  

✅ Determines:
- Required information  
- Associated workflow  
- Responsible team  

---

### 3. Workflow Binding

Each request type is usually linked to a **specific workflow**.

✅ Example:
- Maintenance Request → Maintenance Workflow  
- Purchase Request → Approval Workflow  

This ensures:
- Consistent handling  
- Standard approval steps  
- Controlled execution  

---

### 4. Status

The status reflects the progress of the request:

- Submitted  
- Under Review  
- Approved / Rejected  
- In Progress  
- Completed  
- Closed  

✅ Status is typically driven by the workflow  

---

### 5. Assignment

Requests are routed to:

- A **team**, or  
- A **role**, or  
- A specific **person**  

✅ Based on workflow rules and responsibilities  

---

## How It Works (Simple Flow)

1. User **submits a request**  
2. System identifies the **Request Type**  
3. Linked **Workflow is triggered**  
4. Request goes through:
   - Review  
   - Approval  
   - Execution  
5. Tasks may be generated  
6. Request is **completed and closed**

---

## Example (Simple Scenario)

### Maintenance Request

1. Operator submits request for machine issue  
2. Request triggers Maintenance Workflow  
3. Supervisor reviews request  
4. Approval is given  
5. Task is assigned to technician  
6. Repair is completed  
7. Request is closed  

✅ Entire process is tracked and controlled  

---

## Relationship with Other Modules

- **Workflow** → Controls the lifecycle of the request (critical link)  
- **Task** → Executes work generated from the request  
- **Service Catalog** → Defines available request types (menu)  
- **Org** → Determines ownership and routing  
- **Person** → Identifies requester and assignee  
- **Asset** → Links request to equipment  
- **Notification** → Updates users on progress  
- **Audit** → Tracks all actions  

---

## Flexibility for Business

The system allows:

- Different request types per department  
- Custom workflows per request type  
- Simple or complex approval processes  
- Integration across all business areas  

---

## Control & Traceability

The module ensures:

- Every request is recorded  
- Progress is visible at all times  
- Actions and decisions are logged  
- No request is lost or ignored  

✅ Supports operational control and audits  

---

## Summary

The Request module ensures that:

- All business needs are formally captured  
- Requests are processed through proper workflows  
- Work is executed in a controlled and consistent way  
- The organization maintains visibility and accountability  

---

## In Simple Terms

Think of it like:

- **Request** → Asking for something  
- **Workflow** → The process to handle it  
- **Task** → The work to complete it  

👉 A request **starts the process**, and workflow ensures **it is done properly from start to finish**.

# Task Management (Business Overview)

The **Task module** manages work that needs to be done by people in the organization.

It ensures that:
- Work is clearly assigned
- Responsibilities are tracked
- Nothing is missed
- Progress is visible

---

## Why This Matters

In daily operations:

- Tasks are often communicated informally (calls, messages)
- Work can be forgotten or delayed
- Responsibilities may be unclear
- No proper tracking or accountability

This module ensures the organization always knows:

✅ What needs to be done  
✅ Who is responsible  
✅ When it must be completed  
✅ What is the current status  

---

## Key Objectives

The Task module helps to:

- Assign work clearly to individuals or roles  
- Track progress from start to completion  
- Ensure accountability  
- Support operational workflows  
- Improve efficiency and coordination  

---

## Key Components

### 1. Task

Represents a piece of work to be completed.

Examples:
- Inspect a machine  
- Approve a document  
- Conduct training  
- Fix equipment  

✅ Each task includes:
- Description
- Assigned person or role
- Due date
- Priority
- Status

---

### 2. Task Template

Used to standardize repeatable tasks.

Examples:
- Daily inspection  
- Approval step  
- Basic checklist item  

✅ Focus: *Single, reusable task definition*

---

### 3. Work Package

A **Work Package** is a template that contains a **group (list) of related tasks**.

It is used when multiple tasks need to be performed together as part of a process.

Examples:
- Machine Maintenance Package  
- New Employee Onboarding  
- Document Review Cycle  
- Safety Inspection Routine  

✅ Each Work Package includes:
- A list of predefined tasks  
- Task sequence or structure (if required)  
- Responsible roles or teams  

✅ Benefits:
- Standardizes multi-step work  
- Ensures no steps are missed  
- Speeds up task creation  
- Improves consistency across operations  

---

### 4. Assignment

Tasks (or tasks within a Work Package) can be assigned to:

- A specific **person**  
- A **role** (e.g., Technician, Supervisor)  

✅ Ensures the right person performs the work  

---

### 5. Task Status

Tracks progress of each task:

- Pending  
- In Progress  
- Completed  
- Cancelled  

✅ Provides visibility to management and teams  

---

### 6. Due Dates & Priority

Each task can have:

- **Due date** → When it must be completed  
- **Priority** → How urgent it is  

✅ Helps teams focus on important work  

---

## How It Works (Simple Flow)

### Simple Task
1. Task is **created**
2. Assigned to a person or role  
3. Work is performed  
4. Task is marked **completed**

### Work Package
1. A **Work Package** is selected  
2. The system generates a **list of tasks**  
3. Tasks are assigned automatically or manually  
4. Work is executed step by step  
5. All tasks are tracked until completion  

---

## Example (Simple Scenario)

### Example 1: Single Task
- Task: Inspect CNC Machine  
- Assigned to: Technician  

---

### Example 2: Work Package

**Work Package: Monthly Machine Maintenance**

Tasks generated:
1. Inspect machine condition  
2. Lubricate components  
3. Replace worn parts  
4. Record maintenance results  

✅ Technician completes each task  
✅ Entire package ensures full maintenance is done  

---

## Automation & Integration

Tasks and Work Packages can be generated automatically from:

- **Workflow** → Approval processes  
- **Asset** → Maintenance schedules  
- **DMS** → Document reviews  
- **LMS** → Training assignments  

✅ Reduces manual work and ensures consistency  

---

## Accountability & Tracking

The system ensures:

- Every task has a clear owner  
- Work Packages follow a standard process  
- All actions are recorded  
- Delays can be identified  

✅ Improves discipline and operational control  

---

## Integration with Other Modules

- **Org** → Determines where tasks belong  
- **Person** → Identifies who performs the task  
- **Job** → Defines responsible roles  
- **Workflow** → Controls sequence and approvals  
- **Notification** → Alerts users  
- **Audit** → Tracks all actions  

---

## Flexibility for Business

The system allows:

- Single tasks or grouped tasks (Work Packages)  
- Reusable templates for efficiency  
- Role-based or person-based assignments  
- Cross-module task generation  

---

## Summary

The Task module ensures that:

- Work is clearly defined and assigned  
- Multi-step processes are standardized using Work Packages  
- Tasks are tracked and completed on time  
- Operations run smoothly and consistently  

---

## In Simple Terms

Think of it like:

- **Task** → A single job  
- **Task Template** → A reusable task  
- **Work Package** → A checklist of tasks  
- **Assignment** → Who does it  

And the system ensures that **all work—simple or complex—is completed properly without missing any steps**.

# Process Workflow (Business Overview)

The **Process Workflow module** defines how work flows across the organization.

It ensures that:
- Processes follow a clear sequence  
- Approvals happen in the correct order  
- Responsibilities are enforced  
- Work progresses in a controlled and traceable way  

---

## Why This Matters

In real operations:

- Processes can be inconsistent  
- Steps may be skipped  
- Approvals may be unclear  
- Work may get delayed or stuck  

This module ensures:

✅ Every process follows a defined path  
✅ Everyone knows what to do and when  
✅ Approvals are controlled and recorded  
✅ No steps are missed  

---

## Key Objectives

The Workflow module helps to:

- Standardize business processes  
- Control approvals and decisions  
- Track progress from start to finish  
- Improve transparency and accountability  

---

## Key Components

### 1. Workflow

A **Workflow** defines the overall process flow.

Examples:
- Document approval process  
- Service request handling  
- Asset maintenance approval  
- Employee onboarding  

✅ Defines:
- Steps involved  
- Order of execution  
- Rules for progression  

---

### 2. State (Stage)

A **State** represents a step in the process.

Examples:
- Draft  
- Under Review  
- Approved  
- Rejected  
- Completed  

✅ Shows current position in the workflow  

---

### 3. Transition

A **Transition** defines how work moves from one state to another.

Examples:
- Submit for approval  
- Approve  
- Reject  
- Escalate  

✅ Controls:
- When movement is allowed  
- Who can perform the action  

---

### 4. Approval

Certain transitions require approval from authorized roles.

✅ Ensures:
- Proper authority is followed  
- Decisions are documented  
- Compliance is maintained  

---

### 5. Assignment

Each step is assigned to:

- A **person**, or  
- A **role** (e.g., Supervisor, Manager)  

✅ Ensures the right person handles each stage  

---

### 6. Workflow Instance

When a process starts, a **workflow instance** is created.

✅ Tracks:
- Current state  
- Actions taken  
- History of the process  

---

## How It Works (Simple Flow)

1. A process is **initiated** (e.g., request created)  
2. Workflow starts at the first **state**  
3. A user performs an action (transition)  
4. The process moves to the next state  
5. Steps repeat until completion  

---

## Example (Simple Scenario)

### Document Approval

1. Draft  
2. Submit for Review  
3. Reviewer checks document  
4. Manager approves  
5. Document is released  

✅ Each step is controlled and recorded  

---

## Example (Service Request)

1. Request Submitted  
2. Assigned to Team  
3. Work In Progress  
4. Completed  
5. Closed  

✅ Ensures service is handled properly  

---

## Integration with Other Modules

- **Task** → Creates tasks for each workflow step  
- **Service Catalog** → Triggers workflows when services are requested  
- **Org** → Determines ownership and structure  
- **Person** → Identifies who performs actions  
- **Job** → Defines roles responsible for approvals  
- **Notification** → Alerts users of pending actions  
- **Audit** → Records all changes and decisions  

---

## Automation & Control

The system can:

- Automatically move to next steps  
- Trigger tasks or notifications  
- Escalate delayed processes  
- Enforce rules and conditions  

✅ Reduces manual coordination  

---

## Compliance & Traceability

The Workflow module ensures:

- All actions are recorded  
- Approval history is available  
- Processes are consistent and repeatable  

✅ Supports audits and governance  

---

## Flexibility for Business

The system allows:

- Simple or complex workflows  
- Different workflows per process  
- Role-based approvals  
- Conditional logic (e.g., based on value, department)  

---

## Summary

The Process Workflow module ensures that:

- Processes are clearly defined and followed  
- Work moves step by step in a controlled way  
- Approvals are properly managed  
- Operations are transparent and auditable  

---

## In Simple Terms

Think of it like:

- **Workflow** → The process roadmap  
- **State** → Where you are now  
- **Transition** → Moving to the next step  
- **Approval** → Permission to proceed  

And the system ensures that **work flows correctly from start to finish without confusion or missing steps**.
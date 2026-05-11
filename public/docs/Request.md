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
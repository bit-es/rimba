# Learning (Business Overview)

The **Learning Management System (LMS)** manages structured learning programs, training materials, assessments, and certifications within the organization.

It is designed to support:
- Controlled learning content
- Skills and certification tracking
- Compliance and audit readiness

✅ Learning content is **version‑controlled**  
✅ Learning lifecycle is governed by **workflow**  
✅ All learning actions are recorded in the **audit trail**

---

## Why This Matters

In a manufacturing and operations environment:

- Employees must follow approved procedures
- Certain training and certifications are mandatory
- Skills must align with job roles and responsibilities
- Training records are required for audits and compliance

Without proper control:
- Outdated materials may be used
- Certifications may be invalid or expired
- Training evidence may be incomplete
- Audit findings may occur

This module ensures the organization always knows:

✅ What training exists  
✅ Which materials are approved  
✅ Who has completed training  
✅ Who is certified and valid  

---

## Key Objectives

The Learning module helps to:

- Organize training into structured programs
- Control learning materials through versioning
- Enforce approval before training is delivered
- Track assessments and certification outcomes
- Provide traceable learning records for audit

---

## Key Components

### 1. Course

A **Course** represents a high‑level learning program.

Examples:
- IT Manufacturing Fundamentals
- Machine Safety Training
- Quality Management Basics

✅ Stored in `l_courses`  
✅ Defines:
- Code (unique identifier)
- Title and description
- Category (via `CourseGroup`)
- Publication status

✅ A Course represents **learning intent**, not material content

---

### 2. Module

A **Module** represents a structured learning unit within a course.

Examples:
- Safety Introduction
- ISA‑95 Level 3 Overview
- Networking Fundamentals

✅ Stored in `l_modules`  
✅ Modules:
- Are reusable across courses
- Have defined sequence and duration
- May define certificate validity rules

✅ A Course is composed of one or more Modules

---

### 3. Learning Materials (Versioned Content)

**Materials** represent the actual learning content.

Examples:
- PDF documents
- External links
- Videos
- Reference documents

✅ Stored in `l_materials`  
✅ Linked to modules via `l_material_module`

✅ Material content is:
- **Version‑controlled**
- Approved through workflow
- Immutable once published

✅ Only **published versions** of materials should be used in training

---

### 4. Versioning (Content Control)

Learning materials, quizzes, and structured definitions are managed using the **Version module**.

✅ Versioning ensures:
- Changes are intentional
- Old content is never overwritten
- Revision history is preserved

✅ Version lifecycle: Draft → Approved → Published → Archived

✅ Training delivery must reference **published versions only**

---

### 5. Workflow (Approval & Control)

Learning content follows an approval **Workflow** owned by an **OrgTeam**.

✅ Workflow controls:
- When learning content is reviewed
- Who can approve changes
- When content becomes available for use

✅ Typical workflow:
1. Draft material created
2. Review by responsible team
3. Approval granted
4. Version published
5. Training delivered

✅ No learning material bypasses workflow

---

### 6. Quizzes & Assessments

Modules may include **Quizzes** and **Evaluations** to assess understanding.

✅ Stored in:
- `l_quizzes`
- `l_quiz_attempts`
- `l_evaluations`
- `l_feedbacks`

✅ Supports:
- Structured assessments
- Scoring and pass/fail logic
- Examiner‑style or self‑assessment

✅ Assessment attempts are fully traceable

---

### 7. Certificates

A **Certificate** represents proof that a learner successfully completed a module.

✅ Stored in `l_certificates`  
✅ Linked to:
- Module
- Quiz attempt
- Learner (staff)
- Issuer (staff)

✅ Certificates:
- May have expiry dates
- Can be revoked or expired
- Are generated only from approved assessments

✅ Certificate validity supports compliance requirements

---

## How It Works Together

1. Courses and modules are defined
2. Learning materials are created as **Draft versions**
3. Workflow routes content for approval
4. Approved versions are **Published**
5. Learners access published materials
6. Quizzes and evaluations are completed
7. Certificates are issued (if applicable)
8. All actions are recorded in the **Audit Trail**

✅ No training is delivered on unapproved content  
✅ No certificate exists without traceable evidence  

---

## Example (Simple Scenario)

- Course: Machine Safety
- Module: Safety Fundamentals
- Learner: Ahmad

Process:
1. Safety materials are published
2. Ahmad completes the module
3. Ahmad attempts the quiz
4. Quiz is passed
5. Certificate is issued with expiry date
6. Audit trail records:
   - Content publication
   - Quiz attempt
   - Certificate issuance

✅ Ahmad is now certified and auditable

---

## Compliance & Audit

The LMS supports compliance by ensuring:

- Learning content is approved before use
- Assessment results are recorded
- Certificates are traceable and time‑bound
- Historical records are preserved

✅ Suitable for:
- Safety audits
- ISO‑related audits
- Internal compliance reviews

---

## Integration with Other Modules

- **Version** → Controls learning content changes  
- **Workflow** → Governs approval and publication  
- **Audit** → Records all learning actions  
- **Org / OrgTeam** → Owns learning programs  
- **Person / Staff** → Learners and issuers  
- **Job** → Defines required training  
- **Access / Authorization** → Restricts actions based on certification  

---

## Flexibility for Business

The system allows the organization to:

- Reuse modules across courses
- Update materials without breaking history
- Define certificate validity periods
- Support internal and external learning content
- Scale training programs over time

---

## Summary

The Learning module ensures that:

- Learning programs are structured and controlled
- Training content is approved and versioned
- Assessments and certificates are traceable
- Compliance requirements are met
- Audit readiness is maintained

---

## In Simple Terms

Think of it like:

- **Course** → The learning program  
- **Module** → A unit of learning  
- **Material** → The learning content  
- **Version** → Approved content state  
- **Workflow** → Approval process  
- **Quiz / Evaluation** → Assessment  
- **Certificate** → Proof of completion  
- **Audit Trail** → The evidence  

And the system ensures **people are trained using approved materials, assessed correctly, and certified with full traceability**.
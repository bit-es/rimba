# Learning Management System (LMS)

## Business Requirements Specification (BRS)

Version: 1.0  
Status: Draft<p align="right"><a href="all.md">Back to Main</a> | <a href="tech.md">Back to Tech Overview</a></p>

---

# 1. Overview

The Learning Management System (LMS) is a platform to manage structured learning, assessments, and certifications for individuals within an organization.

It enables:

* Course delivery
* Training tracking
* Automated assessments
* Certification issuance
* Competency management

---

# 2. Objectives

The LMS aims to:

* Standardize training delivery
* Automate evaluation of knowledge
* Issue certificates automatically upon passing
* Track staff competencies over time
* Support compliance and audit requirements
* Enable scalable digital learning

---

# 3. Scope

The LMS covers the full learning lifecycle:

```text
Organization → Users → Courses → Modules → Lessons → Quizzes → Attempts → Certificates → Qualifications
```

---

# 4. Actors

| Actor   | Description                          |
| ------- | ------------------------------------ |
| Learner | Takes courses and quizzes            |
| Trainer | Creates learning content             |
| Admin   | Manages system configuration         |
| Manager | Tracks staff progress                |
| System  | Automates evaluation & certification |

---

# 5. Core Modules

## 5.1 Course Management

* Create courses
* Organize modules and lessons
* Publish or archive courses

## 5.2 Enrollment

* Self enrollment or assigned enrollment
* Track progress and completion

## 5.3 Learning Content

Supports:

* Videos
* Documents
* PDFs
* External links
* SCORM (optional)

## 5.4 Quiz & Assessment

* Multiple question types
* Configurable pass mark
* Automatic grading

## 5.5 Certification

* Auto-issued upon passing
* Unique certificate number
* Validity period support
* Downloadable PDF certificate

## 5.6 Qualification Tracking

* Store earned competencies
* Track expiry dates
* Renewal support

---

# 6. Key Business Rules

* Only published courses can be enrolled
* Quiz must have a defined pass mark
* Certificate issued only when quiz is passed
* One certificate per qualifying attempt
* Expired certificates are invalid for compliance

---

# 7. Process Flow

## 7.1 Learning Flow

```text
Enroll → Learn → Attempt Quiz → Evaluate → Pass/Fail → Certificate (if passed)
```

## 7.2 Certification Flow

```text
Quiz Submitted → Score Calculated → Pass Check → Certificate Issued → Qualification Recorded
```

---

# 8. Data Entities

* users
* organizations
* courses
* modules
* lessons
* quizzes
* quiz_questions
* quiz_attempts
* certificates
* qualifications
* enrollments

---

# 9. Quiz Attempt Rules

Each attempt stores:

* score
* percentage
* pass/fail status
* timestamp

---

# 10. Certificate Rules

Each certificate contains:

* certificate number
* user reference
* course/quiz reference
* issue date
* expiry date
* status (active, expired, revoked)

---

# 11. Event-Driven Design

The LMS is event-driven for extensibility.

## Key Events

* CoursePublished
* UserEnrolled
* QuizSubmitted
* QuizPassed
* QuizFailed
* CertificateIssued
* QualificationUpdated

## Example Flow

```text
QuizPassed → CreateCertificate → NotifyUser → UpdateQualification
```

---

# 12. Non-Functional Requirements

* Scalable for large organizations
* Secure learning records
* High availability
* Audit logging enabled
* Fast quiz evaluation

---

# 13. System Architecture

Recommended Laravel stack:

* Laravel 12/13
* Filament Admin Panel
* Spatie Permissions
* Queue system (Horizon)
* Event-driven architecture

---

# 14. Domain Structure (Recommended)

```text
Domain/
├── Learning/
│   ├── Courses
│   ├── Modules
│   ├── Quizzes
│   ├── Attempts
│   ├── Events
│   ├── Listeners
│
├── Certification/
│   ├── Certificates
│
├── Qualification/
│   ├── Records
```

---

# 15. Automation Capabilities

* Auto certificate generation
* Email/WhatsApp notifications
* Qualification expiry reminders
* Workflow integration support

---

# 16. Future Enhancements

* AI tutor assistant
* Adaptive learning paths
* Gamification (badges, points)
* Mobile LMS app
* SCORM/xAPI integration
* Live classes integration

---

# 17. Success Criteria

The system is successful when:

* Learning process is fully trackable
* Certifications are auto-issued reliably
* HR can view competency status instantly
* Manual admin work is minimized

---

# 18. Summary

This LMS provides a modular, event-driven foundation for scalable training and certification management across organizations.

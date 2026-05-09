# Shared Infrastructure Blueprint

> **Purpose**  
This document defines **shared, cross-cutting infrastructure concepts** that are reusable
across all domains:
- Physical **Location**
- Dynamic **Attribute**
Both are implemented as **traits**, not hard dependencies.

---

## 1. Attribute Infrastructure

> Attributes represent **extensible metadata** that is not hard-coded into models  
> Used for classification, ABAC, integration, and future-proofing.

---

### 1.1 Attribute Model

**Attribute**
- id
- key
- value
- datatype  
  (`string | number | boolean | date | json`)
- scope  
  (`org | location | person | job | access | workflow`)

---

### 1.2 Attribute Pivot (Polymorphic)

**attributables**
- attribute_id
- attributable_type
- attributable_id
- context (optional: primary, derived, synced)
- source (manual, hrdb, ldap, system)

---

### 1.3 HasAttributes Trait

> Enables any model to be **attribute-aware**

**Trait: `HasAttributes`**
- `morphToMany(Attribute::class, 'attributable')`

**Responsibilities**
- Store non-core data
- Drive ABAC roles
- Support external system sync
- Avoid schema bloat

**Rules**
- Attributes never replace core columns
- Attributes may be sourced externally
- Attributes may generate roles and permissions

---

## 2. Location Infrastructure

> Location represents **physical or logical places**
> Independent from organization, people, or jobs.

---

### 2.1 Location Model

**Location**
- id
- code
- name
- type  
  (`country | region | city | site | building | floor | zone`)
- parent_id (hierarchy)
- latitude
- longitude
- timezone

**Relations**
- belongsTo → Location (parent)
- hasMany → Location (children)
- morphToMany → Attribute

---

### 2.2 HasLocations Trait

> Makes a model **location-aware**

**Trait: `HasLocations`**
- `morphToMany(Location::class, 'locatable')`
- optional: `primary_location_id`

**Usage Semantics**
- A model may exist in **multiple locations**
- A location may host **many models**
- Location does NOT imply ownership or hierarchy

**Examples**
- Organization → countries / HQ
- OrgUnit → floors / buildings
- JobPosition → plant or site
- Staff → work presence (onsite / remote)

---

## 3. ABAC & Location Integration

Attributes and Locations together enable **contextual access control**.

---

## 4. Design Rules

✅ Traits are **opt-in**, not implicit  
✅ No model is required to have both traits  
✅ Foundation model must explicitly declare usage  
✅ Location and Attribute evolve independently  

---

## 5. Mental Model

> Attributes describe qualities  
> Locations describe place  
> Traits describe capability  
> Models choose what they need  

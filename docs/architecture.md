# 🏗️ VaultScribe Security Architecture

## Overview

VaultScribe is a production-oriented secure notes platform designed using Defense-in-Depth principles. Multiple independent security layers protect user accounts, application components, sensitive data, infrastructure, and cloud resources.

The architecture combines Application Security, Cloud Security, Infrastructure Hardening, Monitoring, Detection Engineering, and DevSecOps security controls.

---

# Architecture Goals

* Secure Authentication & Identity Management
* Strong Authorization & Access Control
* Data Protection & Encryption
* Secure File Upload Processing
* SSRF Protection
* Security Monitoring & Audit Logging
* Infrastructure Hardening
* Cloud Security
* Automated Security Validation

---

# High-Level Architecture

```text
Users
 │
 ▼
Cloudflare DNS
 │
 ▼
Cloudflare WAF
 │
 ▼
Nginx Reverse Proxy + Modsecurity WAF
 │
 ▼
Azure Virtual Machine
 │
 ▼
Docker Network
 │
 ├── Laravel Application Container
 │
 └── MySQL Database Container
```

---

# Application Architecture

```text
Laravel Application
 │
 ├── Authentication Layer
 │     ├── Registration
 │     ├── Login
 │     ├── Email OTP Verification
 │     ├── Password Reset
 │     └── TOTP MFA
 │
 ├── Authorization Layer
 │     ├── RBAC
 │     ├── Admin Controls
 │     └── Ownership Validation
 │
 ├── Notes Module
 │     ├── Create Notes
 │     ├── Update Notes
 │     ├── Delete Notes
 │     ├── Restore Notes
 │     └── Import URL
 │
 ├── AI Features
 │     ├── AI Summary Generation
 │     └── Gemini 2.5 Flash Integration
 │
 ├── Upload Module
 │     ├── MIME Validation
 │     ├── Image Validation
 │     ├── ClamAV Scanning
 │     └── WebP Re-Encoding
 │
 ├── Security Layer
 │     ├── CSP
 │     ├── CSRF Protection
 │     ├── SSRF Protection
 │     ├── Rate Limiting
 │     └── Security Headers
 │
 ├── Activity Logging
 │
 └── Admin Panel
```

---

# Authentication Architecture

```text
User
 │
 ▼
Login Request
 │
 ▼
Credential Validation
 │
 ▼
Argon2id Password Verification
 │
 ▼
Email OTP Verification
 │
 ▼
TOTP MFA Challenge
 │
 ▼
Session Regeneration
 │
 ▼
Authenticated Session
```

### Security Controls

* Argon2id Password Hashing
* Password Peppering
* Email OTP Verification
* TOTP MFA
* Session Regeneration
* Secure Cookies

---

# Authorization Architecture

VaultScribe uses Role-Based Access Control (RBAC) and ownership validation.

### Roles

#### User

Can:

* Manage Own Notes
* Manage Own Profile
* Upload Files

Cannot:

* Access Administrative Functions
* Access Other Users' Data

#### Administrator

Can:

* Manage Users
* View Security Logs
* Review Activity Logs
* Access Administrative Controls

### Authorization Controls

* RBAC
* Admin Middleware
* Ownership Validation
* Least Privilege Access

---

# Notes Security Architecture

```text
User
 │
 ▼
Authenticated Request
 │
 ▼
Ownership Validation
 │
 ▼
Note Encryption
 │
 ▼
MySQL Storage
```

### Data Protection

* AES Encrypted Notes
* Soft Delete Support
* Secure Data Handling

---

# File Upload Security Architecture

```text
User Upload
 │
 ▼
Authentication Check
 │
 ▼
MIME Validation
 │
 ▼
Extension Validation
 │
 ▼
Image Validation
 │
 ▼
ClamAV Scan
 │
 ▼
WebP Re-Encoding
 │
 ▼
Private Storage
```

### Security Controls

* MIME Validation
* Extension Validation
* File Size Validation
* Image Verification
* ClamAV Scanning
* UUID File Naming
* Private Storage

---

# SSRF Protection Architecture

```text
User URL
 │
 ▼
URL Validation
 │
 ▼
Protocol Validation
 │
 ▼
DNS Validation
 │
 ▼
Private IP Detection
 │
 ▼
Metadata Endpoint Blocking
 │
 ▼
Safe Request Processing
```

### Protection Mechanisms

* URL Validation
* Protocol Validation
* Internal IP Blocking
* Private Network Blocking
* Metadata Endpoint Blocking
* DNS Validation

---

# Monitoring Architecture

```text
Laravel Logs
Nginx Logs
Authentication Events
Activity Logs
Security Events
Falco Runtime Events
UFW Logs
Fail2Ban Events
      │
      ▼
   Promtail
      │
      ▼
     Loki
      │
      ▼
   Grafana
      │
      ▼
Grafana Security Dashboards
Security Alerts
```

---

# Infrastructure Architecture

## Cloud Layer

* Azure Virtual Machine
* Cloudflare DNS
* Cloudflare WAF

## Network Layer

* Azure NSG
* UFW Firewall
* HTTPS/TLS Encryption

## Host Security

* Fail2Ban
* ClamAV
* Lynis
* RKHunter
* Chkrootkit
* ModSecurity + OWASP CRS

---

# DevSecOps Architecture

```text
Developer Push
      │
      ▼
GitHub Actions
      │
      ▼
Laravel Tests
      │
      ▼
Laravel Pint
      │
      ▼
Gitleaks
      │
      ▼
Semgrep
      │
      ▼
Snyk
      │
      ▼
Trivy
      │
      ▼
SBOM Generation
      │
      ▼
OWASP ZAP
      │
      ▼
Azure VM Deployment
      │
      ▼
Docker Containers
```

---

# Security Layers Summary

1. Authentication Security
2. Session Security
3. Authorization Security
4. Data Security
5. File Upload Security
6. SSRF Protection
7. Infrastructure Security
8. Monitoring & Detection
9. DevSecOps Security Gates

---

# Security Design Principles

* Defense-in-Depth
* Least Privilege
* Secure by Default
* Zero Trust Mindset
* Continuous Security Validation
* Threat Modeling (STRIDE)

---

# Outcome

VaultScribe integrates secure application development, layered security controls, monitoring, cloud security, and DevSecOps automation into a unified architecture designed to reduce risk and improve security posture throughout the software lifecycle.

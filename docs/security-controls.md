# 🔒 Security Controls Matrix

## Overview

VaultScribe implements multiple layers of security controls across authentication, authorization, application security, data protection, infrastructure security, monitoring, and DevSecOps.

The controls follow a Defense-in-Depth model where security is enforced through multiple independent layers.

---

# Security Controls Matrix

| Security Domain         | Control                   | Purpose                            |
| ----------------------- | ------------------------- | ---------------------------------- |
| Authentication          | Argon2id Password Hashing | Secure password storage            |
| Authentication          | Password Peppering        | Additional password protection     |
| Authentication          | Email OTP Verification    | Identity verification              |
| Authentication          | Google Authenticator MFA  | Multi-factor authentication        |
| Authentication          | Session Regeneration      | Session hijacking mitigation       |
| Authentication          | Secure Cookies            | Session protection                 |
| Authorization           | RBAC                      | Role-based access control          |
| Authorization           | Ownership Validation      | Prevent unauthorized data access   |
| Authorization           | Admin Middleware          | Administrative route protection    |
| Data Security           | AES Encrypted Notes       | Confidentiality protection         |
| Data Security           | Encrypted 2FA Secrets     | MFA secret protection              |
| Data Security           | Hidden Sensitive Fields   | Sensitive data exposure prevention |
| File Security           | MIME Validation           | Malicious upload prevention        |
| File Security           | Extension Validation      | File type enforcement              |
| File Security           | File Size Validation      | Upload abuse prevention            |
| File Security           | Image Validation          | Malformed file detection           |
| File Security           | Image Re-Encoding         | Payload removal                    |
| File Security           | Private Storage           | Direct access prevention           |
| File Security           | ClamAV Scanning           | Malware detection                  |
| Application Security    | CSP                       | XSS mitigation                     |
| Application Security    | CSRF Protection           | Request forgery prevention         |
| Application Security    | SSRF Protection           | Server-side request protection     |
| Application Security    | Input Validation          | Malicious input prevention         |
| Application Security    | Security Headers          | Browser security hardening         |
| Application Security    | Rate Limiting             | Abuse prevention                   |
| Application Security    | CAPTCHA Protection        | Automated attack mitigation        |
| Infrastructure Security | Cloudflare WAF            | Edge protection                    |
| Infrastructure Security | Azure NSG                 | Network access control             |
| Infrastructure Security | UFW Firewall              | Host-level filtering               |
| Infrastructure Security | Fail2Ban                  | Brute-force mitigation             |
| Infrastructure Security | HTTPS/TLS                 | Secure communications              |
| Monitoring              | Activity Logs             | User action visibility             |
| Monitoring              | Audit Trail               | Event traceability                 |
| Monitoring              | Grafana Security Dashboard| Security visibility                |
| Monitoring              | Grafana                   | Monitoring & alerting              |
| Monitoring              | Loki                      | Centralized log storage            |
| Monitoring              | Promtail                  | Log collection                     |
| Monitoring              | Falco                     | Runtime threat detection           |
| Monitoring              | Security Event Logging    | Incident investigation             |
| DevSecOps               | Laravel Tests             | Functional validation              |
| DevSecOps               | Laravel Pint              | Code quality validation            |
| DevSecOps               | Gitleaks                  | Secret detection                   |
| DevSecOps               | Semgrep                   | SAST                               |
| DevSecOps               | Snyk                      | Dependency analysis                |
| DevSecOps               | Trivy                     | Vulnerability scanning             |
| DevSecOps               | SBOM Generation           | Supply-chain visibility            |
| DevSecOps               | OWASP ZAP                 | DAST                               |
| DevSecOps               | Automated Deployment      | Deployment consistency             |

---

# Defense-in-Depth Model

## Layer 1 — Edge Protection

Controls:

* Cloudflare DNS
* Cloudflare WAF
* Cloudflare DDoS Protection
* ModSecurity + OWASP CRS
Purpose:

Protect the application before traffic reaches the infrastructure.

---

## Layer 2 — Infrastructure Security

Controls:

* Azure NSG
* UFW Firewall
* Fail2Ban
* HTTPS/TLS

Purpose:

Protect servers and network boundaries.

---

## Layer 3 — Application Security

Controls:

* CSP
* CSRF Protection
* SSRF Protection
* Input Validation
* Security Headers
* Rate Limiting
* CAPTCHA

Purpose:

Protect application logic and user interactions.

---

## Layer 4 — Authentication & Authorization

Controls:

* Argon2id
* Email OTP
* TOTP MFA
* Session Regeneration
* RBAC
* Ownership Validation

Purpose:

Ensure only authorized users can access protected resources.

---

## Layer 5 — Data Protection

Controls:

* AES Encrypted Notes
* Encrypted MFA Secrets
* Private Storage
* File-Based Session Storage

Purpose:

Protect sensitive information at rest.

---

## Layer 6 — Monitoring & Detection

Controls:

* Activity Logs
* Audit Trail
* Grafana
* Loki
* Promtail
* Falco

Purpose:

Provide visibility, alerting, and incident investigation capabilities.

---

## Layer 7 — DevSecOps Security Gates

Controls:

* Laravel Tests
* Gitleaks
* Semgrep
* Snyk
* Trivy
* OWASP ZAP
* SBOM Generation

Purpose:

Continuously validate security throughout the software development lifecycle.

---

# Security Objectives

The implemented controls help address:

* Authentication Risks
* Broken Access Control
* Session Hijacking
* Cross-Site Scripting (XSS)
* Cross-Site Request Forgery (CSRF)
* Server-Side Request Forgery (SSRF)
* Malicious File Uploads
* Information Disclosure
* Credential Attacks
* Dependency Vulnerabilities
* Supply Chain Risks

---

# Outcome

VaultScribe applies layered security controls across users, applications, infrastructure, and development workflows to reduce risk and improve overall security posture.

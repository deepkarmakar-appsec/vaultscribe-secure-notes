# ☁️ Deployment Guide

## Overview

VaultScribe is deployed on Microsoft Azure using Docker containers, Nginx reverse proxy, Cloudflare protection, TLS encryption, monitoring, and layered security controls.

The deployment architecture follows Defense-in-Depth principles by implementing security controls at the cloud, network, application, container, and monitoring layers.

---

# Infrastructure

## Cloud Platform

* Microsoft Azure Virtual Machine
* Ubuntu 24.04 LTS

## Web Layer

* Cloudflare DNS
* Cloudflare WAF
* DDoS Protection
* SSL/TLS Encryption

## Application Layer

* Laravel 12
* PHP 8.3
* Docker Containers

## Database Layer

* MySQL 8

---

# Deployment Architecture

```text
Internet
   │
   ▼
Cloudflare DNS
   │
   ▼
Cloudflare WAF
   │
   ▼
Azure Virtual Machine
   │
   ▼
Nginx Reverse Proxy + ModSecurity WAF
   │
   ▼
Docker Network
   ├── Laravel Application Container
   └── MySQL Database Container
```

---

# Network Security

## Azure Network Security Groups (NSG)

Allowed:

* HTTPS (443)
* HTTP (80)
* SSH (2222)

Blocked:

* All unnecessary inbound traffic

---

## UFW Firewall

Allowed:

* 80
* 443
* 2222

Default Policy:

* Deny Incoming
* Allow Outgoing

---

# Container Deployment

## Container Orchestration

* Docker Compose
* Laravel Application Container
* MySQL Database Container
* Internal Docker Network

## Application Container

Responsibilities:

* Laravel Runtime
* Authentication
* Authorization
* Business Logic
* Security Middleware
* File Upload Processing

## Database Container

Responsibilities:

* MySQL Storage
* User Records
* Encrypted Notes
* Session Storage

---

# Reverse Proxy Layer

Nginx provides:

* TLS Termination
* Reverse Proxy Routing
* HTTPS Enforcement
* Security Headers
* Request Filtering
* Backend Isolation

---

# Monitoring Stack

## Grafana

Used for:

* Security Dashboards
* Alerting
* Operational Monitoring

## Loki

Used for:

* Centralized Log Aggregation
* Security Event Analysis

## Promtail

Used for:

* Log Collection
* Log Forwarding

## Falco

Used for:

* Runtime Threat Detection
* Container Monitoring
* Suspicious Activity Detection

---

# Logging Architecture

```text
Laravel Logs
Nginx Logs
Authentication Events
Security Events
Falco Events
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
```

---

# Deployment Process

1. Developer pushes code to GitHub
2. GitHub Actions executes CI/CD pipeline
3. Automated tests are executed
4. Security validation is completed
5. Deployment is approved
6. Application is deployed to Azure VM
7. Containers are updated
8. Health validation is performed
9. Monitoring stack verifies deployment status

---

# Availability & Reliability

* Continuous Monitoring
* Centralized Logging
* Containerized Deployment
* Automated Security Validation
* Health Verification
* Security Event Visibility

---

# Security Principles

* Defense in Depth
* Least Privilege
* Secure by Design
* Continuous Monitoring
* Security Automation
* Security Validation Before Deployment

---

# Outcome

VaultScribe is deployed using a layered cloud architecture that combines Azure infrastructure, Docker containerization, Cloudflare protection, Nginx reverse proxying, centralized monitoring, and automated security validation to improve resilience, visibility, and security across the deployment lifecycle.

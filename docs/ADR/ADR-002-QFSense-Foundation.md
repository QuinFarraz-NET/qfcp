# ADR-002 — QFSense Foundation

## Status

Accepted

---

## Context

Mission Control requires a reusable telemetry engine that can be shared across multiple modules and future products.

---

## Decision

Introduce QFSense as the core telemetry subsystem.

Architecture:

Mission Control
↓
DashboardService
↓
TelemetryService
↓
TelemetrySnapshot
↓
Probes
↓
Linux

---

## Consequences

Advantages:

- Reusable telemetry engine
- Easy integration with QFcc
- Easy integration with QORA
- Clean separation of responsibilities
- Scalable architecture

Disadvantages:

- Initial implementation requires more classes.
- Slightly higher development effort.

---

Accepted:

2026-07-07

# ADR-001 Dashboard Aggregator

## Status

Accepted

## Decision

Dashboard tidak boleh memanggil SystemService secara langsung.

Semua komponen dashboard mengambil data dari DashboardService.

## Reason

- Mengurangi duplicate call Linux.
- Memudahkan cache.
- Menjadi source data untuk AI.
- Menjadi source data untuk REST API.
- Mempermudah testing.

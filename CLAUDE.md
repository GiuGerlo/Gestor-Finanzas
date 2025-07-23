# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Progressive Web Application (PWA) for financial management called "Gestor de Finanzas" (Finance Manager) designed for mobile-first usage on Argentine users managing personal finances in ARS currency.

**Current Status**: Initial phase - only database schema and requirements exist. No application code has been implemented yet.

## Technology Stack

- **Backend**: PHP + MySQL (REST API architecture)
- **Frontend**: Vanilla JavaScript + HTML + CSS
- **Database**: MySQL with optimized indexes
- **UI Framework**: Bootstrap (planned)
- **Charts**: Chart.js (planned)
- **PWA**: Service Worker + Web App Manifest for offline functionality

## Database Architecture

The MySQL schema is defined in `database.sql` with these core tables:

- `usuarios`: User authentication and profiles
- `categorias`: Customizable income/expense categories per user
- `movimientos`: Financial transactions with date, amount, and category
- `ahorros`: Savings goals and tracking
- Views: `resumen_mensual`, `resumen_anual` for reporting

Key relationships:
- Users have many categories and movements
- Categories are user-specific and typed (ingreso/egreso)
- Movements reference categories with ON DELETE RESTRICT to preserve data integrity

## Development Environment

This project runs on XAMPP (Apache + MySQL + PHP) in the htdocs directory, typical for local PHP development.

## Core Features to Implement

1. **Authentication**: Email/password login with persistent sessions using localStorage
2. **Financial Tracking**: Add/view income and expenses by custom categories
3. **Reporting**: Monthly/annual summaries with category breakdowns
4. **Savings Goals**: Set and track progress toward financial objectives
5. **Offline Mode**: Full PWA functionality with data synchronization
6. **Charts**: Visual statistics using Chart.js
7. **Mobile PWA**: Installable on iPhone via Safari

## API Endpoints (To Be Implemented)

- `POST /api/login` - User authentication
- `GET /api/movements` - Fetch movements with date filtering
- `POST /api/movements` - Add new income/expense
- `GET /api/categories` - User's custom categories
- `POST /api/categories` - Create new category
- `GET /api/stats` - Summary statistics and charts data
- `POST /api/savings` - Manage savings goals

## PWA Requirements

- Must work offline with Service Worker
- Requires HTTPS for installation
- manifest.json for app-like experience
- Mobile-first responsive design
- Installable from Safari on iPhone

## Currency and Localization

- Default currency: Argentine Peso (ARS)
- Date format and number formatting should follow Argentine conventions
- All text in Spanish as per requirements document
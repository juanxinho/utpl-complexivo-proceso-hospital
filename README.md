UTPL Complexivo - Proceso Hospital
==================================

This repository contains the source code for the "UTPL Complexivo - Proceso Hospital" project. This project is designed to manage various aspects of hospital operations, including patient management, appointment scheduling, diagnostics, prescriptions, and more. It leverages a variety of technologies and frameworks to create a robust and efficient system for healthcare providers.

Table of Contents
-----------------

-   [Technologies](#technologies)
-   [Project Setup](#project-setup)
-   [Features](#features)
-   [Livewire Components](#livewire-components)
-   [Controllers](#controllers)
-   [Models](#models)
-   [Services](#services)
-   [View Components](#view-components)
-   [License](#license)

Technologies
------------

This project uses the following technologies:

-   **Laravel**: A PHP framework for web artisans.
-   **Livewire**: A full-stack framework for Laravel that makes building dynamic interfaces simple.
-   **Tailwind CSS**: A utility-first CSS framework for rapidly building custom user interfaces.
-   **MariaDB**: A popular open-source relational database management system.
-   **WSL with Ubuntu**: A compatibility layer for running Linux binary executables natively on Windows 10.
-   **PHP 8.2**: The latest version of PHP for server-side scripting.

Project Setup
-------------

To set up the project locally, follow these steps:

1.  **Clone the repository**:

```bash
    git clone https://github.com/juanxinho/utpl-complexivo-proceso-hospital.git
    cd utpl-complexivo-proceso-hospital
```

2.  **Install dependencies**:

```bash
    composer install
    npm install
```

3.  **Setup environment variables**: Copy `.env.example` to `.env` and update the environment variables as needed.

4.  **Generate application key**:

```bash
  php artisan key:generate
```

5.  **Run database migrations**:

```bash
    php artisan migrate
```

6.  **Execute seeders**:

```bash
    php artisan db:seed
```

7.  **Serve the application**:

```bash
    php artisan serve
```

Features
--------

-   **Patient Management**: Manage patient information, including personal details and medical history.
-   **Appointment Scheduling**: Schedule and manage appointments between patients and doctors.
-   **Diagnostics**: Record and manage diagnostic information for patients.
-   **Prescriptions**: Manage prescriptions, including creating and viewing prescription details.
-   **User Roles and Permissions**: Manage different user roles and permissions using Spatie's Laravel Permission package.

Livewire Components
-------------------

The project includes several Livewire components for dynamic front-end functionality:

-   **AttendPatient**: Handles patient diagnostics, recommendations, and prescriptions.
-   **MedicManagement**: Manages doctors' profiles, including specialties and schedules.
-   **PatientManagement**: Manages patient profiles and information.
-   **ScheduleAppointment**: Schedules appointments between patients and doctors.
-   **ScheduleAppointmentCreate**: Creates new appointments.
-   **ScheduleAppointmentEdit**: Edits existing appointments.

Controllers
-----------

-   **AppointmentController**: Manages appointment views and actions for administrators.
-   **AppointmentMedicController**: Manages appointment views and actions for doctors.
-   **AppointmentPatientController**: Manages appointment views and actions for patients.
-   **DashboardController**: Displays dashboard views based on user roles.
-   **DiagnosticsController**: Manages diagnostic records.
-   **InvoiceController**: Manages invoices and invoice items.
-   **PrescriptionController**: Manages patient prescriptions.
-   **ResultController**: Displays patient test results.
-   **RoleController**: Manages user roles and permissions.
-   **ScheduleController**: Manages schedules for different days and times.
-   **SpecialtyController**: Manages medical specialties.
-   **StockController**: Manages stock items in the hospital.
-   **TreatmentController**: Displays patient treatment plans.
-   **UserController**: Manages user accounts and profiles.

Models
------

-   **Appointment**: Represents appointments between patients and doctors.
-   **City**: Represents cities in the system.
-   **ClinicalHistory**: Represents the clinical history of patients.
-   **Country**: Represents countries in the system.
-   **Day**: Represents days of the week for scheduling.
-   **Diagnostics**: Represents diagnostic information for patients.
-   **Invoice**: Represents invoices for patient services.
-   **InvoiceItem**: Represents items within an invoice.
-   **MedicalDiagnostic**: Represents medical diagnostics for appointments.
-   **MedicalTest**: Represents medical tests for diagnostics.
-   **MedicRoom**: Represents the association between doctors and rooms.
-   **MedicSchedule**: Represents doctors' schedules.
-   **Prescription**: Represents prescriptions for patients.
-   **PrescriptionItem**: Represents items within a prescription.
-   **Profile**: Represents user profiles.
-   **Room**: Represents rooms in the hospital.
-   **Schedule**: Represents schedules for different days and times.
-   **Specialty**: Represents medical specialties.
-   **State**: Represents states within a country.
-   **Stock**: Represents stock items in the hospital.
-   **User**: Represents user accounts and profiles.

Services
--------

-   **UserService**: Handles operations related to user accounts and profiles.

View Components
---------------

-   **BorderedBadge**: Displays a badge with a border.
-   **DatePicker**: Displays a date picker input.
-   **Select**: Displays a select dropdown.

License
-------

This project is licensed under the MIT License - see the LICENSE file for details.

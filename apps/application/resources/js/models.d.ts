/**
 * This file is auto generated using 'php artisan typescript:generate'
 *
 * Changes to this file will be lost when the command is run again
 */

declare namespace App.Models {
    export interface Note {
        id: number;
        text: string;
        noteable_type: string;
        noteable_id: number;
        userable_type: string | null;
        userable_id: number | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        noteable?: any | null;
        userable?: any | null;
    }

    export interface Rating {
        id: number;
        stars: number;
        ratingable_type: string;
        ratingable_id: number;
        userable_type: string | null;
        userable_id: number | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        ratingable?: any | null;
    }

    export interface UserType {
        id: number;
        type: string;
        created_at: string | null;
        updated_at: string | null;
    }

    export interface UserLoginHistory {
        id: number;
        user_id: number;
        was_successful: boolean | null;
        meta: string | null;
        created_at: string | null;
        updated_at: string | null;
        user?: App.Models.User | null;
    }

    export interface Address {
        id: number;
        street1: string;
        street2: string | null;
        street3: string | null;
        city: string | null;
        state_id: number;
        tenant_id: string;
        zipcode: string;
        addressable_id: number;
        addressable_type: string;
        confirmed_on_service: string | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        addressable?: any | null;
        state?: App.Models.State | null;
        readonly state_name?: string;
    }

    export interface Appointment {
        id: number;
        tenant_id: string;
        student_id: number;
        instructor_id: number;
        creator_id: number;
        date: string;
        time_start: number;
        time_end: number;
        appointment_type_id: number;
        test_location_id: number;
        test_passed: string | null;
        cancelled_date: string | null;
        cancelled_comment: string;
        car_id: number;
        pickup_location_id: number;
        dl304a: string | null;
        dl304c: string | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        student?: App.Models.Student | null;
        instructor?: App.Models.Instructor | null;
        creator?: App.Models.User | null;
        appointment_type?: App.Models.AppointmentType | null;
        test_location?: App.Models.TestLocation | null;
        car?: App.Models.Car | null;
        pickup_location?: App.Models.TestLocation | null;
        readonly name?: any;
        readonly rating?: string;
    }

    export interface AuditReason {
        id: number;
        name: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
    }

    export interface Country {
        id: number;
        name: string;
        abbr: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        states?: Array<App.Models.State> | null;
        states_count?: number | null;
    }

    export interface Course {
        id: number;
        name: string;
        class_time: string;
        duration: number | null;
        tenant_id: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        readonly rating?: string;
    }

    export interface Dropdown {
        id: number;
        name: string;
        slug: string;
        type_name: string;
        sort: number | null;
        tenant_id: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
    }

    export interface NotificationPreference {
        id: number;
        appointment_new_emails: string | null;
        appointment_update_emails: string | null;
        appointment_cancel_emails: string | null;
        notification_preferenceable_id: number;
        notification_preferenceable_type: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        notificationpreferenceable?: any | null;
    }

    export interface PaymentType {
        id: number;
        name: string;
        tenant_id: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
    }

    export interface Payments {
        id: number;
        amount: number;
        student_id: number;
        course_id: number | null;
        payment_type_id: number;
        tenant_id: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        student?: App.Models.Student | null;
        payment_type?: App.Models.PaymentType | null;
        course?: App.Models.Course | null;
    }

    export interface Phone {
        id: number;
        is_primary: boolean | null;
        can_receive_sms: string | null;
        number: string;
        tenant_id: string;
        phoneable_id: number;
        phoneable_type: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        phoneable?: any | null;
        readonly number_fmt?: any;
    }

    export interface Roster {
        id: number;
        name: string;
        class_time: string;
        is_test_passed: boolean | null;
        student_id: number;
        course_id: number;
        tenant_id: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        student?: App.Models.Student | null;
        course?: App.Models.Course | null;
        readonly rating?: string;
    }

    export interface School {
        id: number;
        name: string;
        tenant_id: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        readonly rating?: string;
    }

    export interface SpecialEvent {
        id: number;
        name: string;
        date_start: string;
        end_date: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        tenant_id: string;
        readonly rating?: string;
    }

    export interface State {
        id: number;
        name: string;
        abbr: string;
        country_id: number;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        country?: App.Models.Country | null;
    }

    export interface Status {
        id: number;
        name: string;
        value: string;
        is_inactive: boolean | null;
        statusable_type: string | null;
        statusable_id: number | null;
        tenant_id: string | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        statusable?: any | null;
    }

    export interface Student {
        id: number;
        first_name: string;
        middle_name: string | null;
        last_name: string;
        email: string;
        phone: string | null;
        tenant_id: string | null;
        email_verified_at: string | null;
        password: string;
        data: string | null;
        school_id: number | null;
        car_id: number | null;
        student_type_id: number | null;
        user_type_id: number;
        status_id: number | null;
        is_inactive: boolean | null;
        remember_token: string | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        stripe_id: string | null;
        pm_type: string | null;
        pm_last_four: string | null;
        trial_ends_at: string | null;
        student_type?: App.Models.StudentType | null;
        school?: App.Models.School | null;
        car?: App.Models.Car | null;
        user_login_history?: Array<App.Models.UserLoginHistory> | null;
        timeoff_requests?: Array<App.Models.TimeOff> | null;
        appointments?: Array<App.Models.Appointment> | null;
        payments?: Array<App.Models.Payments> | null;
        status?: App.Models.Status | null;
        notification_preference?: App.Models.NotificationPreference | null;
        roles?: Array<Silber.Bouncer.Database.Role> | null;
        abilities?: Array<Silber.Bouncer.Database.Ability> | null;
        subscriptions?: Array<Laravel.Cashier.Subscription> | null;
        user_login_history_count?: number | null;
        timeoff_requests_count?: number | null;
        appointments_count?: number | null;
        payments_count?: number | null;
        roles_count?: number | null;
        abilities_count?: number | null;
        subscriptions_count?: number | null;
        readonly name?: string;
        readonly rating?: string;
    }

    export interface StudentType {
        id: number;
        name: string;
        label: string;
        tenant_id: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
    }

    export interface Tenant {
        id: string;
        created_at: string | null;
        updated_at: string | null;
        data: string | null;
        deleted_at: string | null;
        users?: Array<App.Models.User> | null;
        users_count?: number | null;
        readonly rating?: string;
    }

    export interface TestLocation {
        id: number;
        name: string;
        abbr: string;
        tenant_id: string | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        readonly rating?: string;
    }

    export interface Car {
        id: number;
        name: string | null;
        make: string;
        license_plate: string | null;
        model: string;
        color: string;
        year: string;
        tenant_id: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        instructors?: Array<App.Models.Instructor> | null;
        instructors_count?: number | null;
        readonly rating?: string;
    }

    export interface Instructor {
        id: number;
        first_name: string;
        middle_name: string | null;
        last_name: string;
        email: string;
        phone: string | null;
        tenant_id: string | null;
        email_verified_at: string | null;
        password: string;
        data: string | null;
        school_id: number | null;
        car_id: number | null;
        student_type_id: number | null;
        user_type_id: number;
        status_id: number | null;
        is_inactive: boolean | null;
        remember_token: string | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        stripe_id: string | null;
        pm_type: string | null;
        pm_last_four: string | null;
        trial_ends_at: string | null;
        timeoff_requests?: Array<App.Models.TimeOff> | null;
        car?: App.Models.Car | null;
        user_login_history?: Array<App.Models.UserLoginHistory> | null;
        school?: App.Models.School | null;
        appointments?: Array<App.Models.Appointment> | null;
        payments?: Array<App.Models.Payments> | null;
        status?: App.Models.Status | null;
        roles?: Array<Silber.Bouncer.Database.Role> | null;
        abilities?: Array<Silber.Bouncer.Database.Ability> | null;
        subscriptions?: Array<Laravel.Cashier.Subscription> | null;
        timeoff_requests_count?: number | null;
        user_login_history_count?: number | null;
        appointments_count?: number | null;
        payments_count?: number | null;
        roles_count?: number | null;
        abilities_count?: number | null;
        subscriptions_count?: number | null;
        readonly name?: string;
        readonly rating?: string;
    }

    export interface User {
        id: number;
        first_name: string;
        middle_name: string | null;
        last_name: string;
        email: string;
        phone: string | null;
        tenant_id: string | null;
        email_verified_at: string | null;
        password: string;
        data: string | null;
        school_id: number | null;
        car_id: number | null;
        student_type_id: number | null;
        user_type_id: number;
        status_id: number | null;
        is_inactive: boolean | null;
        remember_token: string | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        stripe_id: string | null;
        pm_type: string | null;
        pm_last_four: string | null;
        trial_ends_at: string | null;
        car?: App.Models.Car | null;
        user_login_history?: Array<App.Models.UserLoginHistory> | null;
        school?: App.Models.School | null;
        timeoff_requests?: Array<App.Models.TimeOff> | null;
        appointments?: Array<App.Models.Appointment> | null;
        payments?: Array<App.Models.Payments> | null;
        status?: App.Models.Status | null;
        user_login_history_count?: number | null;
        timeoff_requests_count?: number | null;
        appointments_count?: number | null;
        payments_count?: number | null;
        readonly name?: string;
        readonly rating?: string;
    }

    export interface AppointmentType {
        id: number;
        name: string;
        duration: number;
        is_test: boolean;
        test_offset: string;
        order: string;
        tenant_id: string;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
    }

    export interface TimeOff {
        id: number;
        date_time_off: string;
        time_start: number;
        time_end: number;
        user_id: number;
        recur_token: string | null;
        comments: string | null;
        created_at: string | null;
        updated_at: string | null;
        deleted_at: string | null;
        instructor?: App.Models.Instructor | null;
    }
}

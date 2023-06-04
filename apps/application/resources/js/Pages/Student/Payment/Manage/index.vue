<template>
    <ul>
        <li>
            <AppLink :href="`/students/${student.id}/edit`">
                <strong>Student Name:</strong> {{ student.name }}
            </AppLink>
        </li>
        <li><strong>Student Email:</strong> {{ student.email }}</li>
        <li>
            <strong>Student Type:</strong>
            {{ student?.student_type?.name || 'n/a' }}
        </li>
    </ul>
    <d-s-table
        :headers="headers"
        :items="student.payments"
        :model="`students/${student.id}/payments`"
        add-standard-buttons
        name="students"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';
import useGlobal from '@/utils/useGlobal';

const { student } = defineProps<{
    student: App.Models.Student;
}>();

const headers: TableHeadersType<App.Models.Payments> = [
    {
        label: 'Course',
        field: 'course.name',
    },
    {
        label: 'Amount',
        field: 'amount',
    },
    {
        label: 'Payment Type',
        field: 'payment_type.name',
    },
    {
        label: 'School',
        field: 'school.name',
        render: () => {
            return student?.school?.name || 'n/a';
        },
    },
    {
        label: 'Student Type',
        field: 'student_type.name',
        render: () => {
            return student?.student_type?.name || 'n/a';
        },
    },
];

const { setTitle } = useGlobal();
setTitle('Student Payment Manage');
</script>

<template>
    <d-s-table
        :headers="headers"
        :items="students"
        add-standard-buttons
        model="students"
        name="students"
        page-actions
    >
        <template #more-actions="{ row }">
            <TableButton
                :href="`/students/${row.id}/payments`"
                icon="usd"
                icon-class="fas"
                title="Payments"
            />
            <TableButton
                :href="`/students/${row.id}/appointments`"
                icon="calendar"
                title="Appointments"
            />
        </template>
    </d-s-table>
</template>
<script lang="ts" setup>
import TableButton from '@/Components/Table/TableButton';

import { TableHeadersType } from '@/types/table';

defineProps<{
    students: App.Models.Student[];
}>();

const headers: TableHeadersType<App.Models.Student> = [
    {
        label: 'First Name',
        field: 'first_name',
    },
    {
        label: 'Last Name',
        field: 'last_name',
    },
    {
        label: 'Middle Name',
        field: 'middle_name',
    },
    {
        label: 'Email',
        field: 'email',
        classes: '',
    },
    {
        label: 'School',
        field: ({ school = {} }) => school?.label || '',
    },
    {
        label: 'Student Type',
        field: ({ student_type = {} }) => student_type?.label || '',
    },
];
</script>

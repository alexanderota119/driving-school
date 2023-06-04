<!--suppress ALL -->
<template>
    <d-s-table
        :headers="headers"
        :items="instructors"
        add-standard-buttons
        model="instructors"
        name="instructors"
        page-actions
    />
</template>
<script lang="ts" setup>
import { Table as DSTable } from '@/Components';

import { TableHeadersType } from '@/types/table';
import { Inertia } from '@inertiajs/inertia';

defineProps({
    instructors: {
        type: Array,
    },
});

const headers: TableHeadersType<App.Models.Instructor> = [
    {
        label: 'Name',
        field: 'name',
    },
    {
        label: 'Email',
        field: 'email',
    },
    {
        label: 'Active',
        field: 'is_inactive',
        render(value) {
            return !value ? 'Yes' : 'No';
        },
    },
    {
        label: 'Phone',
        field: 'phone',
    },
    {
        label: 'Car',
        field: 'car.name',
    },
];

const deleteInstructor = ({ id }: App.Models.Instructor) => {
    Inertia.delete(`/instructors/${id}`);
};
</script>

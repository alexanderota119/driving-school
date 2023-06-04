<!--suppress ALL -->
<template>
    <d-s-table
        :headers="headers"
        :items="appointment_types"
        add-standard-buttons
        model="appointment_types"
        name="appointment_types"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';

defineProps<{
    appointment_types: App.Models.AppointmentType[];
}>();

const headers: TableHeadersType<App.Models.AppointmentType> = [
    {
        label: 'name',
        field: 'name',
    },
    {
        label: 'duration',
        field: 'duration',
    },
    {
        label: 'is_test',
        field: 'is_test',
    },
    {
        label: 'test_offset',
        field: 'test_offset',
    },
    {
        label: 'order',
        field: 'order',
    },
];
</script>

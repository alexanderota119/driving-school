<!--suppress ALL -->
<template>
    <d-s-table
        :headers="headers"
        :items="time_offs"
        add-standard-buttons
        model="time_offs"
        name="time_offs"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';

defineProps<{
    time_offs: App.Models.TimeOff;
}>();

const headers: TableHeadersType<App.Models.TimeOff> = [
    {
        label: 'Date Off',
        field: 'date_time_off',
    },
    {
        label: 'Start',
        field: 'time_start',
    },
    {
        label: 'End',
        field: 'time_end',
    },
    {
        label: 'Instructor',
        field: 'instructor.name',
    },
];
</script>

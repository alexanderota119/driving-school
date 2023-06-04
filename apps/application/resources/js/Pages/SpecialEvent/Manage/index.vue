<!--suppress ALL -->
<template>
    <d-s-table
        :headers="headers"
        :items="special_events"
        add-standard-buttons
        model="special_events"
        name="special_events"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';

defineProps<{
    special_events: App.Models.SpecialEvent[];
}>();

const headers: TableHeadersType<App.Models.SpecialEvent> = [
    {
        label: 'Event Name',
        field: 'name',
    },
    {
        label: 'Start Date',
        field: 'date_start',
    },
    {
        label: 'End Date',
        field: 'end_date',
    },
];
</script>

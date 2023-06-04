<!--suppress ALL -->
<template>
    <d-s-table
        :headers="headers"
        :items="schools"
        add-standard-buttons
        model="schools"
        name="schools"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';

defineProps<{
    schools: App.Models.School[];
}>();

const headers: TableHeadersType<App.Models.School> = [
    {
        label: 'School Name',
        field: 'name',
    },
];
</script>

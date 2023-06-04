<template>
    <d-s-table
        :headers="headers"
        :items="test_locations"
        add-standard-buttons
        model="test_locations"
        name="test_locations"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';

defineProps<{
    test_locations: App.Models.TestLocation;
}>();

const headers: TableHeadersType<App.Models.TestLocation> = [
    {
        label: 'Location Name',
        field: 'name',
    },
];
</script>

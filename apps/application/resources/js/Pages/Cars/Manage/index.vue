<template>
    <DSTable
        :headers="headers"
        :items="cars"
        add-standard-buttons
        model="cars"
        name="cars"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';

defineProps<{
    cars: App.Models.Car[];
}>();

const headers: TableHeadersType<App.Models.Car> = [
    {
        label: 'Car Name',
        field: 'name',
    },
    {
        label: 'Make',
        field: 'make',
    },
    {
        label: 'license Plate',
        field: 'license_plate',
    },
    {
        label: 'Model',
        field: 'model',
    },
    {
        label: 'Color',
        field: 'color',
    },
    {
        label: 'Year',
        field: 'year',
    },
];
</script>

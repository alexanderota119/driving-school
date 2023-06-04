<template>
    <d-s-table
        :headers="headers"
        :items="courses"
        add-standard-buttons
        model="courses"
        name="courses"
        page-actions
    >
    </d-s-table>
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';

defineProps<{
    courses: App.Models.Course[];
}>();

const headers: TableHeadersType<App.Models.Course> = [
    {
        label: 'Name',
        field: 'name',
    },
    {
        label: 'Class Time',
        field: 'class_time',
    },
    {
        label: 'Duration',
        field: 'duration',
    },
];
</script>

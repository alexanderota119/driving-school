<!--suppress ALL -->
<template>
    <d-s-table
        :headers="headers"
        :items="student_types"
        add-standard-buttons
        model="student_types"
        name="student_types"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';

defineProps<{
    student_types: App.Models.StudentType[];
}>();

const headers: TableHeadersType<App.Models.StudentType> = [
    {
        label: 'Student Type Label',
        field: 'label',
    },
];
</script>

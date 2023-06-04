<!--suppress ALL -->
<template>
    <d-s-table
        :headers="headers"
        :items="users"
        add-standard-buttons
        model="users"
        name="users"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';

defineProps<{
    users: App.Models.User[];
}>();

const headers: TableHeadersType<App.Models.User> = [
    {
        label: 'First Name',
        field: 'first_name',
    },
    {
        label: 'Last Name',
        field: 'last_name',
    },
    {
        label: 'Email',
        field: 'email',
    },
];
</script>

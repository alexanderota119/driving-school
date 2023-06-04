<!--suppress ALL -->
<template>
    <d-s-table
        :headers="headers"
        :items="tenants"
        add-standard-buttons
        model="tenants"
        name="tenants"
        page-actions
    />
</template>
<script lang="ts" setup>
import { TableHeadersType } from '@/types/table';
import { TenantModel } from '@/utils/types/extended-models';

defineProps<{
    tenants: TenantModel[];
}>();

const headers: TableHeadersType<TenantModel> = [
    {
        label: 'Tenant Key',
        field: 'id',
    },
    {
        label: 'Tenant Name',
        field: 'name',
    },
    {
        label: 'Tenant Options',
        field: 'data',
    },
];
</script>

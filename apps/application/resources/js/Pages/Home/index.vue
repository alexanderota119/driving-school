<template>
    <q-card class="q-pa-sm">
        <h3>{{ tenant_name || 'tenant' }}!</h3>

        <div>
            <pre>render date: <span v-text="userDatetime(tenant.created_at)"></span></pre>
        </div>

        <div>
            <pre>{{ JSON.stringify(tenant, null, 2) }}</pre>
        </div>
    </q-card>
</template>
<script lang="ts" setup>
const props = defineProps<{
    tenant_name: string;
    tenant: App.Models.Tenant;
}>();
</script>

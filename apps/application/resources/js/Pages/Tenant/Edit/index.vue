<template>
    <CtxForm :action="`/tenant`" :form="tenant" method="put">
        <Form :domains="domains" is-edit @add-domain="handleAddDomain" />

        <q-btn color="primary" type="submit">Submit</q-btn>
    </CtxForm>
</template>
<script lang="ts" setup>
import { CtxForm } from '@/Components';
import Form from '@/Pages/Tenant/Form';
import { TenantModel } from '@/utils/types/extended-models';
import { get } from 'lodash';
import { computed } from 'vue';

const props = defineProps<{
    tenant: TenantModel;
}>();

const domains = computed(() => {
    return get(props, 'tenant.domains', []);
});

const handleAddDomain = () => {
    props.tenant.domains.push({
        domain: '',
        tenant_id: props.tenant.id,
    });
};
</script>

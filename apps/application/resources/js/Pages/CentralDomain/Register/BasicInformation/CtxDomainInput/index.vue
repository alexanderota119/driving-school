<template>
    <ctx-input
        :help="
            fieldValue
                ? `(Your free subdomain will be ${slug(
                      fieldValue,
                  )}.${defaultDomain})`
                : undefined
        "
        :label="`Tenant Name:`"
        name="tenant_name"
        required
    />
</template>
<script lang="ts" setup>
import { formStateUpdate, getError } from '@/utils';
import { slug } from '@/utils/helpers/String';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { inject } from 'vue';

defineProps<{
    defaultDomain: string;
}>();

const fieldValue = (inject(formStateUpdate) as EdDrivingComputedRef)(
    'tenant_name',
);
const error = (inject(getError) as EdDrivingComputedRef)('tenant_name');
</script>

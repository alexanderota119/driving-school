<template>
    <div class="q-ma-md">
        <q-checkbox v-model="fieldValue" :label="label" />
        <input-error-display :error="error" />
    </div>
</template>
<script lang="ts" setup>
import { formStateUpdateCheckbox, getError } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { ModelIdType } from '@/utils/types/models';
import { inject } from 'vue';

interface Props {
    name: string;
    required?: boolean;
    description?: string;
    label?: string;
    disabled?: boolean;
}

const props = defineProps<Props>();

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(
    formStateUpdateCheckbox,
)(props.name);
const error = (inject(getError) as EdDrivingComputedRef)(props.name);
</script>

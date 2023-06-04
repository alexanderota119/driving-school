<template>
    <q-input
        v-model="fieldValue"
        :counter="fieldValue.length > 10"
        :error="!!error"
        :hint="help"
        :label="label + (required ? ' *' : '')"
        :name="name"
        :required="required"
        :rows="rows"
        class="q-ma-md"
        outlined
        type="textarea"
    />
    <input-error-display #error :error="error" />
</template>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { formStateUpdate, getError } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { inject } from 'vue';

interface Props {
    name: string;
    placeholder?: string;
    autocomplete?: string;
    required?: boolean;
    description?: string;
    label?: string;
    disabled?: boolean;
    help?: string;
    rows?: number;
}

const props = withDefaults(defineProps<Props>(), {
    autocomplete: 'on',
    rows: 5,
});

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)(
    props.name,
);
const error = (inject(getError) as EdDrivingComputedRef)(props.name);
</script>

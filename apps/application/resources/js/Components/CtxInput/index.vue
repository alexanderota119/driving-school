<template>
    <q-input
        v-model.trim="fieldValue"
        :counter="fieldValue.length > 10"
        :error="!!error"
        :hint="help"
        :label="label + (required ? ' *' : '')"
        :mask="mask"
        :name="name"
        :required="required"
        :type="type"
        class="q-ma-md"
        outlined
        v-bind="props"
    >
        <input-error-display #error :error="error" />
    </q-input>
</template>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { formStateUpdate, getError } from '@/utils';
import { EdDrivingComputedRef, InputTypeTypes } from '@/utils/types/form';
import { inject } from 'vue';

interface Props {
    name: string;
    placeholder?: string;
    autocomplete?: string;
    required?: boolean;
    description?: string;
    mask?: string;
    label?: string;
    disabled?: boolean;
    type?: InputTypeTypes;
    help?: string;

    [key: string]: any;
}

const props = withDefaults(defineProps<Props>(), {
    type: 'text',
    autocomplete: 'on',
});

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)(
    props.name,
);
const error = (inject(getError) as EdDrivingComputedRef)(props.name);
</script>

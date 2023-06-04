<template>
    <q-field
        :hint="help"
        :label="label"
        class="q-ma-md"
        outlined
        stack-label
        standout
    >
        <template #control>
            <q-color
                v-model="fieldValue"
                #control
                :name="name"
                class="q-ma-md self-center full-width no-outline"
                formatModel="hex"
            />
        </template>
    </q-field>
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
    label?: string;
    disabled?: boolean;
    type?: InputTypeTypes;
    help?: string;
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

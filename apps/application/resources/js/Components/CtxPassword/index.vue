<template>
    <q-input
        v-model="fieldValue"
        :autocomplete="autocomplete"
        :label="label"
        :required="required"
        :type="isPwd ? 'password' : 'text'"
        class="q-ma-md"
        hint="Show password with the toggle"
        outlined
    >
        <template v-slot:append>
            <q-icon
                :name="isPwd ? 'visibility_off' : 'visibility'"
                class="cursor-pointer"
                @click="isPwd = !isPwd"
            />
        </template>
    </q-input>
</template>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { formStateUpdate, getError } from '@/utils';
import { EdDrivingComputedRef, InputTypeTypes } from '@/utils/types/form';
import { inject, ref } from 'vue';

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

const isPwd = ref<boolean>(true);

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)(
    props.name,
);
const error = (inject(getError) as EdDrivingComputedRef)(props.name);
</script>

<template>
    <q-select
        v-model="fieldValue"
        :behavior="options.length > 10 ? 'dialog' : 'menu'"
        :label="label"
        :name="name"
        :options="options"
        class="q-ma-md"
        emit-value
        option-label="text"
        option-value="value"
        outlined
        style="min-width: 140px"
    />
</template>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { formStateUpdate, getError } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { inject } from 'vue';

interface DropdownProps {
    name: string;
    options: { value: string | number | null; text: string }[];
    showEmpty: boolean;
    placeholder?: string;
    label?: string;
    required: boolean;
    disabled: boolean;
    defaultValue?: string;
}

const props = withDefaults(defineProps<DropdownProps>(), {
    showEmpty: true,
    required: false,
    defaultValue: '',
});

const emits = defineEmits(['change']);

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)(
    props.name,
);
const error = (inject(getError) as EdDrivingComputedRef)(
    props.name,
    props.defaultValue,
);

const handleOnChange = (selectedValue: string | number) => {
    emits('change', selectedValue);
};
</script>

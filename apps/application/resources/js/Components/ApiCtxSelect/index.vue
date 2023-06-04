<template>
    <q-select
        v-model="fieldValue"
        :behavior="data.options.length > 10 ? 'dialog' : 'menu'"
        :name="name"
        :options="data.options"
        class="q-ma-md"
        emit-value
        input-debounce="50"
        label="Standard"
        map-options
        option-label="text"
        outlined
    />
</template>
<script lang="ts">
export default {
    name: 'ApiCtxSelect',
};
</script>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { formStateUpdate } from '@/utils';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { inject, reactive } from 'vue';
import useApiCalls from '@/utils/useApiCalls';

type OptionType = {
    text: string;
    value: any;
};

interface Props {
    model: string;
    optionLabel?: string;
    optionValue?: string;
    options: any;
    name?: string;
}

interface Data {
    options: OptionType[];
    response: any[];
}

const props = defineProps<Props>();

const emits = defineEmits(['change']);

const data = reactive<Data>({
    options: [],
    response: [],
});

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)(
    props.name,
);

(async () => {
    const response = (await useApiCalls(`/api/dropdown/${props.model}`)) || [];
    data.options = response.map((r: any) => r.option) || 'oops';
    data.response = response;
})();

const handleChange = (selectedValue: OptionType) => {
    console.log('handleChange', {
        selectedValue,
    });
    const foundOption = data.response.find(
        ({ id }) => id === selectedValue.value,
    );
    fieldValue.value = selectedValue;
    emits('change', selectedValue, { option: foundOption });
};

const handleFilter = (val: string, update: any) => {
    console.log('handleFilter', {
        val,
        update,
    });

    if (val === '') {
        update(() => {
            // data.options = data.options;
            // here you have access to "ref" which
            // is the Vue reference of the QSelect
        });
        return;
    }

    update(() => {
        const needle = val.toLowerCase();
        data.options = data.options.filter(v => {
            return v.text.toLowerCase().indexOf(needle) > -1;
        });
    });
};
</script>

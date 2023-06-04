<template>
    <q-file
        v-model="fieldValue"
        :label="label"
        bottom-slots
        class="q-ma-md"
        counter
        max-files="1"
        outlined
    >
        <template v-slot:before>
            <q-icon name="folder_open" />
        </template>

        <template v-if="help" v-slot:hint>
            {{ help }}
        </template>

        <template v-slot:append>
            <q-btn dense flat icon="add" round @click.stop.prevent />
        </template>
    </q-file>
</template>
<script lang="ts" setup>
import { ModelIdType } from '@/types/form';
import { formStateUpdate, getError } from '@/utils';
import { ImageFileTypes } from '@/utils/types/DefaultInputProps';
import { EdDrivingComputedRef } from '@/utils/types/form';
import { inject } from 'vue';

interface Props {
    name?: string;
    label?: string;
    placeholder?: string;
    help?: string;
    description?: string;
    required?: boolean;
    autocomplete?: string;
    types: ImageFileTypes[];
}

const props = withDefaults(defineProps<Props>(), {
    name: 'image',
    types: ['jpeg', 'png', 'jpg'] as any,
});

const fieldValue = inject<EdDrivingComputedRef<ModelIdType>>(formStateUpdate)(
    props.name,
    undefined,
    { file: true },
);
const error = (inject(getError) as EdDrivingComputedRef)(props.name);
//
</script>

<template>
    <q-dialog v-model="refShowModal">
        <q-card class="col-grow">
            <q-card-section v-if="title">
                <div class="text-h6" v-text="title" />

                <q-separator />
            </q-card-section>

            <q-card-section class="col q-pt-none">
                <slot />
            </q-card-section>

            <q-card-actions align="right" class="bg-white text-teal">
                <slot name="buttons" />
            </q-card-actions>
        </q-card>
    </q-dialog>
</template>
<script lang="ts" setup>
import { ref, watch } from 'vue';

interface Props {
    show: boolean;
    title?: string;
    id?: string;
    form?: any;
    size?: 'xl' | 'lg' | 'sm';
}

const props = withDefaults(defineProps<Props>(), {
    id: 'main-modal',
    show: false,
    size: 'lg',
    form: {},
});

const refShowModal = ref(false);

watch({ show: props.show }, () => {
    refShowModal.value = props.show;
});

const emits = defineEmits(['hide', 'ok', 'cancel']);

const handleHide = () => {
    emits('hide');
};
const handleOk = (formData = {}) => {
    emits('ok', formData);
};
const handleCancel = () => {
    if (confirm('Sure?')) {
        emits('cancel');
    }
};
const handleSubmit = (formData: any) => {
    handleOk(formData);
};
</script>

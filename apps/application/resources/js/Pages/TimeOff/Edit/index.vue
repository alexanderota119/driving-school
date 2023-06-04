<!--suppress ALL -->
<template>
    <CtxForm
        :action="`/time_offs/${time_off.id}`"
        :form="time_off"
        add-submit-button
        method="put"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import Form from '../Form/index.vue';

defineProps<{
    time_off: App.Models.TimeOff;
}>();
//
</script>

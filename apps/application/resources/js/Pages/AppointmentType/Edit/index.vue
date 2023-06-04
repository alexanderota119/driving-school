<!--suppress ALL -->
<template>
    <CtxForm
        :action="`/appointment_types/${appointment_type.id}`"
        :form="appointment_type"
        add-submit-button
        method="put"
    >
        <Form hide-name />
    </CtxForm>
</template>
<script lang="ts" setup>
import Form from '../Form/index.vue';

defineProps<{
    appointment_type: App.Models.AppointmentType;
}>();
</script>

<template>
    <CtxForm
        :action="`/students/${student.id}/appointments/${appointment.id}`"
        :form="appointment"
        add-submit-button
        method="put"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import Form from '@/features/Appointments/Form';

import { StudentModel } from '@/utils/types/extended-models';

defineProps<{
    student: StudentModel;
    appointment: App.Models.Appointment;
}>();
//
</script>

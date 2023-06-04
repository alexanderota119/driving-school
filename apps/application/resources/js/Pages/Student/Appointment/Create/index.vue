<template>
    <ctx-form
        :action="`/students/${student.id}/appointments`"
        :form="{ instructor_id: 17 }"
        add-submit-button
        method="post"
    >
        <Form />
    </ctx-form>
</template>
<script lang="ts" setup>
import Form from '@/features/Appointments/Form';
import { StudentModel } from '@/utils/types/extended-models';

defineProps<{
    student: StudentModel;
}>();
//
</script>

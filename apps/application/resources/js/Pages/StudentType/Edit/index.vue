<!--suppress ALL -->
<template>
    <CtxForm
        :action="`/student_types/${student_type.id}`"
        :form="student_type"
        add-submit-button
        method="put"
    >
        <Form hide-name />
    </CtxForm>
</template>
<script lang="ts" setup>
import Form from '../Form/index.vue';

defineProps<{
    student_type: App.Models.StudentType;
}>();
</script>

<template>
    <CtxForm
        :action="`/instructors/${instructor.id}`"
        :form="instructor"
        add-submit-button
        method="put"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import Form from '../Form/index.vue';

defineProps<{
    instructor: App.Models.Instructor;
}>();
</script>

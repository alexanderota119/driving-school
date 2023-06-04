<template>
    <CtxForm
        :action="`/courses/${course.id}`"
        :form="course"
        add-submit-button
        method="put"
    >
        <Form />
    </CtxForm>
</template>
<script lang="ts" setup>
import { Course } from '@/Pages/Course/types';
import Form from '../Form/index.vue';

defineProps<{
    course: Course;
}>();
</script>
